<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Color;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\ProductoColor;
use App\Models\ProductoImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

/**
 * Importa productos desde un ZIP con la estructura:
 *
 *   Categoria/Nombre del producto.jpg
 *
 * La carpeta define la categoría y el nombre del archivo el nombre del producto.
 * Si el producto ya existe en esa categoría, solo se reemplaza su imagen de portada.
 */
class ProductoImportController extends Controller
{
    private const EXTENSIONES = ['jpg', 'jpeg', 'png', 'webp'];

    private const MAX_IMAGEN_BYTES = 10 * 1024 * 1024;

    public function create()
    {
        $marcas = Marca::orderBy('nombre')->get();

        return view('productos.importar', compact('marcas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'archivo' => ['required', 'file', 'mimes:zip', 'max:102400'],
            'marca_id' => ['required', 'integer', 'exists:marcas,id'],
        ], [
            'archivo.required' => 'Selecciona un archivo ZIP.',
            'archivo.uploaded' => 'No fue posible subir el ZIP. Verifica el límite de subida de PHP.',
            'archivo.mimes' => 'El archivo debe ser un ZIP.',
            'archivo.max' => 'El ZIP no puede superar los 100 MB.',
            'marca_id.required' => 'Selecciona la marca de los productos.',
        ]);

        set_time_limit(0);

        $zip = new ZipArchive();

        if ($zip->open($request->file('archivo')->getRealPath()) !== true) {
            return back()->with('error', 'No fue posible abrir el ZIP. Verifica que el archivo no esté dañado.');
        }

        $marcaId = (int) $request->input('marca_id');
        $colorPredeterminado = Color::where('es_predeterminado', true)->first();
        $resultado = ['creados' => [], 'actualizados' => [], 'omitidos' => []];

        for ($i = 0; $i < $zip->numFiles; $i++) {
            $ruta = $this->nombreEntrada($zip, $i);

            if ($ruta === null) {
                continue;
            }

            $partes = array_values(array_filter(explode('/', $ruta), fn ($parte) => $parte !== ''));
            $archivo = array_pop($partes);
            $carpeta = end($partes);
            $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
            $nombre = $this->limpiarNombre(pathinfo($archivo, PATHINFO_FILENAME));

            if (!in_array($extension, self::EXTENSIONES, true)) {
                $resultado['omitidos'][] = "{$ruta}: no es una imagen JPG, PNG o WEBP.";
                continue;
            }

            if ($carpeta === false || $nombre === '') {
                $resultado['omitidos'][] = "{$ruta}: la imagen debe estar dentro de la carpeta de su categoría.";
                continue;
            }

            if (($zip->statIndex($i)['size'] ?? 0) > self::MAX_IMAGEN_BYTES) {
                $resultado['omitidos'][] = "{$ruta}: la imagen supera los 10 MB.";
                continue;
            }

            $contenido = $zip->getFromIndex($i);

            if ($contenido === false || @getimagesizefromstring($contenido) === false) {
                $resultado['omitidos'][] = "{$ruta}: la imagen está dañada o no se pudo leer.";
                continue;
            }

            try {
                $creado = DB::transaction(fn () => $this->importarProducto(
                    $this->limpiarNombre($carpeta),
                    $nombre,
                    $extension,
                    $contenido,
                    $marcaId,
                    $colorPredeterminado,
                ));

                $resultado[$creado ? 'creados' : 'actualizados'][] = $nombre;
            } catch (\Throwable $e) {
                report($e);
                $resultado['omitidos'][] = "{$ruta}: " . $e->getMessage();
            }
        }

        $zip->close();

        return redirect()
            ->route('productos.importar')
            ->with('resultado', $resultado);
    }

    /**
     * Crea o actualiza el producto y guarda su imagen de portada.
     * Devuelve true si el producto se creó.
     */
    private function importarProducto(
        string $nombreCategoria,
        string $nombre,
        string $extension,
        string $contenido,
        int $marcaId,
        ?Color $colorPredeterminado,
    ): bool {
        $categoria = $this->categoria($nombreCategoria);

        $producto = Producto::where('categoria_id', $categoria->id)
            ->where('nombre', $nombre)
            ->first();

        $creado = !$producto;

        if ($creado) {
            $producto = Producto::create([
                'categoria_id' => $categoria->id,
                'marca_id' => $marcaId,
                'nombre' => $nombre,
                'slug' => $this->slugUnico(Producto::class, $nombre),
                'descripcion' => $nombre,
                'estado' => true,
            ]);

            if ($colorPredeterminado) {
                ProductoColor::create([
                    'producto_id' => $producto->id,
                    'color_id' => $colorPredeterminado->id,
                    'stock' => null,
                ]);
            }
        }

        $carpeta = 'productos/' . Str::slug($categoria->nombre);
        $rutaImagen = $carpeta . '/' . $producto->slug . '.' . $extension;
        $portada = $producto->imagenes()->where('es_portada', true)->first();

        if ($portada && $portada->imagen !== $rutaImagen) {
            Storage::disk('public')->delete($portada->imagen);
        }

        Storage::disk('public')->put($rutaImagen, $contenido);

        ProductoImagen::updateOrCreate(
            ['producto_id' => $producto->id, 'es_portada' => true],
            ['producto_color_id' => null, 'imagen' => $rutaImagen, 'orden' => 0],
        );

        return $creado;
    }

    private function categoria(string $nombre): Categoria
    {
        $slug = Str::slug($nombre);

        return Categoria::where('nombre', $nombre)->first()
            ?? Categoria::where('slug', $slug)->first()
            ?? Categoria::create([
                'nombre' => $nombre,
                'slug' => $this->slugUnico(Categoria::class, $nombre),
                'estado' => true,
            ]);
    }

    private function slugUnico(string $modelo, string $nombre): string
    {
        $base = Str::slug($nombre) ?: 'item';
        $slug = $base;
        $numero = 1;

        while ($modelo::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $numero++;
        }

        return $slug;
    }

    /**
     * Devuelve la ruta de la entrada en UTF-8, o null si debe ignorarse
     * (carpetas, archivos ocultos y metadatos de macOS).
     */
    private function nombreEntrada(ZipArchive $zip, int $indice): ?string
    {
        $ruta = $zip->getNameIndex($indice, ZipArchive::FL_ENC_RAW);

        if ($ruta === false) {
            return null;
        }

        // Windows guarda los nombres con tildes y ñ en CP850 en vez de UTF-8.
        if (!mb_check_encoding($ruta, 'UTF-8')) {
            $ruta = mb_convert_encoding($ruta, 'UTF-8', 'CP850');
        }

        $ruta = str_replace('\\', '/', $ruta);

        if (str_ends_with($ruta, '/') || str_starts_with($ruta, '__MACOSX/')) {
            return null;
        }

        if (str_starts_with(basename($ruta), '.') || strcasecmp(basename($ruta), 'Thumbs.db') === 0) {
            return null;
        }

        return $ruta;
    }

    private function limpiarNombre(string $nombre): string
    {
        $nombre = str_replace('_', ' ', $nombre);

        return trim(preg_replace('/\s+/u', ' ', $nombre));
    }
}

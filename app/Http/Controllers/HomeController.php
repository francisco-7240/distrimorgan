<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\ProductoColor;
use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    public function index()
    {
        // Obtener 8 categorías activas en orden aleatorio
        $categorias = Categoria::where('estado', 1)->inRandomOrder()->limit(8)->get();

        // Solo se cargan los productos que el home puede mostrar: 8 para "Todos"
        // y 8 por cada categoría de los filtros, en lugar del catálogo completo.
        $consultaProductos = fn () => Producto::with([
            'categoria',
            'marca',
            'productoColores.color',
            'imagenes',
        ])->where('estado', 1)->orderBy('id')->limit(8);

        $productos = $consultaProductos()->get();

        foreach ($categorias as $categoria) {
            $productos = $productos->merge(
                $consultaProductos()->where('categoria_id', $categoria->id)->get()
            );
        }

        // Mostrar solo las marcas que tienen un logo disponible.
        $logosMarcas = collect(Storage::disk('public')->files('logo marcas'))
            ->keyBy(fn ($path) => Str::slug(pathinfo($path, PATHINFO_FILENAME)));
        $marcas = Marca::where('estado', 1)->orderBy('id', 'asc')->get()
            ->map(function ($marca) use ($logosMarcas) {
                $marca->logo_path = $marca->imagen && Storage::disk('public')->exists($marca->imagen)
                    ? $marca->imagen
                    : $logosMarcas->get(Str::slug($marca->slug));

                return $marca;
            })
            ->filter(fn ($marca) => $marca->logo_path)
            ->values();
        // Contadores
        $marcasDisponibles = Marca::where('estado', 1)->count();
        $productosEnStock = ProductoColor::where('stock', '>', 0)->sum('stock');

        return view('home', compact('productos', 'categorias', 'marcas', 'marcasDisponibles', 'productosEnStock'));
    }

    public function nosotros()
    {
        return view('nosotros');
    }

    public function servicios()
    {
        return view('servicios');
    }

    public function contacto()
    {
        return view('contacto');
    }

    public function guardarContacto(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'mensaje' => ['required', 'string'],
            'origen' => ['nullable', 'in:home,contacto'],
            'archivo' => ['nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:10240'],
        ], [
            'archivo.uploaded' => 'No fue posible subir el archivo. Verifica que no supere los 10 MB.',
            'archivo.file' => 'No fue posible subir el archivo. Verifica que no supere los 10 MB.',
            'archivo.mimes' => 'El archivo debe ser PDF, Word (doc, docx) o imagen (jpg, png).',
            'archivo.max' => 'El archivo no puede superar los 10 MB.',
        ]);

        $archivo = $request->file('archivo');
        unset($datos['origen'], $datos['archivo']);

        if ($archivo) {
            $rutaArchivo = $archivo->store('contactos', 'local');

            if ($rutaArchivo === false) {
                throw new \RuntimeException('No fue posible guardar el documento adjunto.');
            }

            $datos['archivo'] = $rutaArchivo;
        }

        Contacto::create($datos);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Su mensaje ha sido enviado.',
            ]);
        }

        return redirect()
            ->route($request->input('origen') === 'home' ? 'home' : 'contacto')
            ->with('success', 'Su mensaje ha sido enviado.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Color;
use App\Models\ProductoColor;
use App\Models\ProductoImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{

    public function index(Request $request)
    {
        $query = Producto::query()->with('categoria');

        // Filtro por título o contenido
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%");
            });
        }

        // Filtro por categoría
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        // Filtro por marca
        if ($request->filled('marca_id')) {
            $query->where('marca_id', $request->marca_id);
        }

        // Filtro por rango de fechas
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('created_at', [
                $request->fecha_inicio . ' 00:00:00',
                $request->fecha_fin . ' 23:59:59'
            ]);
        } elseif ($request->filled('fecha_inicio')) {
            $query->whereDate('created_at', '>=', $request->fecha_inicio);
        } elseif ($request->filled('fecha_fin')) {
            $query->whereDate('created_at', '<=', $request->fecha_fin);
        }

        $productos = $query->with([
            'categoria',
            'marca',
            'productoColores.color',
            'productoColores.imagenes',
            'imagenes',
        ])
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

        // Obtener categorías principales
        $categorias = Categoria::orderBy('nombre')->get();

        // Obtener marcas
        $marcas = Marca::orderBy('id', 'asc')->get();
        
        return view('productos.index', compact('productos', 'categorias', 'marcas'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();

        $marcas = Marca::where('estado', 1)
            ->orderBy('nombre')
            ->get();

        $colores = Color::where('estado', 1)
            ->orderBy('es_predeterminado', 'desc')
            ->orderBy('nombre')
            ->get();

        return view('productos.create', compact(
            'categorias',
            'marcas',
            'colores'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'categoria_id' => ['required', 'integer', 'exists:categorias,id'],
            'marca_id' => ['required', 'integer', 'exists:marcas,id'],

            'tiene_colores' => ['required', 'boolean'],

            'colores' => ['nullable', 'array'],
            'colores.*' => ['integer', 'exists:colores,id'],

            'stock' => ['nullable', 'integer', 'min:0'],

            'stock_colores' => ['nullable', 'array'],
            'stock_colores.*' => ['nullable', 'integer', 'min:0'],

            'imagen_portada' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'galeria' => ['nullable', 'array'],
            'galeria.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | 1. Generar slug único
            |--------------------------------------------------------------------------
            */

            $slugBase = Str::slug($request->nombre);
            $slug = $slugBase;
            $contador = 1;

            while (Producto::where('slug', $slug)->exists()) {
                $slug = $slugBase . '-' . $contador;
                $contador++;
            }


            /*
            |--------------------------------------------------------------------------
            | 2. Crear producto
            |--------------------------------------------------------------------------
            */

            $producto = Producto::create([
                'categoria_id' => $request->categoria_id,
                'marca_id' => $request->marca_id,
                'nombre' => $request->nombre,
                'slug' => $slug,
                'descripcion' => $request->descripcion,
                'estado' => true, // Por defecto activo
            ]);


            /*
            |--------------------------------------------------------------------------
            | 3. Crear colores y stock
            |--------------------------------------------------------------------------
            */

            if ($request->tiene_colores) {

                // Producto con colores
                $colores = $request->input('colores', []);
                $stocks = $request->input('stock_colores', []);

                foreach ($colores as $colorId) {

                    ProductoColor::create([
                        'producto_id' => $producto->id,
                        'color_id' => $colorId,
                        'stock' => array_key_exists($colorId, $stocks)
                            && $stocks[$colorId] !== ''
                                ? $stocks[$colorId]
                                : null,
                    ]);
                }

            } else {

                // Producto sin colores:
                // utilizar el color especial "Predeterminado"

                $colorPredeterminado = Color::where('es_predeterminado', true)
                    ->first();

                if (!$colorPredeterminado) {
                    throw new \Exception(
                        'No existe un color predeterminado configurado.'
                    );
                }

                ProductoColor::create([
                    'producto_id' => $producto->id,
                    'color_id' => $colorPredeterminado->id,
                    'stock' => $request->filled('stock')
                        ? $request->stock
                        : null,
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | 4. Guardar imagen de portada
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('imagen_portada')) {

                $categoria = Categoria::find($request->categoria_id);
                $carpetaCategoria = $categoria ? Str::slug($categoria->nombre) : 'sin-categoria';
                $rutaBase = 'productos/' . $carpetaCategoria;
                $extension = $request->file('imagen_portada')->getClientOriginalExtension();
                $nombrePortada = $slug . '.' . $extension;

                $request->file('imagen_portada')->storeAs($rutaBase, $nombrePortada, 'public');

                ProductoImagen::create([
                    'producto_id' => $producto->id,
                    'producto_color_id' => null,
                    'imagen' => $rutaBase . '/' . $nombrePortada,
                    'es_portada' => true,
                    'orden' => 0,
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | 5. Guardar imágenes de galería
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('galeria')) {

                $categoria = Categoria::find($request->categoria_id);
                $carpetaCategoria = $categoria ? Str::slug($categoria->nombre) : 'sin-categoria';
                $rutaBase = 'productos/' . $carpetaCategoria;
                $orden = 1;

                foreach ($request->file('galeria') as $imagen) {

                    $extension = $imagen->getClientOriginalExtension();
                    $nombreImagen = $slug . '-' . $orden . '.' . $extension;

                    $imagen->storeAs($rutaBase, $nombreImagen, 'public');

                    ProductoImagen::create([
                        'producto_id' => $producto->id,
                        'producto_color_id' => null,
                        'imagen' => $rutaBase . '/' . $nombreImagen,
                        'es_portada' => false,
                        'orden' => $orden,
                    ]);

                    $orden++;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | 6. Confirmar transacción
            |--------------------------------------------------------------------------
            */

            DB::commit();

            return redirect()
                ->route('productos.index')
                ->with('success', 'Producto creado correctamente.');

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'No fue posible crear el producto. ' . $e->getMessage(),
                ]);
        }
    }

    public function edit(Producto $producto)
    {
        $producto->load('imagenes');
        $categorias = Categoria::orderBy('nombre')->get();
        $marcas = Marca::orderBy('nombre')->get();

        return view('productos.edit', compact('producto', 'categorias', 'marcas'));
    }

    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'categoria_id' => ['required', 'integer', 'exists:categorias,id'],
            'marca_id' => ['required', 'integer', 'exists:marcas,id'],
            'estado' => ['required', 'boolean'],
            'imagen_portada' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'imagen_portada.max' => 'La imagen no debe superar los 2 MB.',
        ]);

        $producto->update([
            'nombre' => $validated['nombre'],
            'slug' => $this->uniqueSlug($validated['nombre'], $producto->id),
            'descripcion' => $validated['descripcion'],
            'categoria_id' => $validated['categoria_id'],
            'marca_id' => $validated['marca_id'],
            'estado' => $validated['estado'],
        ]);

        // Si se sube una nueva imagen, eliminar la anterior y guardar la nueva
        if ($request->hasFile('imagen_portada')) {
            $imagenAnterior = $producto->imagenes()->where('es_portada', true)->first();
            if ($imagenAnterior) {
                Storage::disk('public')->delete('productos/' . $imagenAnterior->imagen);
                $imagenAnterior->delete();
            }

            $filename = $producto->slug . '.' . $request->file('imagen_portada')->getClientOriginalExtension();
            $request->file('imagen_portada')->storeAs('productos', $filename, 'public');
            $producto->imagenes()->create([
                'imagen' => $filename,
                'es_portada' => true,
                'orden' => 0,
            ]);
        }

        session()->flash('success', 'Producto actualizado correctamente');
        return redirect()->route('productos.index');
    }

    public function destroy(Producto $producto)
    {
        DB::transaction(function () use ($producto) {
            foreach ($producto->imagenes as $imagen) {
                Storage::disk('public')->delete('productos/' . $imagen->imagen);
            }

            $producto->imagenes()->delete();
            $producto->productoColores()->delete();
            $producto->delete();
        });

        session()->flash('success', 'Producto eliminado correctamente');
        return redirect()->route('productos.index');
    }

    public function article(Producto $producto)
    {
        $producto->load(['categoria', 'marca', 'productoColores.color', 'imagenes']);

        return view('productos.article', compact('producto'));
    }

    public function show(Request $request)
    {
        // Obtener productos con sus relaciones
        $productos = Producto::with([
            'categoria',
            'marca',
            'productoColores.color',
            'productoColores.imagenes',
            'imagenes',
        ])->where('estado', 1)->get();
        // Obtener categorías activas
        $categorias = Categoria::where('estado', 1)->orderBy('nombre')->get();
        // Obtener marcas
        $marcas = Marca::where('estado', 1)->orderBy('id', 'asc')->get();

        return view('productos.show', compact('productos', 'categorias', 'marcas'));
    }

    private function uniqueSlug(string $nombre, ?int $productoId = null): string
    {
        $slugBase = Str::slug($nombre);
        $slug = $slugBase;
        $contador = 1;

        while (Producto::where('slug', $slug)
            ->when($productoId, fn ($query) => $query->where('id', '!=', $productoId))
            ->exists()) {
            $slug = $slugBase . '-' . $contador++;
        }

        return $slug;
    }
}

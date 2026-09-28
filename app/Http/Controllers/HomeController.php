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
        // Obtener productos con sus relaciones
        $productos = Producto::with([
            'categoria',
            'marca',
            'productoColores.color',
            'productoColores.imagenes',
            'imagenes',
        ])->where('estado', 1)->get();
        // Obtener 8 categorías activas en orden aleatorio
        $categorias = Categoria::where('estado', 1)->inRandomOrder()->limit(8)->get();
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
        ]);

        unset($datos['origen']);
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
<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
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
        // Obtener categorías principales
        $categorias = Categoria::where('estado', 1)->whereNull('categoria_padre_id')->get();
        // Obtener marcas
        $marcas = Marca::where('estado', 1)->orderBy('id', 'asc')->get();

        return view('productos.show', compact('productos', 'categorias', 'marcas'));
    }
}

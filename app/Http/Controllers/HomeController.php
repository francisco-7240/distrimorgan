<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\ProductoColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


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
        // Obtener 8 categorías principales en orden aleatorio
        $categorias = Categoria::where('estado', 1)->whereNull('categoria_padre_id')->inRandomOrder()->limit(8)->get();
        // Obtener marcas
        $marcas = Marca::where('estado', 1)->orderBy('id', 'asc')->get();
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
}
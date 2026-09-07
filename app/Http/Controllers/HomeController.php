<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
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
        ])->get();
        // Obtener categorías
        $categorias = Categoria::where('estado', 1)->whereNull('categoria_padre_id')->orderBy('id')->limit(10)->get();
        // Obtener marcas
        $marcas = Marca::where('estado', 1)->orderBy('id', 'asc')->get();

        return view('home', compact('productos', 'categorias', 'marcas'));
    }

    public function nosotros()
    {
        return view('nosotros');
    }

    public function productos()
    {
        return view('productos');
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
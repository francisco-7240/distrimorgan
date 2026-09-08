<?php

namespace App\Http\Controllers;

use App\Services\CarritoService;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function __construct(protected CarritoService $carrito)
    {
    }

    // Vista del carrito
    public function index()
    {
        return view('carrito.index');
    }

    // Obtener productos del carrito
    public function productos(Request $request)
    {
        $request->validate([
            'productos' => ['required', 'array'],
            'productos.*' => ['integer', 'exists:productos,id'],
        ]);

        $productos = Producto::with([
            'categoria',
            'marca',
            'productoColores.color',
            'productoColores.imagenes',
            'imagenes',
        ])
        ->whereIn('id', $request->productos)
        ->where('estado', 1)
        ->get();

        return response()->json($productos);
    }
}

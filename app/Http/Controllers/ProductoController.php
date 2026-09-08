<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function productos(Request $request)
    {
        $productos = Producto::query()
            ->with(['categoria', 'marca', 'productoColores.color', 'imagenes'])
            ->where('estado', true)
            ->when($request->filled('buscar'), function ($query) use ($request) {
                $buscar = $request->string('buscar')->trim();

                $query->where(function ($query) use ($buscar) {
                    $query->where('nombre', 'like', "%{$buscar}%")
                        ->orWhereHas('marca', fn ($marca) => $marca->where('nombre', 'like', "%{$buscar}%"));
                });
            })
            ->when($request->filled('categoria'), fn ($query) => $query->where('categoria_id', $request->integer('categoria')))
            ->when($request->filled('marca'), fn ($query) => $query->where('marca_id', $request->integer('marca')))
            ->when($request->input('orden') === 'nombre', fn ($query) => $query->orderBy('nombre'))
            ->when($request->input('orden') === 'recientes', fn ($query) => $query->latest())
            ->when(! in_array($request->input('orden'), ['nombre', 'recientes'], true), fn ($query) => $query->orderBy('id'))
            ->paginate(12)
            ->withQueryString();

        $categorias = Categoria::query()
            ->where('estado', true)
            ->whereNull('categoria_padre_id')
            ->orderBy('nombre')
            ->get();

        $marcas = Marca::query()
            ->where('estado', true)
            ->orderBy('nombre')
            ->get();

        return view('productos', compact('productos', 'categorias', 'marcas'));
    }
}

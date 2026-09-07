<?php

namespace App\Http\Controllers;

use App\Services\CarritoService;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function __construct(protected CarritoService $carrito)
    {
    }

    /** Vista del carrito. */
    public function index()
    {
        return view('carrito.index', [
            'items' => $this->carrito->items(),
            'totalItems' => $this->carrito->totalItems(),
            'urlWhatsApp' => $this->carrito->vacio() ? null : $this->carrito->urlWhatsApp(),
        ]);
    }

    /** Agregar una variante (producto+color) al carrito. */
    public function agregar(Request $request)
    {
        $data = $request->validate([
            'producto_color_id' => ['required', 'integer', 'exists:producto_colores,id'],
            'cantidad' => ['nullable', 'integer', 'min:1'],
        ]);

        $this->carrito->agregar(
            $data['producto_color_id'],
            $data['cantidad'] ?? 1
        );

        // Si la petición es AJAX, devolvemos JSON con el contador
        if ($request->wantsJson()) {
            return response()->json([
                'ok' => true,
                'totalItems' => $this->carrito->totalItems(),
            ]);
        }

        return back()->with('status', 'Producto agregado a la cotización.');
    }

    /** Cambiar la cantidad de una variante. */
    public function actualizar(Request $request, int $productoColorId)
    {
        $data = $request->validate([
            'cantidad' => ['required', 'integer', 'min:0'],
        ]);

        $this->carrito->actualizar($productoColorId, $data['cantidad']);

        return back()->with('status', 'Cantidad actualizada.');
    }

    /** Quitar una variante del carrito. */
    public function eliminar(int $productoColorId)
    {
        $this->carrito->eliminar($productoColorId);

        return back()->with('status', 'Producto eliminado de la cotización.');
    }

    /** Vaciar todo el carrito. */
    public function vaciar()
    {
        $this->carrito->vaciar();

        return back()->with('status', 'Se vació la cotización.');
    }
}

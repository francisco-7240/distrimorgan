<?php

namespace App\Services;

use App\Models\ProductoColor;
use Illuminate\Support\Collection;

/**
 * Carrito de cotización guardado en sesión.
 *
 * La unidad que se agrega es una combinación producto+color (ProductoColor),
 * porque el stock vive ahí. No maneja precios: es solo para armar el pedido
 * que luego se envía por WhatsApp.
 *
 * Estructura en sesión (clave 'carrito'):
 * [
 *   producto_color_id => ['cantidad' => int],
 *   ...
 * ]
 */
class CarritoService
{
    protected string $key = 'carrito';

    /** Devuelve el array crudo del carrito desde la sesión. */
    protected function raw(): array
    {
        return session()->get($this->key, []);
    }

    protected function guardar(array $items): void
    {
        session()->put($this->key, $items);
    }

    /**
     * Agrega una variante (producto+color) al carrito o suma cantidad.
     * Respeta el stock disponible del ProductoColor.
     */
    public function agregar(int $productoColorId, int $cantidad = 1): void
    {
        $cantidad = max(1, $cantidad);

        $variante = ProductoColor::find($productoColorId);
        if (! $variante) {
            return; // variante inexistente: no hacemos nada
        }

        $items = $this->raw();
        $actual = $items[$productoColorId]['cantidad'] ?? 0;
        $nueva = $actual + $cantidad;

        // No superar el stock disponible (si stock es 0 o null, dejamos al menos 1)
        if ($variante->stock !== null && $variante->stock > 0) {
            $nueva = min($nueva, $variante->stock);
        }

        $items[$productoColorId] = ['cantidad' => $nueva];
        $this->guardar($items);
    }

    /** Fija una cantidad exacta para una variante. Si es <= 0, la elimina. */
    public function actualizar(int $productoColorId, int $cantidad): void
    {
        $items = $this->raw();

        if (! isset($items[$productoColorId])) {
            return;
        }

        if ($cantidad <= 0) {
            $this->eliminar($productoColorId);
            return;
        }

        $variante = ProductoColor::find($productoColorId);
        if ($variante && $variante->stock !== null && $variante->stock > 0) {
            $cantidad = min($cantidad, $variante->stock);
        }

        $items[$productoColorId]['cantidad'] = $cantidad;
        $this->guardar($items);
    }

    public function eliminar(int $productoColorId): void
    {
        $items = $this->raw();
        unset($items[$productoColorId]);
        $this->guardar($items);
    }

    public function vaciar(): void
    {
        session()->forget($this->key);
    }

    /** Cantidad total de unidades (para el badge del icono). */
    public function totalItems(): int
    {
        return collect($this->raw())->sum('cantidad');
    }

    /** ¿Está vacío? */
    public function vacio(): bool
    {
        return empty($this->raw());
    }

    /**
     * Devuelve los items "hidratados": cada uno con su modelo ProductoColor,
     * el producto, el color y la cantidad. Ignora variantes que ya no existan.
     */
    public function items(): Collection
    {
        $raw = $this->raw();

        if (empty($raw)) {
            return collect();
        }

        $variantes = ProductoColor::with(['producto', 'color'])
            ->whereIn('id', array_keys($raw))
            ->get()
            ->keyBy('id');

        return collect($raw)
            ->map(function ($item, $id) use ($variantes) {
                $variante = $variantes->get($id);
                if (! $variante) {
                    return null; // variante borrada de la BD
                }

                return (object) [
                    'producto_color_id' => (int) $id,
                    'variante' => $variante,
                    'producto' => $variante->producto,
                    'color' => $variante->color,
                    'cantidad' => (int) $item['cantidad'],
                ];
            })
            ->filter()
            ->values();
    }

    /**
     * Construye el texto del pedido para WhatsApp.
     */
    public function mensajeWhatsApp(): string
    {
        $lineas = [];
        $lineas[] = "Hola, quisiera cotizar los siguientes productos:";
        $lineas[] = "";

        foreach ($this->items() as $i => $item) {
            $nombre = $item->producto->nombre ?? 'Producto';
            $color = $item->color->nombre ?? null;
            $linea = ($i + 1) . ". " . $nombre;
            if ($color) {
                $linea .= " - Color: " . $color;
            }
            $linea .= " (Cantidad: " . $item->cantidad . ")";
            $lineas[] = $linea;
        }

        $lineas[] = "";
        $lineas[] = "Quedo atento a la información. ¡Gracias!";

        return implode("\n", $lineas);
    }

    /** URL completa de WhatsApp lista para enlazar. */
    public function urlWhatsApp(): string
    {
        $numero = preg_replace('/\D/', '', (string) config('carrito.whatsapp'));
        $texto = rawurlencode($this->mensajeWhatsApp());

        return "https://wa.me/{$numero}?text={$texto}";
    }
}

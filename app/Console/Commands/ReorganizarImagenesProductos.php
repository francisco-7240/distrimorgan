<?php

namespace App\Console\Commands;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\ProductoImagen;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

#[\Illuminate\Console\Attributes\Signature('productos:reorganizar-imagenes')]
#[\Illuminate\Console\Attributes\Description('Reorganiza las imágenes de productos por carpeta de categoría y actualiza las rutas guardadas.')]
class ReorganizarImagenesProductos extends Command
{
    protected $signature = 'productos:reorganizar-imagenes';

    protected $description = 'Reorganiza las imágenes de productos por carpeta de categoría y actualiza las rutas guardadas.';

    public function handle()
    {
        $productos = Producto::with(['categoria', 'imagenes'])->get();

        foreach ($productos as $producto) {
            $categoria = $producto->categoria;
            $carpetaCategoria = $categoria ? Str::slug($categoria->nombre) : 'sin-categoria';
            $rutaDestinoBase = 'productos/' . $carpetaCategoria;

            if (!Storage::disk('public')->exists($rutaDestinoBase)) {
                Storage::disk('public')->makeDirectory($rutaDestinoBase);
            }

            foreach ($producto->imagenes as $imagen) {
                $rutaActual = $imagen->imagen;

                if (empty($rutaActual)) {
                    continue;
                }

                $nombreArchivo = basename($rutaActual);
                $rutaNueva = $rutaDestinoBase . '/' . $nombreArchivo;
                $rutaOrigen = Str::startsWith($rutaActual, 'productos/')
                    ? $rutaActual
                    : 'productos/' . $nombreArchivo;

                if ($rutaOrigen !== $rutaNueva && Storage::disk('public')->exists($rutaOrigen)) {
                    if (!Storage::disk('public')->exists($rutaNueva)) {
                        Storage::disk('public')->move($rutaOrigen, $rutaNueva);
                    }
                }

                $imagen->imagen = $rutaNueva;
                $imagen->save();
            }
        }

        $this->info('Reorganización de imágenes completada.');

        return self::SUCCESS;
    }
}

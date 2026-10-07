<?php

namespace App\Support;

class Miniatura
{
    public const ANCHOS = [500];

    /**
     * URL de la miniatura de una imagen del disco "public", o null si la imagen no existe.
     * La fecha de modificación va en la URL para que el navegador pueda guardarla en caché
     * sin quedarse con una versión vieja cuando la imagen se reemplaza.
     */
    public static function url(?string $ruta, int $ancho = 500): ?string
    {
        if (!$ruta) {
            return null;
        }

        $version = @filemtime(storage_path('app/public/' . $ruta));

        if ($version === false) {
            return null;
        }

        // La ruta va como parámetro (?r=) para que la URL no termine en .jpg/.png:
        // algunos servidores atienden esas extensiones como archivos estáticos sin pasar por Laravel.
        return route('miniatura', ['w' => $ancho, 'v' => $version, 'r' => $ruta]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Support\Miniatura;
use Illuminate\Support\Facades\File;

/**
 * Sirve versiones reducidas (WEBP) de las imágenes del disco "public".
 * La primera vez la genera y la guarda en storage/app/miniaturas; después la entrega desde ahí.
 */
class MiniaturaController extends Controller
{
    public function __invoke(int $ancho, int $version, string $ruta)
    {
        abort_unless(in_array($ancho, Miniatura::ANCHOS, true), 404);

        $base = realpath(storage_path('app/public'));
        $origen = realpath($base . DIRECTORY_SEPARATOR . $ruta);

        abort_unless($origen && str_starts_with($origen, $base . DIRECTORY_SEPARATOR) && is_file($origen), 404);

        $destino = storage_path("app/miniaturas/{$ancho}/{$version}/{$ruta}.webp");

        if (is_file($destino) || $this->generar($origen, $destino, $ancho)) {
            return $this->responder($destino, 'image/webp');
        }

        // Sin GD o imagen no compatible: se entrega la original.
        return $this->responder($origen, File::mimeType($origen) ?: 'application/octet-stream');
    }

    private function generar(string $origen, string $destino, int $ancho): bool
    {
        if (!function_exists('imagecreatefromstring') || !function_exists('imagewebp')) {
            return false;
        }

        @ini_set('memory_limit', '512M');

        $imagen = @imagecreatefromstring((string) file_get_contents($origen));

        if (!$imagen) {
            return false;
        }

        $anchoOriginal = imagesx($imagen);
        $altoOriginal = imagesy($imagen);
        $anchoFinal = min($ancho, $anchoOriginal);
        $altoFinal = max(1, (int) round($altoOriginal * $anchoFinal / $anchoOriginal));

        $miniatura = imagecreatetruecolor($anchoFinal, $altoFinal);
        imagealphablending($miniatura, false);
        imagesavealpha($miniatura, true);
        imagefill($miniatura, 0, 0, imagecolorallocatealpha($miniatura, 0, 0, 0, 127));
        imagecopyresampled($miniatura, $imagen, 0, 0, 0, 0, $anchoFinal, $altoFinal, $anchoOriginal, $altoOriginal);

        File::ensureDirectoryExists(dirname($destino));
        $temporal = $destino . '.' . uniqid() . '.tmp';
        $guardado = imagewebp($miniatura, $temporal, 80);

        imagedestroy($imagen);
        imagedestroy($miniatura);

        if (!$guardado || !@rename($temporal, $destino)) {
            @unlink($temporal);

            return false;
        }

        return true;
    }

    private function responder(string $archivo, string $tipo)
    {
        return response()->file($archivo, [
            'Content-Type' => $tipo,
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);
    }
}

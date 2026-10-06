<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use ZipArchive;

class ProductoImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_zip_creates_categories_products_and_images(): void
    {
        Storage::fake('public');
        $marca = Marca::create(['nombre' => 'Epson', 'slug' => 'epson', 'estado' => true]);
        $usuario = User::factory()->create();

        $this->actingAs($usuario)
            ->post(route('productos.importar.store'), [
                'marca_id' => $marca->id,
                'archivo' => $this->zip([
                    'Impresoras/Impresora TM-T20.png' => $this->png(),
                    'Impresoras/notas.txt' => 'texto',
                    'suelta.png' => $this->png(),
                ]),
            ])
            ->assertRedirect(route('productos.importar'))
            ->assertSessionHas('resultado', fn ($resultado) => count($resultado['creados']) === 1
                && count($resultado['omitidos']) === 2);

        $categoria = Categoria::where('nombre', 'Impresoras')->firstOrFail();
        $producto = Producto::where('nombre', 'Impresora TM-T20')->firstOrFail();

        $this->assertSame($categoria->id, $producto->categoria_id);
        $this->assertSame($marca->id, $producto->marca_id);
        Storage::disk('public')->assertExists($producto->imagenes()->first()->imagen);
    }

    private function zip(array $archivos): UploadedFile
    {
        $ruta = tempnam(sys_get_temp_dir(), 'zip');
        $zip = new ZipArchive();
        $zip->open($ruta, ZipArchive::OVERWRITE);

        foreach ($archivos as $nombre => $contenido) {
            $zip->addFromString($nombre, $contenido);
        }

        $zip->close();

        return new UploadedFile($ruta, 'productos.zip', 'application/zip', null, true);
    }

    private function png(): string
    {
        return base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==');
    }
}

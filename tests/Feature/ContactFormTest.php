<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ViewErrorBag;
use App\Models\Contacto;
use App\Models\User;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_contact_form_includes_its_origin(): void
    {
        $html = view('partials.formcontacto', [
            'origen' => 'home',
            'errors' => new ViewErrorBag(),
        ])->render();

        $this->assertStringContainsString('name="origen" value="home"', $html);
        $this->assertStringContainsString('contactoAjaxForm', $html);
    }

    public function test_contact_page_form_uses_ajax_and_contact_origin(): void
    {
        $this->get(route('contacto'))
            ->assertOk()
            ->assertSee('class="space-y-6 contactoAjaxForm"', false)
            ->assertSee('enctype="multipart/form-data"', false)
            ->assertSee('name="origen" value="contacto"', false);
    }

    public function test_contact_form_submission_from_home_redirects_to_home(): void
    {
        $this->post(route('contacto.store'), [
            'nombre' => 'Usuario de prueba',
            'telefono' => '5551234',
            'email' => 'prueba@example.com',
            'mensaje' => 'Mensaje de prueba',
            'origen' => 'home',
        ])
            ->assertRedirect(route('home'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('contactos', ['email' => 'prueba@example.com']);
    }

    public function test_ajax_contact_submission_returns_success_json(): void
    {
        $this->postJson(route('contacto.store'), [
            'nombre' => 'Usuario AJAX',
            'email' => 'ajax@example.com',
            'mensaje' => 'Mensaje enviado sin recargar',
            'origen' => 'home',
        ])
            ->assertOk()
            ->assertJson(['message' => 'Su mensaje ha sido enviado.']);

        $this->assertDatabaseHas('contactos', ['email' => 'ajax@example.com']);
    }

    public function test_contact_form_stores_an_optional_document(): void
    {
        Storage::fake('local');
        $documento = UploadedFile::fake()->create('rut.pdf', 100, 'application/pdf');

        $this->postJson(route('contacto.store'), [
            'nombre' => 'Usuario con documento',
            'email' => 'documento@example.com',
            'mensaje' => 'Mensaje con documento adjunto',
            'archivo' => $documento,
        ])
            ->assertOk()
            ->assertJson(['message' => 'Su mensaje ha sido enviado.']);

        $contacto = Contacto::where('email', 'documento@example.com')->firstOrFail();

        $this->assertNotNull($contacto->archivo);
        Storage::disk('local')->assertExists($contacto->archivo);
    }

    public function test_invalid_document_returns_json_errors_instead_of_redirect(): void
    {
        Storage::fake('local');
        $documento = UploadedFile::fake()->create('rut.exe', 100, 'application/octet-stream');

        $this->postJson(route('contacto.store'), [
            'nombre' => 'Usuario con documento',
            'email' => 'documento@example.com',
            'mensaje' => 'Mensaje con documento adjunto',
            'archivo' => $documento,
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('archivo');
    }

    public function test_admin_can_download_a_contact_document(): void
    {
        Storage::fake('local');
        Storage::disk('local')->put('contactos/rut.pdf', 'Documento de prueba');
        $contacto = Contacto::create([
            'nombre' => 'Usuario con documento',
            'email' => 'documento@example.com',
            'mensaje' => 'Mensaje con documento adjunto',
            'archivo' => 'contactos/rut.pdf',
        ]);
        $usuario = User::factory()->create();

        $this->actingAs($usuario)
            ->get(route('contactos.archivo', $contacto))
            ->assertOk()
            ->assertDownload('rut.pdf');
    }
}
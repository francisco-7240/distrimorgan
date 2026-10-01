<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\ViewErrorBag;
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
}
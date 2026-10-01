<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_management_pages_require_authentication(): void
    {
        $this->get(route('usuarios.index'))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_view_user_management_pages(): void
    {
        $admin = User::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($admin)
            ->get(route('usuarios.index'))
            ->assertOk();

        $this->get(route('usuarios.create'))->assertOk();
        $this->get(route('usuarios.edit', $user))->assertOk();
    }

    public function test_authenticated_user_can_create_a_user(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('usuarios.store'), [
                'name' => 'Nuevo Usuario',
                'email' => 'nuevo@example.com',
                'password' => 'StrongPassword123!',
                'password_confirmation' => 'StrongPassword123!',
            ])
            ->assertRedirect(route('usuarios.index'));

        $user = User::where('email', 'nuevo@example.com')->firstOrFail();

        $this->assertSame('Nuevo Usuario', $user->name);
        $this->assertTrue(Hash::check('StrongPassword123!', $user->password));
    }

    public function test_user_can_be_edited_and_password_changed(): void
    {
        $admin = User::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($admin)
            ->put(route('usuarios.update', $user), [
                'name' => 'Nombre actualizado',
                'email' => $user->email,
                'password' => 'AnotherStrong123!',
                'password_confirmation' => 'AnotherStrong123!',
            ])
            ->assertRedirect(route('usuarios.edit', $user));

        $this->assertSame('Nombre actualizado', $user->fresh()->name);
        $this->assertTrue(Hash::check('AnotherStrong123!', $user->fresh()->password));
    }

    public function test_empty_password_keeps_the_existing_password(): void
    {
        $admin = User::factory()->create();
        $user = User::factory()->create();
        $originalPassword = $user->password;

        $this->actingAs($admin)
            ->put(route('usuarios.update', $user), [
                'name' => $user->name,
                'email' => $user->email,
                'password' => '',
                'password_confirmation' => '',
            ])
            ->assertRedirect(route('usuarios.edit', $user));

        $this->assertSame($originalPassword, $user->fresh()->password);
    }
}
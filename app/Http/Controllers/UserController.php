<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->string('buscar')->toString());

        $users = User::query()
            ->when($search !== '', fn ($query) => $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            }))
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('usuarios.index', compact('users', 'search'));
    }

    public function create(): View
    {
        return view('usuarios.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create($validated);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $usuario): View
    {
        return view('usuarios.edit', ['user' => $usuario]);
    }

    public function update(Request $request, User $usuario): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$usuario->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $password = $validated['password'] ?? null;
        unset($validated['password']);

        $usuario->fill($validated);

        if ($password !== null) {
            $usuario->password = $password;
        }

        $usuario->save();

        return redirect()->route('usuarios.edit', $usuario)->with('success', 'Usuario actualizado correctamente.');
    }
}
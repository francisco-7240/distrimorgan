<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ColorController extends Controller
{
    public function index()
    {
        $colores = Color::withCount('productos')
            ->orderBy('nombre')
            ->paginate(10);

        return view('colores.index', compact('colores'));
    }

    public function create()
    {
        return view('colores.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['nombre']);
        $data['estado'] = $request->boolean('estado');

        Color::create($data);

        return redirect()->route('colores.index')->with('success', 'Color creado correctamente.');
    }

    public function edit(Color $color)
    {
        return view('colores.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['nombre'], $color->id);
        $data['estado'] = $request->boolean('estado');

        $color->update($data);

        return redirect()->route('colores.index')->with('success', 'Color actualizado correctamente.');
    }

    public function destroy(Color $color)
    {
        if ($color->productoColores()->exists()) {
            return back()->with('error', 'No se puede eliminar un color asociado a productos.');
        }

        $color->delete();

        return redirect()->route('colores.index')->with('success', 'Color eliminado correctamente.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'codigo_hex' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'estado' => ['nullable', 'boolean'],
        ], [
            'codigo_hex.regex' => 'El código debe tener el formato #RRGGBB.',
        ]);
    }

    private function uniqueSlug(string $nombre, ?int $colorId = null): string
    {
        $base = Str::slug($nombre);
        $slug = $base;
        $number = 1;

        while (Color::where('slug', $slug)
            ->when($colorId, fn ($query) => $query->where('id', '!=', $colorId))
            ->exists()) {
            $slug = $base . '-' . $number++;
        }

        return $slug;
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::withCount('productos')->orderBy('nombre')->paginate(10);

        return view('marcas.index', compact('marcas'));
    }

    public function create()
    {
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['nombre']);
        $data['estado'] = $request->boolean('estado');

        Marca::create($data);

        return redirect()->route('marcas.index')->with('success', 'Marca creada correctamente.');
    }

    public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, Marca $marca)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['nombre'], $marca->id);
        $data['estado'] = $request->boolean('estado');

        $marca->update($data);

        return redirect()->route('marcas.index')->with('success', 'Marca actualizada correctamente.');
    }

    public function destroy(Marca $marca)
    {
        if ($marca->productos()->exists()) {
            return back()->with('error', 'No se puede eliminar una marca que tiene productos asociados.');
        }

        $marca->delete();

        return redirect()->route('marcas.index')->with('success', 'Marca eliminada correctamente.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'estado' => ['nullable', 'boolean'],
        ]);
    }

    private function uniqueSlug(string $nombre, ?int $marcaId = null): string
    {
        $base = Str::slug($nombre);
        $slug = $base;
        $number = 1;

        while (Marca::where('slug', $slug)
            ->when($marcaId, fn ($query) => $query->where('id', '!=', $marcaId))
            ->exists()) {
            $slug = $base . '-' . $number++;
        }

        return $slug;
    }
}

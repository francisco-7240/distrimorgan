<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::withCount('productos')->orderBy('nombre')->paginate(10);

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['nombre']);
        $data['estado'] = $request->boolean('estado');

        Categoria::create($data);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['nombre'], $categoria->id);
        $data['estado'] = $request->boolean('estado');

        $categoria->update($data);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        if ($categoria->productos()->exists()) {
            return back()->with('error', 'No se puede eliminar una categoría que tiene productos asociados.');
        }

        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'estado' => ['nullable', 'boolean'],
        ]);
    }

    private function uniqueSlug(string $nombre, ?int $categoriaId = null): string
    {
        $base = Str::slug($nombre);
        $slug = $base;
        $number = 1;

        while (Categoria::where('slug', $slug)
            ->when($categoriaId, fn ($query) => $query->where('id', '!=', $categoriaId))
            ->exists()) {
            $slug = $base . '-' . $number++;
        }

        return $slug;
    }
}

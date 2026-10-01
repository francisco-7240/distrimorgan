<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::withCount('productos')
            ->with('categoriaPadre')
            ->orderBy('nombre')
            ->paginate(10);

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        $categoriasPadre = $this->categoriasPadre();

        return view('categorias.create', compact('categoriasPadre'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['nombre']);
        $data['estado'] = $request->boolean('estado');
        $data['categoria_padre_id'] = $request->input('categoria_padre_id') ?: null;

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $this->storeOriginalImage($request->file('imagen'));
        }

        Categoria::create($data);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit(Categoria $categoria)
    {
        $categoriasPadre = $this->categoriasPadre($categoria->id);

        return view('categorias.edit', compact('categoria', 'categoriasPadre'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $data = $this->validated($request, $categoria);
        $data['slug'] = $this->uniqueSlug($data['nombre'], $categoria->id);
        $data['estado'] = $request->boolean('estado');
        $data['categoria_padre_id'] = $request->input('categoria_padre_id') ?: null;
        $imagenAnterior = $categoria->imagen;

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $this->storeOriginalImage($request->file('imagen'));
        }

        $categoria->update($data);

        if (
            $request->hasFile('imagen')
            && $imagenAnterior
            && !in_array($imagenAnterior, ['img-categoria.jpg', 'categoria-default.jpg'], true)
            && !Categoria::where('imagen', $imagenAnterior)->exists()
        ) {
            Storage::disk('public')->delete('categorias/' . $imagenAnterior);
        }

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        if ($categoria->subcategorias()->exists()) {
            return back()->with('error', 'No se puede eliminar una categoría que tiene subcategorías asociadas.');
        }

        if ($categoria->productos()->exists()) {
            return back()->with('error', 'No se puede eliminar una categoría que tiene productos asociados.');
        }

        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente.');
    }

    private function validated(Request $request, ?Categoria $categoria = null): array
    {
        return $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'categoria_padre_id' => [
                'nullable',
                'integer',
                'exists:categorias,id',
                Rule::notIn(array_filter([$categoria?->id])),
            ],
            'descripcion' => ['nullable', 'string'],
            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'estado' => ['nullable', 'boolean'],
        ], [
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser JPG, PNG o WEBP.',
            'imagen.max' => 'La imagen no debe superar los 2 MB.',
        ]);
    }

    private function categoriasPadre(?int $categoriaId = null)
    {
        return Categoria::whereNull('categoria_padre_id')
            ->when($categoriaId, fn ($query) => $query->where('id', '!=', $categoriaId))
            ->orderBy('nombre')
            ->get();
    }

    private function storeOriginalImage(UploadedFile $image): string
    {
        $originalName = basename(str_replace('\\', '/', $image->getClientOriginalName()));
        $image->storeAs('categorias', $originalName, 'public');

        return $originalName;
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

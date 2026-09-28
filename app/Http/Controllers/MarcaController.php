<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $this->storeOriginalImage($request->file('imagen'), $data['slug']);
        }

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
        $imagenAnterior = $marca->imagen;

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $this->storeOriginalImage($request->file('imagen'), $data['slug']);
        }

        $marca->update($data);

        if ($request->hasFile('imagen') && $imagenAnterior && !Marca::where('imagen', $imagenAnterior)->exists()) {
            Storage::disk('public')->delete($imagenAnterior);
        }

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
            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'estado' => ['nullable', 'boolean'],
        ], [
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser JPG, PNG o WEBP.',
            'imagen.max' => 'La imagen no debe superar los 2 MB.',
        ]);
    }

    private function storeOriginalImage(UploadedFile $image, string $slug): string
    {
        $originalName = basename(str_replace('\\', '/', $image->getClientOriginalName()));
        $path = 'marcas/' . $slug . '/' . $originalName;
        $image->storeAs('marcas/' . $slug, $originalName, 'public');

        return $path;
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

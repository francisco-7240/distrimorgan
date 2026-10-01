<div><label for="nombre" class="mb-1 block text-sm font-semibold">Nombre</label><input id="nombre" name="nombre" value="{{ old('nombre', $categoria->nombre ?? '') }}" required class="w-full rounded-lg border-gray-300"><x-input-error :messages="$errors->get('nombre')" class="mt-1" /></div>
<div>
	<label for="categoria_padre_id" class="mb-1 block text-sm font-semibold">Categoría padre</label>
	<select id="categoria_padre_id" name="categoria_padre_id" class="w-full rounded-lg border-gray-300">
		<option value="">Sin categoría padre (categoría principal)</option>
		@foreach ($categoriasPadre as $categoriaPadre)
			<option value="{{ $categoriaPadre->id }}" @selected(old('categoria_padre_id', $categoria->categoria_padre_id ?? '') == $categoriaPadre->id)>{{ $categoriaPadre->nombre }}</option>
		@endforeach
	</select>
	<x-input-error :messages="$errors->get('categoria_padre_id')" class="mt-1" />
</div>
<div><label for="descripcion" class="mb-1 block text-sm font-semibold">Descripción</label><textarea id="descripcion" name="descripcion" rows="4" class="w-full rounded-lg border-gray-300">{{ old('descripcion', $categoria->descripcion ?? '') }}</textarea></div>
@if (isset($categoria) && $categoria->imagen && \Illuminate\Support\Facades\Storage::disk('public')->exists('categorias/' . $categoria->imagen))
	<div>
		<p class="mb-2 text-sm font-semibold">Imagen actual</p>
		<img src="{{ asset('storage/categorias/' . $categoria->imagen) }}" alt="{{ $categoria->nombre }}" class="h-40 w-full rounded-lg object-cover sm:w-64">
	</div>
@endif
<div>
	<label for="imagen" class="mb-1 block text-sm font-semibold">Imagen de categoría</label>
	<input id="imagen" name="imagen" type="file" accept="image/jpeg,image/png,image/webp" class="w-full rounded-lg border border-gray-300 p-2">
	<p class="mt-1 text-xs text-gray-500">JPG, PNG o WEBP, máximo 2 MB. Si no eliges una imagen, se conserva la actual.</p>
	<x-input-error :messages="$errors->get('imagen')" class="mt-1" />
</div>
<label class="flex items-center gap-2"><input type="checkbox" name="estado" value="1" @checked(old('estado', $categoria->estado ?? true))> Activa</label>

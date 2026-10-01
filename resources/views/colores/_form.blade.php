<div>
    <label for="nombre" class="mb-1 block text-sm font-semibold text-gray-700">Nombre</label>
    <input id="nombre" name="nombre" type="text" value="{{ old('nombre', $color->nombre ?? '') }}" required class="w-full rounded-lg border-gray-300 px-3 py-3 text-gray-900">
    @error('nombre')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
</div>

<div>
    <label for="codigo_hex" class="mb-1 block text-sm font-semibold text-gray-700">Código hexadecimal</label>
    <div class="flex gap-3">
        <input id="codigo_hex" name="codigo_hex" type="color" value="{{ old('codigo_hex', $color->codigo_hex ?? '#000000') }}" class="h-12 w-16 rounded border-gray-300">
        <input type="text" value="{{ old('codigo_hex', $color->codigo_hex ?? '#000000') }}" readonly class="w-full rounded-lg border-gray-300 bg-gray-100 px-3 py-3 text-gray-900" aria-label="Código hexadecimal seleccionado">
    </div>
    @error('codigo_hex')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
</div>

<div>
    <label for="estado" class="mb-1 block text-sm font-semibold text-gray-700">Estado</label>
    <select id="estado" name="estado" class="w-full rounded-lg border-gray-300 px-3 py-3 text-gray-900">
        <option value="1" @selected(old('estado', $color->estado ?? true))>Activo</option>
        <option value="0" @selected(old('estado', $color->estado ?? true) == 0)>Inactivo</option>
    </select>
</div>

<script>
    const colorPicker = document.getElementById('codigo_hex');
    const colorValue = colorPicker?.nextElementSibling;
    colorPicker?.addEventListener('input', () => {
        colorValue.value = colorPicker.value.toUpperCase();
    });
</script>
<x-app-layout>
    <x-slot name="header">
        <div class="flex w-full justify-between mb-4">
            <h1 class="font-black">Editar producto</h1>
            
            <a href="{{ route('productos.index') }}" class="rounded-lg bg-red-600 px-4 py-2 text-white">Volver</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-6 rounded-lg bg-gray-100 p-6 lg:grid-cols-3">
            @csrf
            @method('PUT')
            
            <div class="lg:col-span-2 space-y-6">

                <!-- Título -->
                <div>
                    <label for="titulo" class="block text-sm font-semibold text-gray-700 mb-1">Título</label>
                    <input 
                        type="text" 
                        name="nombre"
                        id="nombre"
                        class="w-full rounded-lg border-gray-300 px-3 py-3 text-gray-900"
                        value="{{ old('nombre', $producto->nombre) }}"
                        required
                    >
                </div>

                <!-- Contenido -->
                <div>
                    <label for="contenido" class="block text-sm font-semibold text-gray-700 mb-1">Contenido</label>
                    <textarea 
                        name="descripcion"
                        id="descripcion"
                        rows="12"
                        class="w-full rounded-lg border-gray-300 px-3 py-3 text-gray-900"
                    >{{ old('descripcion', $producto->descripcion) }}</textarea>
                </div>

            </div>

            <div class="space-y-6">

                <!-- Imagen Portada -->
                <div>
                    <label for="imagen_portada" class="block text-sm font-semibold text-gray-700 mb-1">Imagen de portada</label>
                    @php($imagenPortada = $producto->imagenes->where('es_portada', true)->first())
                    @if ($imagenPortada)
                        <img src="{{ asset('storage/productos/' . $imagenPortada->imagen) }}" alt="{{ $producto->nombre }}" class="mb-3 h-40 w-full rounded-lg object-cover">
                    @endif
                    <input 
                        type="file" 
                        name="imagen_portada" 
                        id="imagen_portada"
                        accept="image/*"
                        class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-3 text-sm text-gray-900"
                    >
                    @error('imagen_portada')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Categoría -->
                <div>
                    <label for="categoria_id" class="block text-sm font-semibold text-gray-700 mb-1">Categoría</label>
                    <select 
                        name="categoria_id" 
                        id="categoria_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        required
                    >
                        <option value="">-- Selecciona una categoría --</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" @selected(old('categoria_id', $producto->categoria_id) == $categoria->id)>{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="marca_id" class="block text-sm font-semibold text-gray-700 mb-1">Marca</label>
                    <select name="marca_id" id="marca_id" required class="w-full rounded-lg border-gray-300 px-3 py-3 text-gray-900">
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}" @selected(old('marca_id', $producto->marca_id) == $marca->id)>{{ $marca->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="estado" class="block text-sm font-semibold text-gray-700 mb-1">Estado</label>
                    <select name="estado" id="estado" required class="w-full rounded-lg border-gray-300 px-3 py-3 text-gray-900">
                        <option value="1" @selected(old('estado', $producto->estado) == 1)>Activo</option>
                        <option value="0" @selected(old('estado', $producto->estado) == 0)>Inactivo</option>
                    </select>
                </div>

                <!-- Botón -->
                <div class="pt-4">
                    <button 
                        type="submit"
                        class="flex text-center justify-center gap-2 w-full bg-blue-600 text-white font-semibold py-2 rounded-lg shadow hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 cursor-pointer"
                    >
                        Guardar cambios
                    </button>
                </div>
            </div>

        </form>
        </div>
    </div>
    </div>

    <!-- 🧠 Script para previsualizar la imagen -->
</x-app-layout>


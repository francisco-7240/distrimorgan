<x-app-layout>

    <x-slot name="header">
        <div class="flex w-full justify-between">
            <h1 class="text-center content-center font-black">Listado de Productos</h1>           
            <a href="{{ route('productos.create') }}" class="flex w-48 px-4 py-2 border-green-700 rounded-lg text-white bg-green-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg> Agregar Producto</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
            <div class="container w-full">

                <!-- Filtros -->
                <form method="GET" action="{{ route('productos.index') }}" class="flex flex-wrap gap-3 mb-4">
                    <!-- Filtros de nombre -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 w-full">
                        <div class="flex flex-col gap-2 w-full">
                            <label for="buscar" class="text-gray-700 text-sm font-semibold">Producto:</label>
                            <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar por nombre..."class="border border-gray-300 rounded-lg p-2">
                        </div>

                        <!-- Filtros de categoria -->
                        <div class="flex flex-col gap-2 w-full">
                            <label for="categoria_id" class="text-gray-700 text-sm font-semibold">Categoría:</label>
                            <select name="categoria_id" class="border border-gray-300 rounded-lg p-2">
                                <option class="text-gray-900" value="">Todas las categorías</option>
                                @foreach($categorias as $categoria)
                                    <option class="text-gray-900"value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filtros de marcas -->
                        <div class="flex flex-col gap-2 w-full">
                            <label for="marca_id" class="text-gray-700 text-sm font-semibold">Marca:</label>
                            <select name="marca_id" class="border border-gray-300 rounded-lg p-2">
                                <option class="text-gray-900" value="">Todas las marcas</option>
                                @foreach($marcas as $marca)
                                    <option class="text-gray-900"value="{{ $marca->id }}" {{ request('marca_id') == $marca->id ? 'selected' : '' }}>
                                        {{ $marca->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filtros de fecha -->
                        <div class="flex flex-col gap-2 w-full">
                            <label for="fecha_inicio" class="text-gray-700 text-sm font-semibold">Fecha de inicio:</label>
                            <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}" class="border border-gray-300 rounded-lg p-2">
                        </div>

                        <div class="flex flex-col gap-2 w-full">
                            <label for="fecha_fin" class="text-gray-700 text-sm font-semibold">Fecha de fin:</label>
                            <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" class="border border-gray-300 rounded-lg p-2">
                        </div>

                        <div class="flex flex-col gap-2 w-full">
                            <label class="text-gray-700 text-sm font-semibold"></label>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex w-4/5 sm:w-48 text-center justify-center gap-2 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg> Buscar
                            </button>
                        </div>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border border-gray-200">
                        <thead class="bg-gray-100 text-gray-800">
                            <tr>
                                <th class="px-4 py-2 border">ID</th>
                                <th class="px-4 py-2 border">Título</th>
                                <th class="px-4 py-2 border">Categoría</th>
                                <th class="px-4 py-2 border">Marca</th>
                                <th class="px-4 py-2 border">Fecha</th>
                                <th class="px-4 py-2 border">Imagen</th>
                                <th class="px-4 py-2 border text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productos as $producto)
                            @php
                                $imagenPortada = $producto->imagenes
                                    ->where('es_portada', true)
                                    ->first();
                            @endphp
                                <tr class="hover:bg-blue-50 hover:text-gray-900">
                                    <td class="px-4 py-2 border">{{ $producto->id }}</td>
                                    <td class="px-4 py-2 border">{{ $producto->nombre }}</td>
                                    <td class="px-4 py-2 border">{{ $producto->categoria?->nombre ?? 'Sin categoría' }}</td>
                                    <td class="px-4 py-2 border">{{ $producto->marca?->nombre ?? 'Sin marca' }}</td>
                                    <td class="px-4 py-2 border">{{ $producto->created_at->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2 border">
                                        @if($imagenPortada)
                                            <img src="{{ asset('storage/productos/' . $imagenPortada->imagen) }}" class="h-10 rounded" alt="imagen">
                                        @else
                                            <span class="text-gray-400 italic">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border text-center flex justify-center gap-2">
                                        <a href="/productos/{{ $producto->slug }}/{{ $producto->id }}" target="_blank"
                                        class="p-2 text-yellow-500 hover:text-yellow-700 transition" 
                                        title="Ver">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                        </a>

                                        <a href="{{ route('productos.edit', $producto->id) }}" 
                                        class="p-2 text-green-500 hover:text-green-700 transition" 
                                        title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil-icon lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                                        </a>

                                        <form 
                                            action="{{ route('productos.destroy', $producto->id) }}" 
                                            method="POST" 
                                            class="inline-block eliminar-producto"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="p-2 text-red-500 hover:text-red-700 transition cursor-pointer"
                                                title="Eliminar"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-3 text-center text-gray-500 border">No hay productos registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Paginación --}}
                <div class="mt-3">
                    {{ $productos->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.eliminar-producto').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción eliminará la producto permanentemente",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
        </script>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="font-black">Categorías</h1>
            <a href="{{ route('categorias.create') }}" class="rounded-lg bg-green-600 px-4 py-2 text-white">Agregar categoría</a>
        </div>
    </x-slot>

    <main class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('success'))<div class="mb-4 rounded-lg bg-green-100 p-4 text-green-800">{{ session('success') }}</div>@endif
            @if (session('error'))<div class="mb-4 rounded-lg bg-red-100 p-4 text-red-800">{{ session('error') }}</div>@endif
            <div class="overflow-x-auto rounded-lg bg-white shadow">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-100"><tr><th class="px-4 py-3">Nombre</th><th class="px-4 py-3">Productos</th><th class="px-4 py-3">Estado</th><th class="px-4 py-3 text-right">Acciones</th></tr></thead>
                    <tbody>
                        @forelse ($categorias as $categoria)
                            <tr class="border-t"><td class="px-4 py-3 font-semibold">{{ $categoria->nombre }}</td><td class="px-4 py-3">{{ $categoria->productos_count }}</td><td class="px-4 py-3">{{ $categoria->estado ? 'Activa' : 'Inactiva' }}</td><td class="px-4 py-3 text-right"><a href="{{ route('categorias.edit', $categoria) }}" class="mr-3 text-green-600">Editar</a><form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta categoría?')">@csrf @method('DELETE')<button class="text-red-600" type="submit">Eliminar</button></form></td></tr>
                        @empty
                            <tr><td colspan="4" class="px-4 py-6 text-center text-gray-500">No hay categorías registradas.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $categorias->links() }}</div>
        </div>
    </main>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h1 class="font-black">Colores</h1>
            <a href="{{ route('colores.create') }}" class="rounded-lg bg-green-600 px-4 py-2 text-white">Agregar color</a>
        </div>
    </x-slot>

    <main class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-800">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 rounded-lg bg-red-100 p-4 text-red-800">{{ session('error') }}</div>
            @endif

            <div class="overflow-x-auto rounded-lg bg-white shadow">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3">Color</th>
                            <th class="px-4 py-3">Código</th>
                            <th class="px-4 py-3">Productos</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($colores as $color)
                            <tr class="border-t">
                                <td class="px-4 py-3 font-semibold">
                                    <span class="mr-2 inline-block h-6 w-6 rounded-full border align-middle" style="background-color: {{ $color->codigo_hex }}"></span>
                                    {{ $color->nombre }}
                                </td>
                                <td class="px-4 py-3 uppercase">{{ $color->codigo_hex }}</td>
                                <td class="px-4 py-3">{{ $color->productos_count }}</td>
                                <td class="px-4 py-3">{{ $color->estado ? 'Activo' : 'Inactivo' }}</td>
                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('colores.edit', $color) }}" class="mr-3 text-green-600">Editar</a>
                                    <form action="{{ route('colores.destroy', $color) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar este color?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600" type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-6 text-center text-gray-500">No hay colores registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $colores->links() }}</div>
        </div>
    </main>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <div class="flex w-full items-center justify-between">
            <h1 class="font-black">Visualizar producto</h1>
            <a href="{{ route('productos.index') }}" class="rounded-lg bg-gray-700 px-4 py-2 text-white">Volver</a>
        </div>
    </x-slot>

    <main class="py-12">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <article class="overflow-hidden rounded-lg bg-white shadow">
                @php($imagenPortada = $producto->imagenes->where('es_portada', true)->first())
                @if ($imagenPortada)
                    <img src="{{ asset('storage/' . $imagenPortada->imagen) }}" alt="{{ $producto->nombre }}" class="h-80 w-full object-cover">
                @endif

                <div class="space-y-6 p-6">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900">{{ $producto->nombre }}</h2>
                            <p class="mt-2 text-sm text-gray-500">Publicado el {{ $producto->created_at->format('d/m/Y') }}</p>
                        </div>
                        <span class="rounded-full px-3 py-1 text-sm font-semibold {{ $producto->estado ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $producto->estado ? 'Activo' : 'Inactivo' }}</span>
                    </div>

                    <dl class="grid grid-cols-1 gap-4 border-y py-5 sm:grid-cols-2">
                        <div><dt class="text-sm text-gray-500">Categoría</dt><dd class="font-semibold">{{ $producto->categoria?->nombre ?? 'Sin categoría' }}</dd></div>
                        <div><dt class="text-sm text-gray-500">Marca</dt><dd class="font-semibold">{{ $producto->marca?->nombre ?? 'Sin marca' }}</dd></div>
                    </dl>

                    <div class="prose max-w-none whitespace-pre-line text-gray-800">{{ $producto->descripcion }}</div>

                    @if ($producto->productoColores->isNotEmpty())
                        <div>
                            <h3 class="mb-3 text-lg font-bold">Colores disponibles</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($producto->productoColores as $productoColor)
                                    <span class="rounded-full border px-3 py-1 text-sm">{{ $productoColor->color?->nombre ?? 'Predeterminado' }}{{ $productoColor->stock !== null ? ' - Stock: ' . $productoColor->stock : '' }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </article>
        </div>
    </main>
</x-app-layout>

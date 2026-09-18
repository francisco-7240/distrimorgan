<x-app-layout>
    <x-slot name="header"><div class="flex items-center justify-between"><h1 class="font-black">Editar categoría</h1><a href="{{ route('categorias.index') }}" class="rounded-lg bg-gray-700 px-4 py-2 text-white">Volver</a></div></x-slot>
    <main class="py-12"><div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8"><form action="{{ route('categorias.update', $categoria) }}" method="POST" class="space-y-5 rounded-lg bg-white p-6 shadow">@csrf @method('PUT') @include('categorias._form', ['categoria' => $categoria])<button class="rounded-lg bg-blue-600 px-4 py-2 text-white">Actualizar</button></form></div></main>
</x-app-layout>

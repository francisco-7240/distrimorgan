<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ config('app.name') }} - Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid gap-4 p-6 text-gray-900 md:grid-cols-3">
                    <a href="{{ route('productos.index') }}" class="rounded-lg border p-5 shadow-sm hover:bg-gray-50"><h3 class="font-bold">Productos</h3><p class="mt-1 text-sm text-gray-500">Gestionar catálogo</p></a>
                    <a href="{{ route('categorias.index') }}" class="rounded-lg border p-5 shadow-sm hover:bg-gray-50"><h3 class="font-bold">Categorías</h3><p class="mt-1 text-sm text-gray-500">Gestionar categorías</p></a>
                    <a href="{{ route('marcas.index') }}" class="rounded-lg border p-5 shadow-sm hover:bg-gray-50"><h3 class="font-bold">Marcas</h3><p class="mt-1 text-sm text-gray-500">Gestionar marcas</p></a>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

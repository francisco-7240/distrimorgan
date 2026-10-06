<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="font-black">Importar productos desde ZIP</h1>
            <a href="{{ route('productos.index') }}" class="rounded-lg bg-gray-700 px-4 py-2 text-white">Volver</a>
        </div>
    </x-slot>

    <main class="py-12">
        <div class="mx-auto max-w-3xl space-y-6 px-4 sm:px-6 lg:px-8">

            @if (session('error'))
                <div class="rounded-lg bg-red-100 p-4 text-red-700">{{ session('error') }}</div>
            @endif

            @if ($resultado = session('resultado'))
                <div class="space-y-3 rounded-lg bg-white p-6 shadow">
                    <h2 class="text-lg font-bold">Resultado de la importación</h2>
                    <p class="text-green-700">Productos creados: <strong>{{ count($resultado['creados']) }}</strong></p>
                    <p class="text-blue-700">Imágenes actualizadas: <strong>{{ count($resultado['actualizados']) }}</strong></p>
                    <p class="text-red-700">Archivos omitidos: <strong>{{ count($resultado['omitidos']) }}</strong></p>

                    @if (count($resultado['omitidos']))
                        <ul class="max-h-64 list-disc overflow-y-auto pl-5 text-sm text-red-700">
                            @foreach ($resultado['omitidos'] as $omitido)
                                <li>{{ $omitido }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endif

            <div class="rounded-lg bg-white p-6 text-sm text-gray-700 shadow">
                <h2 class="mb-2 text-base font-bold">¿Cómo debe estar el ZIP?</h2>
                <p>Cada carpeta es una <strong>categoría</strong> y cada imagen es un <strong>producto</strong>: el nombre del archivo es el nombre del producto.</p>
                <pre class="mt-3 rounded bg-gray-100 p-3 text-xs">productos.zip
├── Impresoras/
│   ├── Impresora Epson TM-T20III.jpg
│   └── Impresora Bixolon SRP-350.png
└── Balanzas/
    └── Balanza Dibal M-525.jpg</pre>
                <ul class="mt-3 list-disc space-y-1 pl-5">
                    <li>Si la categoría no existe, se crea.</li>
                    <li>Si el producto ya existe en esa categoría, solo se reemplaza su imagen.</li>
                    <li>Imágenes JPG, PNG o WEBP de máximo 10 MB cada una. ZIP de máximo 100 MB.</li>
                    <li>Los productos nuevos quedan activos y con la descripción igual al nombre; puedes editarlos después.</li>
                </ul>
            </div>

            <form action="{{ route('productos.importar.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 rounded-lg bg-white p-6 shadow" id="formImportar">
                @csrf

                <div>
                    <label for="marca_id" class="mb-1 block text-sm font-semibold">Marca de los productos nuevos</label>
                    <select id="marca_id" name="marca_id" required class="w-full rounded-lg border-gray-300">
                        <option value="">Selecciona una marca</option>
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}" @selected(old('marca_id') == $marca->id)>{{ $marca->nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('marca_id')" class="mt-1" />
                </div>

                <div>
                    <label for="archivo" class="mb-1 block text-sm font-semibold">Archivo ZIP</label>
                    <input id="archivo" name="archivo" type="file" accept=".zip,application/zip" required class="w-full rounded-lg border border-gray-300 p-2">
                    <x-input-error :messages="$errors->get('archivo')" class="mt-1" />
                </div>

                <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-white disabled:opacity-50">Importar</button>
                <p id="importandoAviso" class="hidden text-sm text-gray-600">Importando… no cierres esta página, puede tardar unos minutos.</p>
            </form>
        </div>
    </main>

    <script>
        document.getElementById('formImportar').addEventListener('submit', (event) => {
            event.target.querySelector('button[type="submit"]').disabled = true;
            document.getElementById('importandoAviso').classList.remove('hidden');
        });
    </script>
</x-app-layout>

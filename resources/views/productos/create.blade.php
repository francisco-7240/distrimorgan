<x-app-layout>

    <x-slot name="header">
        <div class="flex w-full justify-between">
            <h1 class="text-center content-center font-black">Nuevo Producto</h1>           
            <a href="{{ route('productos.index') }}" class="flex w-48 px-4 py-2 border-red-700 rounded-lg text-white bg-red-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left-icon lucide-square-arrow-left"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
            <div class="container w-full">

                <form
    action="{{ route('productos.store') }}"
    method="POST"
    enctype="multipart/form-data"
    class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-5 bg-gray-100 rounded-lg"
>
    @csrf

    <!-- Columna izquierda (70%) -->

    <div class="lg:col-span-2 space-y-6">

        <!-- nombre -->
        <div>
            <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-1">Nombre del producto</label>

            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-3 text-gray-900" placeholder="Ej: Delantal Monobloc Poliuretano" required>

            @error('nombre')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <!-- descripcion -->
        <div>
            <label for="descripcion" class="block text-sm font-semibold text-gray-700 mb-1">Descripción del producto</label>

            <textarea name="descripcion" id="descripcion" rows="12" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 resize-none px-3 py-3 text-gray-900" placeholder="Escribe la descripción completa del producto..." required>{{ old('descripcion') }}</textarea>

            @error('descripcion')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <!-- color y stock -->
        <div class="bg-white rounded-lg p-5 border border-gray-200">

            <div class="mb-4">
                <h3 class="text-base font-bold text-gray-800">
                    Colores y stock
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Indica si el producto está disponible en diferentes colores y
                    configura su stock.
                </p>
            </div>

            <!-- ¿Tiene colores? -->
            <div class="mb-5">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    ¿El producto tiene colores?
                </label>

                <div class="flex items-center gap-6">

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            type="radio"
                            name="tiene_colores"
                            value="1"
                            id="tiene_colores_si"
                            {{ old('tiene_colores') == '1' ? 'checked' : '' }}
                            class="text-blue-600 focus:ring-blue-500"
                        >

                        <span class="text-sm text-gray-700">
                            Sí
                        </span>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            type="radio"
                            name="tiene_colores"
                            value="0"
                            id="tiene_colores_no"
                            {{ old('tiene_colores', '0') == '0' ? 'checked' : '' }}
                            class="text-blue-600 focus:ring-blue-500"
                        >

                        <span class="text-sm text-gray-700">
                            No
                        </span>
                    </label>

                </div>

                @error('tiene_colores')
                    <span class="text-red-500 text-sm">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            <!-- producto con colores -->
            <div id="seccion-colores" class="{{ old('tiene_colores', '0') == '1' ? '' : 'hidden' }}">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Selecciona los colores disponibles
                </label>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                    @foreach ($colores as $color)

                        @if (!$color->es_predeterminado)

                            <label
                                class="flex items-center gap-3 border border-gray-200 rounded-lg p-3 cursor-pointer hover:bg-gray-50 transition"
                            >

                                <input type="checkbox" name="colores[]" value="{{ $color->id }}" class="color-checkbox text-blue-600 focus:ring-blue-500" data-color-id="{{ $color->id }}" data-color-nombre="{{ $color->nombre }}" {{ in_array($color->id, old('colores', [])) ? 'checked' : '' }}>

                                <span class="w-5 h-5 rounded-full border border-gray-300 shrink-0"
                                    style="background-color: {{ $color->codigo_hex }}">
                                </span>

                                <span class="text-sm text-gray-700">
                                    {{ $color->nombre }}
                                </span>

                            </label>

                        @endif

                    @endforeach

                </div>

                @error('colores')
                    <span class="text-red-500 text-sm">
                        {{ $message }}
                    </span>
                @enderror


                <!-- stock por color -->
                <div id="stock-colores" class="mt-5 space-y-3"></div>

            </div>


            <!-- producto sin color -->
            <div id="seccion-stock-general" class="{{ old('tiene_colores', '0') == '0' ? '' : 'hidden' }}">

                <label for="stock" class="block text-sm font-semibold text-gray-700 mb-1">
                    Stock
                </label>

                <input type="number" name="stock" id="stock" min="0" value="{{ old('stock') }}" placeholder="Dejar vacío para stock no controlado" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-3 text-gray-900">

                <p class="text-xs text-gray-500 mt-1">
                    Puedes dejarlo vacío si no deseas controlar el stock.
                </p>

                @error('stock')
                    <span class="text-red-500 text-sm">
                        {{ $message }}
                    </span>
                @enderror

            </div>

        </div>


        <!-- galeria -->

        <div class="bg-white rounded-lg p-5 border border-gray-200">

            <h3 class="text-base font-bold text-gray-800 mb-1">
                Galería de imágenes
            </h3>

            <p class="text-sm text-gray-500 mb-4">
                Puedes seleccionar varias imágenes adicionales del producto.
            </p>

            <input
                type="file"
                name="galeria[]"
                id="galeria"
                accept="image/*"
                multiple
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-3 py-3"
            >

            @error('galeria')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
            @enderror

            @error('galeria.*')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
            @enderror

        </div>

    </div>


    <!-- columna de la derecha -->

    <div class="space-y-6">

        <!-- categoria -->
        <div>

            <label
                for="categoria_id"
                class="block text-sm font-semibold text-gray-700 mb-1"
            >
                Categoría
            </label>

            <select
                name="categoria_id"
                id="categoria_id"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-3 text-gray-900"
                required
            >
                <option value="">
                    -- Selecciona una categoría --
                </option>

                @foreach ($categorias as $categoria)

                    <option
                        value="{{ $categoria->id }}"
                        {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}
                    >
                        {{ $categoria->nombre }}
                    </option>

                @endforeach

            </select>

            @error('categoria_id')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
            @enderror

        </div>


        <!-- marca -->
        <div>

            <label
                for="marca_id"
                class="block text-sm font-semibold text-gray-700 mb-1"
            >
                Marca
            </label>

            <select
                name="marca_id"
                id="marca_id"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-3 text-gray-900"
                required
            >
                <option value="">
                    -- Selecciona una marca --
                </option>

                @foreach ($marcas as $marca)

                    <option
                        value="{{ $marca->id }}"
                        {{ old('marca_id') == $marca->id ? 'selected' : '' }}
                    >
                        {{ $marca->nombre }}
                    </option>

                @endforeach

            </select>

            @error('marca_id')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
            @enderror

        </div>


        <!-- Imagen portada -->
        <div>

            <label
                for="imagen_portada"
                class="block text-sm font-semibold text-gray-700 mb-1"
            >
                Imagen de portada
            </label>

            <div
                id="preview-container"
                class="w-full h-56 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 overflow-hidden mb-3"
            >
                <span
                    id="preview-text"
                    class="text-gray-400"
                >
                    Previsualización
                </span>

                <img
                    id="preview-image"
                    class="hidden w-full h-full object-contain"
                    alt="Previsualización"
                >
            </div>

            <input
                type="file"
                name="imagen_portada"
                id="imagen_portada"
                accept="image/*"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-3 py-3"
                required
            >

            <p class="text-xs text-gray-500 mt-1">
                Imagen principal del producto.
            </p>

            @error('imagen_portada')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
            @enderror

        </div>


        <!-- Botón -->
        <div class="pt-4">
            <button type="submit" class="flex items-center text-center justify-center gap-2 w-full bg-blue-600 text-white font-semibold py-3 rounded-lg shadow hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg> 
                Crear producto
            </button>
        </div>

    </div>

</form>
            </div>
        </div>
    </div>

    <!-- 🧠 Script para previsualizar la imagen -->
    <script>
        document.getElementById('imagen_portada').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById('preview-image');
            const previewText = document.getElementById('preview-text');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    previewText.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.classList.add('hidden');
                previewText.classList.remove('hidden');
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

        const radioSi = document.querySelector('#tiene_colores_si');
        const radioNo = document.querySelector('#tiene_colores_no');

        const seccionColores = document.querySelector('#seccion-colores');
        const seccionStockGeneral = document.querySelector('#seccion-stock-general');

        const checkboxesColores = document.querySelectorAll('.color-checkbox');
        const contenedorStockColores = document.querySelector('#stock-colores');


        // =========================================
        // Mostrar/ocultar colores
        // =========================================

        function actualizarTipoProducto() {

            if (radioSi && radioSi.checked) {

                seccionColores?.classList.remove('hidden');
                seccionStockGeneral?.classList.add('hidden');

            } else {

                seccionColores?.classList.add('hidden');
                seccionStockGeneral?.classList.remove('hidden');

                // Desmarcar colores
                checkboxesColores.forEach(checkbox => {
                    checkbox.checked = false;
                });

                // Limpiar stock de colores
                if (contenedorStockColores) {
                    contenedorStockColores.innerHTML = '';
                }
            }
        }


        // =========================================
        // Cambio Sí / No
        // =========================================

        radioSi?.addEventListener('change', actualizarTipoProducto);
        radioNo?.addEventListener('change', actualizarTipoProducto);


        // =========================================
        // Stock por color
        // =========================================

        function actualizarStockColores() {

            if (!contenedorStockColores) return;

            const coloresSeleccionados = Array.from(
                document.querySelectorAll('.color-checkbox:checked')
            );

            contenedorStockColores.innerHTML = '';

            if (coloresSeleccionados.length === 0) {

                contenedorStockColores.innerHTML = `
                    <p class="text-sm text-gray-400 italic">
                        Selecciona al menos un color.
                    </p>
                `;

                return;
            }

            coloresSeleccionados.forEach(checkbox => {

                const colorId = checkbox.dataset.colorId;
                const colorNombre = checkbox.dataset.colorNombre;

                const contenedor = document.createElement('div');

                contenedor.className =
                    'flex flex-col sm:flex-row sm:items-center justify-between gap-3 border border-gray-200 rounded-lg p-3 bg-gray-50';

                contenedor.innerHTML = `
                    <span class="text-sm font-medium text-gray-700">
                        ${colorNombre}
                    </span>

                    <input
                        type="number"
                        name="stock_colores[${colorId}]"
                        min="0"
                        placeholder="Sin límite"
                        class="w-full sm:w-40 border-gray-300 rounded-lg px-3 py-2 text-gray-900"
                    >
                `;

                contenedorStockColores.appendChild(contenedor);
            });
        }


        checkboxesColores.forEach(checkbox => {

            checkbox.addEventListener('change', actualizarStockColores);

        });


        // =========================================
        // Estado inicial
        // =========================================

        actualizarTipoProducto();

        if (radioSi?.checked) {
            actualizarStockColores();
        }

    });
    </script>

    <!-- 🧠 Script para editor de texto -->
    <script src="https://cdn.tiny.cloud/1/vei68lbtpicw0h1neof21mul0wjhn4c8ls4wgi2icevlq716/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    <script>
        tinymce.init({
            selector: 'textarea[name=contenido]',
            plugins: 'lists link table code fullscreen preview media',
            toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link ',
            menubar: false,
            height: 400,
            branding: false,
            content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; }',
        });
        </script>

</x-app-layout>

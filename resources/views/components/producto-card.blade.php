@foreach ($productos as $producto)
    @php
        $imagenPortada = $producto->imagenes->where('es_portada', true)->first();
        $coloresDisponibles = $producto->productoColores->filter(fn ($productoColor) => !$productoColor->color->es_predeterminado && (is_null($productoColor->stock) || $productoColor->stock > 0));
    @endphp

    <div class="producto-card bg-white p-2 rounded-2xl shadow-sm hover:shadow-xl transition" data-aos="fade-up" data-aos-delay="100" data-producto-id="{{ $producto->id }}" data-categoria-id="{{ $producto->categoria_id }}" data-producto-nombre="{{ strtolower($producto->nombre) }}" data-marca-id="{{ $producto->marca_id }}" data-producto-fecha="{{ $producto->created_at->timestamp }}">
        <!-- Imagen -->
        <div class="flex justify-center relative w-full h-56 overflow-hidden rounded-2xl bg-gray-50 mb-1">
            <!-- Categoría -->
            <p class="text-sm text-dark bg-primary hover:text-white hover:bg-dark rounded-xl absolute top-1 left-1 py-2 px-4">
                {{ $producto->categoria->nombre }}
            </p>
            @if ($imagenPortada)
                <img src="{{ asset('storage/productos/' . $imagenPortada->imagen) }}" class="h-56 object-contain" alt="{{ $producto->nombre }}" >
            @else
                <img src="{{ asset('storage/productos/producto-default.png') }}" class="h-56 object-contain" alt="{{ $producto->nombre }}">
            @endif
        </div>

        <!-- Marca y colores -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-4">
            <!-- Marca -->
            @if ($producto->marca)
                <span class="text-xs uppercase text-gray-500 font-semibold">
                    {{ $producto->marca->nombre }}
                </span>
            @endif
            <!-- Colores -->
            @if ($coloresDisponibles->count())
                <div class="flex flex-col items-start gap-1">
                    <!-- Color seleccionado -->
                    <p class="text-xs font-semibold">
                        Color: <span class="text-xs text-gray-500 color-seleccionado"></span>
                    </p>
                    <div class="flex gap-2">
                        @foreach ($producto->productoColores as $productoColor) 
                        @if ($productoColor->stock > 0)
                            <button type="button" class="producto-color w-5 h-5 rounded-full border-2 border-gray-300 cursor-pointer transition hover:scale-110" data-color-id="{{ $productoColor->color->id }}" data-color-name="{{ $productoColor->color->nombre }}" data-color-hex="{{ $productoColor->color->codigo_hex }}" data-producto-color-id="{{ $productoColor->id }}" style="background-color: {{ $productoColor->color->codigo_hex }}" title="{{ $productoColor->color->nombre }}"></button>
                        @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Nombre -->
        <h3 class="font-black uppercase text-dark mt-1">
            {{ $producto->nombre }}
        </h3>

        <!-- Cantidad y agregar -->
        <div class="flex items-center justify-between mt-6">
            <!-- Cantidad -->
            <div class="flex border rounded-lg overflow-hidden">
                <button type="button" class="btn-cantidad-menos w-10 h-10 bg-gray-100 hover:bg-primary hover:text-white transition">-</button>
                <div class="cantidad-producto w-12 flex items-center justify-center font-bold" >1</div>
                <button type="button" class="btn-cantidad-mas w-10 h-10 bg-gray-100 hover:bg-primary hover:text-white transition">+</button>
            </div>
            <!-- Agregar -->
            <button type="button" class="btn-agregar-carrito bg-primary hover:bg-dark text-white font-bold rounded-lg px-5 py-3 transition" data-producto-id="{{ $producto->id }}" data-producto-nombre="{{ $producto->nombre }}" data-tiene-colores="{{ $coloresDisponibles->count() ? '1' : '0' }}">
                Agregar
            </button>
        </div>

    </div>
@endforeach
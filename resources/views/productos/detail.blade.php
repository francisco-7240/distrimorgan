<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')

        <title>{{ $producto->nombre }} - {{ config('app.name') }}</title>
        <meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($producto->descripcion), 155) }}">
    </head>
    <body class="overflow-x-hidden bg-gray-100">
        @include('partials.navbar')

        <main class="px-5 pb-24 pt-32 sm:px-8 lg:px-12">
            <div class="mx-auto max-w-7xl">
                <a href="{{ route('productos.catalogo') }}" class="relative z-[60] mb-8 inline-flex items-center gap-2 font-semibold text-dark transition hover:text-primary">
                    <i class="bx bx-arrow-back text-xl"></i>
                    Volver al catálogo
                </a>

                @php
                    $imagenPortada = $producto->imagenes->where('es_portada', true)->first();
                    $coloresDisponibles = $producto->productoColores->filter(fn ($productoColor) => !$productoColor->color?->es_predeterminado && (is_null($productoColor->stock) || $productoColor->stock > 0));
                    $productoSinColor = $coloresDisponibles->isEmpty();
                    $stockProducto = $productoSinColor ? $producto->productoColores->first()?->stock : null;
                @endphp

                <article data-aos="fade-up" data-producto-card class="overflow-hidden rounded-3xl bg-white shadow-xl">
                    <div class="grid lg:grid-cols-2">
                        <div class="flex min-h-[360px] items-center justify-center bg-gray-50 p-8 lg:min-h-[560px]">
                            @if ($imagenPortada && \Illuminate\Support\Facades\Storage::disk('public')->exists($imagenPortada->imagen))
                                <img src="{{ asset('storage/' . $imagenPortada->imagen) }}" alt="{{ $producto->nombre }}" class="max-h-[520px] w-full object-contain">
                            @else
                                <img src="{{ asset('storage/logo/logo_distrimorgan.png') }}" alt="{{ $producto->nombre }}" class="max-h-72 w-full object-contain">
                            @endif
                        </div>

                        <div class="flex flex-col justify-center p-8 sm:p-12 lg:p-16">
                            <p class="mb-3 text-sm font-bold uppercase tracking-[0.18em] text-primary">
                                {{ $producto->categoria?->nombre ?? 'Producto' }}
                            </p>
                            <h1 class="text-3xl font-black uppercase leading-tight text-dark sm:text-5xl">{{ $producto->nombre }}</h1>

                            @if ($producto->marca)
                                <p class="mt-4 text-sm font-semibold uppercase text-gray-500">Marca: {{ $producto->marca->nombre }}</p>
                            @endif

                            <div class="my-8 border-y border-gray-200 py-7 text-gray-700">
                                <p class="whitespace-pre-line leading-relaxed">{{ $producto->descripcion }}</p>
                            </div>

                            @if ($coloresDisponibles->count())
                                <div class="mb-7">
                                    <p class="mb-3 font-bold text-dark">Selecciona un color</p>
                                    <div class="flex flex-wrap gap-3">
                                        @foreach ($producto->productoColores as $productoColor)
                                            @if (!$productoColor->color?->es_predeterminado && (is_null($productoColor->stock) || $productoColor->stock > 0))
                                                <button type="button" class="producto-color h-8 w-8 rounded-full border-2 border-gray-300 transition hover:scale-110" data-color-id="{{ $productoColor->color->id }}" data-color-name="{{ $productoColor->color->nombre }}" data-color-hex="{{ $productoColor->color->codigo_hex }}" data-producto-color-id="{{ $productoColor->id }}" data-stock="{{ $productoColor->stock ?? '' }}" style="background-color: {{ $productoColor->color->codigo_hex }}" title="{{ $productoColor->color->nombre }}"></button>
                                            @endif
                                        @endforeach
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">Color: <span class="color-seleccionado">Selecciona una opción</span></p>
                                </div>
                            @endif

                            <p class="mb-5 text-sm font-semibold text-gray-600" data-stock-label>
                                @if ($productoSinColor)
                                    {{ $stockProducto !== null ? 'Stock: ' . $stockProducto : 'Disponible' }}
                                @else
                                    Selecciona un color para continuar
                                @endif
                            </p>

                            <div class="flex flex-wrap items-center gap-4">
                                <div class="flex overflow-hidden rounded-lg border">
                                    <button type="button" class="btn-cantidad-menos h-11 w-11 bg-gray-100 hover:bg-primary">-</button>
                                    <div class="cantidad-producto flex h-11 w-12 items-center justify-center font-bold">1</div>
                                    <button type="button" class="btn-cantidad-mas h-11 w-11 bg-gray-100 hover:bg-primary">+</button>
                                </div>
                                <button type="button" class="btn-agregar-carrito rounded-lg bg-primary px-6 py-3 font-bold text-dark transition hover:bg-dark hover:text-white" data-producto-id="{{ $producto->id }}" data-producto-nombre="{{ $producto->nombre }}" data-tiene-colores="{{ $coloresDisponibles->count() ? '1' : '0' }}" data-stock="{{ $stockProducto ?? '' }}">
                                    Agregar al carrito
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </main>

        @include('partials.footer')
    </body>
</html>

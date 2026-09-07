<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.header')
    <title>Mi cotización | Distribuidora Morgan</title>
</head>
<body class="bg-gray-100 font-sans antialiased">
    @include('partials.navbar')

    <main class="min-h-screen px-4 pb-16 pt-32 sm:px-8">
    <div @class(['mx-auto', 'max-w-5xl', 'px-4', 'py-10', 'sm:px-8'])>

        <div @class(['mb-8', 'flex', 'items-center', 'justify-between'])>
            <h1 @class(['text-3xl', 'font-black', 'text-slate-950'])>Mi cotización</h1>
            @if($totalItems > 0)
                <span @class(['text-sm', 'font-semibold', 'text-slate-500'])>
                    {{ $totalItems }} {{ \Illuminate\Support\Str::plural('artículo', $totalItems) }}
                </span>
            @endif
        </div>

        @if(session('status'))
            <div @class(['mb-6', 'rounded-lg', 'bg-green-50', 'px-4', 'py-3', 'text-sm', 'font-semibold', 'text-green-800'])>
                {{ session('status') }}
            </div>
        @endif

        @if($items->isEmpty())
            <div @class(['rounded-2xl', 'bg-white', 'p-12', 'text-center', 'shadow'])>
                <p @class(['text-slate-500'])>Tu cotización está vacía.</p>
                <a href="{{ url('/') }}" @class(['mt-4', 'inline-block', 'font-bold', 'text-[#c99b3a]', 'hover:text-[#b3862d]'])>
                    Ver productos
                </a>
            </div>
        @else
            <div @class(['space-y-4'])>
                @foreach($items as $item)
                    <div @class(['flex', 'items-center', 'gap-4', 'rounded-2xl', 'bg-white', 'p-4', 'shadow'])>

                        {{-- Imagen del producto --}}
                        @php
                            $img = optional($item->producto->imagenes->firstWhere('es_portada', true))->imagen
                                ?? optional($item->producto->imagenes->first())->imagen;
                        @endphp
                        <img
                            src="{{ $img ? asset('storage/' . $img) : asset('images/producto-placeholder.jpg') }}"
                            alt="{{ $item->producto->nombre }}"
                            @class(['h-20', 'w-20', 'flex-shrink-0', 'rounded-lg', 'object-cover'])
                        >

                        {{-- Datos --}}
                        <div @class(['min-w-0', 'flex-1'])>
                            <h3 @class(['truncate', 'font-bold', 'text-slate-900'])>
                                {{ $item->producto->nombre }}
                            </h3>
                            @if($item->color)
                                <p @class(['mt-1', 'flex', 'items-center', 'gap-2', 'text-sm', 'text-slate-500'])>
                                    @if($item->color->codigo_hex)
                                        <span @class(['inline-block', 'h-3', 'w-3', 'rounded-full', 'ring-1', 'ring-slate-300'])
                                              style="background-color: {{ $item->color->codigo_hex }}"></span>
                                    @endif
                                    {{ $item->color->nombre }}
                                </p>
                            @endif
                            @if($item->variante->stock !== null)
                                <p @class(['mt-1', 'text-xs', 'text-slate-400'])>
                                    Stock disponible: {{ $item->variante->stock }}
                                </p>
                            @endif
                        </div>

                        {{-- Cantidad --}}
                        <form action="{{ route('carrito.actualizar', $item->producto_color_id) }}" method="POST" @class(['flex', 'items-center', 'gap-2'])>
                            @csrf
                            @method('PATCH')
                            <input
                                type="number"
                                name="cantidad"
                                value="{{ $item->cantidad }}"
                                min="1"
                                @if($item->variante->stock) max="{{ $item->variante->stock }}" @endif
                                @class(['w-16', 'rounded-lg', 'border-slate-300', 'text-center', 'text-sm', 'focus:border-[#c99b3a]', 'focus:ring-[#c99b3a]'])
                            >
                            <button type="submit" @class(['rounded-lg', 'bg-slate-100', 'px-3', 'py-2', 'text-xs', 'font-bold', 'text-slate-700', 'hover:bg-slate-200'])>
                                Actualizar
                            </button>
                        </form>

                        {{-- Eliminar --}}
                        <form action="{{ route('carrito.eliminar', $item->producto_color_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Eliminar" @class(['rounded-lg', 'p-2', 'text-red-500', 'hover:bg-red-50', 'hover:text-red-700'])>
                                &times;
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            {{-- Acciones --}}
            <div @class(['mt-8', 'flex', 'flex-col', 'gap-3', 'sm:flex-row', 'sm:items-center', 'sm:justify-between'])>
                <form action="{{ route('carrito.vaciar') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" @class(['text-sm', 'font-semibold', 'text-slate-500', 'hover:text-red-600'])>
                        Vaciar cotización
                    </button>
                </form>

                <a
                    href="{{ $urlWhatsApp }}"
                    target="_blank"
                    rel="noopener"
                    @class(['inline-flex', 'items-center', 'justify-center', 'gap-2', 'rounded-xl', 'bg-[#25D366]', 'px-8', 'py-4', 'text-base', 'font-bold', 'text-white', 'shadow-lg', 'transition', 'hover:bg-[#1da851]'])
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" @class(['h-5', 'w-5'])>
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.71.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    Enviar cotización por WhatsApp
                </a>
            </div>
        @endif
    </div>
    </main>

    @include('partials.footer')
</body>
</html>

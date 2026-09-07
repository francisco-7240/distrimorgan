
<head>
    @include('partials.header')
    <title>Distribuidora Morgan</title>
    <meta name="description" content="Distribuidora líder en herramientas y equipos industriales. Más de 15 años ofreciendo calidad y servicio excepcional">
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-white">
        @include('partials.navbar')

        <section class="relative w-full min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('storage/img/img-banner-principal.jpg') }}')">
                <!-- Capa oscura -->
                <div class="absolute inset-0 bg-black/60"></div>

                <!-- Contenido -->
                <div class="relative z-10 flex items-center min-h-screen">
                    <div class="max-w-1xl mx-auto text-center px-6 lg:px-10 w-full">

                        <div class="max-w-1xl ">

                            <!-- Título -->
                            <h1 class="font-black uppercase leading-none">

                                <span class="block text-white text-5xl md:text-7xl">
                                    Nuestro catálogo
                                </span>

                                <span class="block text-primary text-5xl md:text-7xl">
                                    De Productos
                                </span>

                            </h1>

                            <!-- Descripción -->
                            <p class="mt-8 text-gray-200 text-lg max-w-xl text-center mx-auto">
                                Encuentra maquinaria industrial, herramientas, repuestos y
                                accesorios para potenciar tu empresa.
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Indicador de scroll -->
                <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20">
                    <a href="#section-category" class="flex flex-col items-center text-white transition duration-300 hover:scale-110">
                        <div class="w-5 h-10 border border-white rounded-full flex justify-center pt-2">
                            <div class="w-1 h-2 bg-primary rounded-full animate-bounce"></div>
                        </div>
                    </a>
                </div>
            </section>
            

        <main class="px-5 pb-24 pt-36 sm:px-8 lg:px-12">
            <div class="mx-auto max-w-7xl">
                <div class="mb-10 border-b border-gray-200 pb-6">
                    <p class="mb-2 text-sm font-semibold uppercase tracking-[0.18em] text-primary">Catálogo Morgan</p>
                    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
                        <div>
                            <h1 class="text-3xl font-bold uppercase text-black sm:text-4xl">Productos</h1>
                            <p class="mt-2 max-w-xl text-sm text-gray-600">Equipos profesionales para potenciar tu negocio.</p>
                        </div>
                        <p class="text-sm font-medium text-gray-500">{{ $productos->total() }} productos disponibles</p>
                    </div>
                </div>

                <div class="grid gap-8 lg:grid-cols-[230px_minmax(0,1fr)] ">
                    <aside class="self-start lg:sticky lg:top-24 bg-[#f1f1f1]">
                        <form action="{{ route('productos') }}" method="GET" class="mb-8">
                            <label for="buscar-producto" class="sr-only">Buscar producto o marca</label>
                            <div class="flex items-center rounded-md border border-black bg-white px-3 focus-within:ring-2 focus-within:ring-primary">
                                <i class="bx bx-search text-xl text-primary" aria-hidden="true"></i>
                                <input id="buscar-producto" name="buscar" value="{{ request('buscar') }}" type="search" placeholder="Buscar producto o marca" class="w-full border-0 bg-transparent px-3 py-2 text-sm text-black outline-none placeholder:text-gray-500 focus:ring-0">
                            </div>
                        </form>

                        <div class="space-y-8">
                            <section>
                                <h2 class="rounded-md bg-primary px-4 py-2 text-base font-bold text-black">Categorías</h2>
                                <ul class="mt-4 space-y-2 px-1 text-sm font-semibold uppercase text-black">
                                    @foreach ($categorias as $categoria)
                                        <li><a href="{{ route('productos', array_merge(request()->query(), ['categoria' => $categoria->id, 'marca' => null, 'page' => null])) }}" class="transition hover:text-primary">{{ $categoria->nombre }}</a></li>
                                    @endforeach
                                </ul>
                            </section>

                            <section>
                                <h2 class="rounded-md bg-primary px-4 py-2 text-base font-bold text-black">Productos</h2>
                                <ul class="mt-4 space-y-2 px-1 text-sm font-semibold uppercase text-black">
                                    <li><a href="#" class="transition hover:text-primary">Más vendidos</a></li>
                                    <li><a href="#" class="transition hover:text-primary">Novedades</a></li>
                                    <li><a href="#" class="transition hover:text-primary">Ofertas</a></li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="rounded-md bg-primary px-4 py-2 text-base font-bold text-black">Marcas</h2>
                                <div class="mt-4 grid grid-cols-2 gap-2">
                                    @foreach ($marcas as $marca)
                                        <a href="{{ route('productos', array_merge(request()->query(), ['marca' => $marca->id, 'categoria' => null, 'page' => null])) }}" class="rounded border border-gray-300 px-2 py-2 text-center text-xs font-bold uppercase text-black transition hover:border-primary hover:bg-primary">{{ $marca->nombre }}</a>
                                    @endforeach
                                </div>
                            </section>
                        </div>
                    </aside>

                    <section aria-labelledby="listado-productos">
                        <div class="mb-5 flex items-center justify-between gap-4">
                            <h2 id="listado-productos" class="text-lg font-bold uppercase text-black">Nuestro catálogo</h2>
                            <label class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="hidden sm:inline">Ordenar por</span>
                                <select name="orden" form="filtros-productos" onchange="this.form.submit()" class="rounded border border-gray-300 bg-white px-2 py-2 text-sm text-black focus:border-primary focus:ring-primary">
                                    <option>Destacados</option>
                                    <option value="recientes" @selected(request('orden') === 'recientes')>Más recientes</option>
                                    <option value="nombre" @selected(request('orden') === 'nombre')>Nombre A-Z</option>
                                </select>
                            </label>
                        </div>

                        <form id="filtros-productos" action="{{ route('productos') }}" method="GET">
                            <input type="hidden" name="buscar" value="{{ request('buscar') }}">
                            <input type="hidden" name="categoria" value="{{ request('categoria') }}">
                            <input type="hidden" name="marca" value="{{ request('marca') }}">
                        </form>

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">
                            @foreach ($productos as $producto)
                                @php
                                    $imagen = $producto->imagenes->where('es_portada', true)->first()
                                        ?? $producto->imagenes->first();
                                    $varianteDisponible = $producto->productoColores->firstWhere('stock', '>', 0)
                                        ?? $producto->productoColores->first();
                                @endphp
                                <article class="group overflow-hidden border border-gray-200 bg-[#f1f1f1] transition hover:-translate-y-1 hover:shadow-lg">
                                    <div class="flex aspect-[1.08] items-center justify-center bg-white p-3">
                                        <img src="{{ $imagen ? asset('storage/productos/' . $imagen->imagen) : asset('storage/productos/producto-default.png') }}" alt="{{ $producto->nombre }}" class="h-full w-full object-contain transition duration-300 group-hover:scale-105" loading="lazy">
                                    </div>
                                    <div class="p-5">
                                        <p class="text-[11px] font-bold uppercase tracking-wide text-gray-500">{{ $producto->categoria?->nombre ?? 'Sin categoría' }}</p>
                                        <h3 class="mt-1 min-h-[40px] text-sm font-bold uppercase leading-5 text-black">{{ $producto->nombre }}</h3>
                                        @if ($varianteDisponible)
                                            <x-agregar-cotizacion :producto-color-id="$varianteDisponible->id" texto="Agregar a cotización" class="mt-4 rounded-md px-4 py-2 text-xs" />
                                        @else
                                            <span class="mt-4 inline-flex text-xs font-semibold text-gray-500">Sin variantes disponibles</span>
                                        @endif
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <div class="mt-8">{{ $productos->links() }}</div>
                    </section>
                </div>
            </div>
        </main>

        @include('partials.footer')
    </div>
</body>


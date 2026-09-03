
@include('partials.navbar')
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
            

        @php
            $categorias = ['Molinos', 'Sierras', 'Empacadoras', 'Hornos', 'Balanzas', 'POS', 'Acero inoxidable', 'Servicio'];
            $marcas = ['Dibal', 'Epelsa', 'Haifish', 'Javar', 'Salvador', 'Tramontina'];
            $productos = [
                ['nombre' => 'Sierra para hueso profesional', 'categoria' => 'Sierras', 'imagen' => asset('storage/img/sierra-circular-dientes-mesa.jpg')],
                ['nombre' => 'Molino industrial de carne', 'categoria' => 'Molinos', 'imagen' => asset('storage/img/molino.jpg')],
                ['nombre' => 'Empacadora al vacío', 'categoria' => 'Empacadoras', 'imagen' => asset('storage/img/empacadoras.webp')],
                ['nombre' => 'Horno industrial', 'categoria' => 'Hornos', 'imagen' => asset('storage/img/hornos.webp')],
                ['nombre' => 'Balanza comercial', 'categoria' => 'Balanzas', 'imagen' => asset('storage/img/balanzas.png')],
                ['nombre' => 'Sierra circular de mesa', 'categoria' => 'Sierras', 'imagen' => asset('storage/img/sierra-circular-dientes-mesa.jpg')],
                ['nombre' => 'Equipo en acero inoxidable', 'categoria' => 'Acero inoxidable', 'imagen' => asset('storage/img/acero.webp')],
                ['nombre' => 'Terminal POS comercial', 'categoria' => 'POS', 'imagen' => asset('storage/img/pos.png')],
                ['nombre' => 'Sierra para hueso profesional', 'categoria' => 'Sierras', 'imagen' => asset('storage/img/sierra-circular-dientes-mesa.jpg')],
            ];
        @endphp

        <main class="px-5 pb-24 pt-36 sm:px-8 lg:px-12">
            <div class="mx-auto max-w-7xl">
                <div class="mb-10 border-b border-gray-200 pb-6">
                    <p class="mb-2 text-sm font-semibold uppercase tracking-[0.18em] text-primary">Catálogo Morgan</p>
                    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
                        <div>
                            <h1 class="text-3xl font-bold uppercase text-black sm:text-4xl">Productos</h1>
                            <p class="mt-2 max-w-xl text-sm text-gray-600">Equipos profesionales para potenciar tu negocio.</p>
                        </div>
                        <p class="text-sm font-medium text-gray-500">{{ count($productos) }} productos disponibles</p>
                    </div>
                </div>

                <div class="grid gap-8 lg:grid-cols-[230px_minmax(0,1fr)]">
                    <aside class="self-start lg:sticky lg:top-24">
                        <form action="{{ route('productos') }}" method="GET" class="mb-8">
                            <label for="buscar-producto" class="sr-only">Buscar producto o marca</label>
                            <div class="flex items-center rounded-md border border-black bg-white px-3 focus-within:ring-2 focus-within:ring-primary">
                                <i class="bx bx-search text-xl text-primary" aria-hidden="true"></i>
                                <input id="buscar-producto" name="buscar" type="search" placeholder="Buscar producto o marca" class="w-full border-0 bg-transparent px-3 py-2 text-sm text-black outline-none placeholder:text-gray-500 focus:ring-0">
                            </div>
                        </form>

                        <div class="space-y-8">
                            <section>
                                <h2 class="rounded-md bg-primary px-4 py-2 text-base font-bold text-black">Categorías</h2>
                                <ul class="mt-4 space-y-2 px-1 text-sm font-semibold uppercase text-black">
                                    @foreach ($categorias as $categoria)
                                        <li><a href="#" class="transition hover:text-primary">{{ $categoria }}</a></li>
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
                                        <a href="#" class="rounded border border-gray-300 px-2 py-2 text-center text-xs font-bold uppercase text-black transition hover:border-primary hover:bg-primary">{{ $marca }}</a>
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
                                <select class="rounded border border-gray-300 bg-white px-2 py-2 text-sm text-black focus:border-primary focus:ring-primary">
                                    <option>Destacados</option>
                                    <option>Más recientes</option>
                                    <option>Nombre A-Z</option>
                                </select>
                            </label>
                        </div>

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">
                            @foreach ($productos as $producto)
                                <article class="group overflow-hidden border border-gray-200 bg-[#f1f1f1] transition hover:-translate-y-1 hover:shadow-lg">
                                    <div class="flex aspect-[1.08] items-center justify-center bg-white p-3">
                                        <img src="{{ $producto['imagen'] }}" alt="{{ $producto['nombre'] }}" class="h-full w-full object-contain transition duration-300 group-hover:scale-105" loading="lazy">
                                    </div>
                                    <div class="p-5">
                                        <p class="text-[11px] font-bold uppercase tracking-wide text-gray-500">{{ $producto['categoria'] }}</p>
                                        <h3 class="mt-1 min-h-[40px] text-sm font-bold uppercase leading-5 text-black">{{ $producto['nombre'] }}</h3>
                                        <a href="{{ route('contacto') }}" class="mt-4 inline-flex items-center gap-2 rounded-md bg-primary px-4 py-2 text-xs font-bold text-black transition hover:bg-black hover:text-white">
                                            Solicitar cotización <i class="bx bx-right-arrow-alt text-base" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        </main>

        @include('partials.footer')
    </div>
</body>


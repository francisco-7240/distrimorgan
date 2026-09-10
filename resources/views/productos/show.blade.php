<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        @include('partials.header')

        <title>{{ config('app.name') }} - Mi Carrito</title>
        <meta name="description" content="Distribuidora Morgan - Listado de productos. Encuentra equipos profesionales para potenciar tu negocio.">
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- Banner -->
        <section class="relative w-full h-64 sm:h-80 md:h-96 bg-cover bg-center overflow-hidden" style="background-image: url('{{ asset('storage/img/banner_mis_productos.jpg') }}')">
            <!-- Capa oscura -->
            <div class="absolute inset-0 bg-black/70"></div>

            <!-- Contenido -->
            <div class="relative flex min-h-screen items-start pt-28 pb-28 md:pt-44 lg:pt-48">
                <div class="container px-6 lg:px-10 w-full">
                    <!-- Título -->
                    <h1 class="font-black uppercase leading-none text-white text-4xl md:text-7xl">Catálogo <span class="text-primary">Productos</span>
                    </h1>
                </div>
            </div>

        </section>

        <main class="px-5 pb-24 pt-36 sm:px-8 lg:px-12">
            <div class="mx-auto max-w-7xl">
                <div class="mb-10 border-b border-gray-200 pb-6">
                    <p class="mb-2 text-lg font-semibold uppercase tracking-[0.18em] text-primary">Nuestro Catálogo</p>
                    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
                        <div>
                            <p class="mt-2 max-w-xl text-sm text-gray-600">Equipos profesionales para potenciar tu negocio.</p>
                        </div>
                        <p class="text-sm font-medium text-gray-500" id="contadorProductos">{{ $productos->count() }} productos disponibles</p>
                    </div>
                </div>
                
                <div class="grid gap-8 grid-cols-1 lg:grid-cols-[230px_minmax(0,1fr)]">
                    <!-- Filtros -->
                    <div class="flex flex-col gap-4 py-4 px-2 bg-gray-100 rounded-lg shadow-lg">

                        <!-- Buscador -->
                        <div class="w-full flex flex-col gap-2">
                            <label for="buscadorProductos" class="text-sm font-medium text-gray-700">Buscar producto:</label>
                            <div class="relative w-full">
                                <input type="text" id="buscadorProductos" placeholder="Nombre del producto" class="w-full rounded-lg border border-gray-300 py-3 pl-11 pr-4 focus:ring-primary focus:border-primary">
                                <svg class="w-5 h-5 absolute left-4 top-3.5 text-primary" for="buscadorProductos" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m1.85-5.15a7 7 0 11-14 0a7 7 0 0114 0z"/></svg>
                            </div>
                        </div>

                        <!-- Ordenar -->
                        <div class="w-full flex flex-col gap-2">
                            <label for="orden" class="text-sm font-medium text-gray-700">Ordenar por:</label>
                            <div class="relative w-full">
                                <svg class="w-5 h-5 absolute left-4 top-3.5 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-ordered"><path d="M11 5h10"/><path d="M11 12h10"/><path d="M11 19h10"/><path d="M4 4h1v5"/><path d="M4 9h2"/><path d="M6.5 20H3.4c0-1 2.6-1.925 2.6-3.5a1.5 1.5 0 0 0-2.6-1.02"/></svg>
                                <select id="orden" name="orden" class="w-full rounded-lg border border-gray-300 py-3 pl-11 pr-4 focus:ring-primary focus:border-primary">
                                    <option value="">Seleccionar...</option>
                                    <option value="recientes">Más recientes</option>
                                    <option value="nombre">Nombre A-Z</option>
                                </select>
                            </div>
                        </div>

                        <!-- Categorías -->
                        <label class="text-sm font-medium text-gray-700">Categorías:</label>
                        <div class="flex flex-wrap gap-2">
                            <!-- Todas -->
                            <button
                                type="button"
                                class="btn-categoria w-full bg-primary text-dark px-4 py-2 rounded-lg font-bold text-sm hover:bg-dark hover:text-white transition text-left"
                                data-categoria-id="todos"
                            >
                                Todas
                            </button>

                            @foreach ($categorias as $categoria)

                                <button
                                    type="button"
                                    class="btn-categoria w-full border px-4 py-2 rounded-lg text-sm font-bold hover:bg-primary hover:text-white transition text-left"
                                    data-categoria-id="{{ $categoria->id }}"
                                >
                                    {{ $categoria->nombre }}
                                </button>

                            @endforeach

                        </div>

                        <!-- Marcas -->
                        <label class="text-sm font-medium text-gray-700">Marcas:</label>
                        <section>
                            <!-- Todas -->
                            <button
                                type="button"
                                class="btn-marca w-full bg-primary text-dark px-4 py-2 rounded-lg font-bold text-sm hover:bg-dark hover:text-white transition text-left"
                                data-marca-id="todos"
                            >
                                Todas
                            </button>

                            @foreach ($marcas as $marca)

                                <button
                                    type="button"
                                    class="btn-marca w-full border px-4 py-2 rounded-lg text-sm font-bold hover:bg-primary hover:text-white transition text-left"
                                    data-marca-id="{{ $marca->id }}"
                                >
                                    {{ $marca->nombre }}
                                </button>

                            @endforeach
                        </section>

                    </div>

                    <!-- productos -->
                    <div>
                        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6" id="listaProductos">
                            <x-producto-card :productos="$productos"/>
                        </div>

                        <!-- Sin resultados -->
                        <div id="sinResultados" class="hidden text-center py-16">
                            <i class="bx bx-search-alt-2 text-6xl text-gray-300"></i>

                            <h3 class="text-xl font-black text-dark mt-4">
                                No encontramos productos
                            </h3>

                            <p id="mensajeSinResultados" class="text-gray-500 mt-2">
                                No hay productos que coincidan con tu búsqueda.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </main>

        @include('partials.footer')

    </body>
</html>



<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        @include('partials.header')

        <title>Mi Carrito</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- Banner -->
        <section class="relative w-full h-48 md:h-96 bg-cover bg-center overflow-hidden" style="background-image: url('{{ asset('storage/img/banner_mi_carrito.webp') }}')">
            <!-- Capa oscura -->
            <div class="absolute inset-0 bg-black/70"></div>

            <!-- Contenido -->
            <div class="relative flex min-h-screen items-start pt-28 pb-28 md:pt-44 lg:pt-48">
                <div class="container px-6 lg:px-10 w-full">
                    <!-- Título -->
                    <h1 class="font-black uppercase leading-none text-white text-5xl md:text-7xl">Mi <span class="text-primary">Carrito</span>
                    </h1>
                </div>
            </div>

        </section>

        <div class="container mx-auto px-4 py-10 relative overflow-hidden" style="background-image: url('{{ asset('storage/img/img-figura-sierras.png') }}'); background-repeat: no-repeat; background-position: center;">

            <!-- Contenedor del carrito -->
            <div id="carritoProductos">

                <div class="text-center py-10">
                    <p class="text-gray-500">
                        Cargando carrito...
                    </p>
                </div>

            </div>

        </div>


        @include('partials.footer')

    </body>
</html>

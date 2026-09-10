<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        @include('partials.header')

        <title>{{ config('app.name') }} - Mi Carrito</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- Banner -->
        <section class="relative w-full h-64 sm:h-80 md:h-96 bg-cover bg-center overflow-hidden" style="background-image: url('{{ asset('storage/img/banner_mi_carrito.webp') }}')">
            <!-- Capa oscura -->
            <div class="absolute inset-0 bg-black/70"></div>

            <!-- Contenido -->
            <div class="relative flex min-h-screen items-start pt-28 pb-28 md:pt-44 lg:pt-48">
                <div class="container px-6 lg:px-10 w-full">
                    <!-- Título -->
                    <h1 class="font-black uppercase leading-none text-white text-4xl md:text-7xl">Mi <span class="text-primary">Carrito</span>
                    </h1>
                </div>
            </div>

        </section>
        
        <section class="relative py-24 overflow-hidden bg-gray-100" style="background-image: url('{{ asset('storage/img/img-figura-sierras.png') }}'); background-repeat: no-repeat; background-position: center;">
            <div class="container mx-auto px-4 py-10">

                <!-- Contenedor del carrito -->
                <div id="carritoProductos" data-whatsapp="{{ config('app.redwhatsapp') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    <div class="text-center py-10">
                        <p class="text-gray-500">
                            Cargando carrito...
                        </p>
                    </div>

                </div>
                
                <div id="accionesCarrito" class="hidden flex justify-between mt-10 gap-4">
                    <a class="bg-primary text-dark hover:bg-dark hover:text-white transition px-4 py-2 rounded-xl text-center align-middle" title="Seguir comprando" href="{{ route('home') }}">
                        <i class="bx bx-arrow-back text-2xl"></i> Seguir comprando
                    </a>
                    <button type="button" id="btnEnviarWhatsApp" class="bg-green-600 text-white hover:bg-green-700 transition px-4 py-2 rounded-xl text-center align-middle" title="Enviar solicitud">
                        <i class="bx bx-send text-2xl"></i> Enviar solicitud
                    </button>
                </div>
            
            </div>
        </section>


        @include('partials.footer')

    </body>
</html>

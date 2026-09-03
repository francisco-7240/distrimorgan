<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    @include('partials.header')
    <title>Distribuidora Morgan</title>
    <meta name="description" content="Distribuidora líder en herramientas y equipos industriales. Más de 15 años ofreciendo calidad y servicio excepcional">
</head>
<body class="overflow-x-hidden">

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Banner principal -->
    <section class="relative w-full min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('storage/img/img-banner-principal.jpg') }}')">
        <!-- Capa oscura -->
        <div class="absolute inset-0 bg-black/60"></div>

        <!-- Contenido -->
        <div class="relative z-10 flex min-h-screen items-start pt-28 pb-28 md:pt-44 lg:pt-48">
            <div class="max-w-7xl mx-auto px-6 lg:px-10 w-full">

                <div class="max-w-2xl">

                    <!-- Texto superior -->
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-1 bg-primary"></div>
                        <span class="uppercase tracking-[4px] text-white text-sm">
                            Distribuidora Industrial Premium
                        </span>
                    </div>

                    <!-- Título -->
                    <h1 class="font-black uppercase leading-none">
                        <span class="block text-white text-5xl md:text-7xl">Soluciones</span>
                        <span class="block text-primary text-5xl md:text-7xl">Industriales</span>
                        <span class="block text-white text-5xl md:text-7xl">Para Potenciar</span>
                        <span class="block text-white text-5xl md:text-7xl">Tu Negocio</span>
                    </h1>

                    <!-- Descripción -->
                    <p class="mt-8 text-gray-200 text-lg max-w-xl">
                        Equipos, maquinaria, tecnología POS y utensilios profesionales
                        para empresas del sector alimenticio y comercial.
                    </p>

                    <!-- Botón -->
                    <div class="mt-10">
                        <a href="#" class="inline-flex items-center gap-3 bg-primary transition rounded-full font-semibold text-black text-center px-3 py-1 hover:bg-dark hover:text-white">
                            Solicitar cotización
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

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

    <!-- Seccion categorias -->
    <section class="relative py-24 overflow-hidden bg-gray-100" style="background-image: url('{{ asset('storage/img/img-figura-sierras.png') }}'); background-repeat: no-repeat; background-position: center;" id="section-category">

        <!-- categorias -->
        <div class="max-w-7xl mx-auto px-6" data-aos="fade-up">

            <!-- Encabezado -->
            <div class="text-center mb-16">

                <p class="uppercase tracking-[4px] text-sm text-dark mb-3">
                    Nuestro portafolio
                </p>

                <h2 class="font-black uppercase leading-none">

                    <span class="block text-dark text-5xl">
                        Categorías de
                    </span>

                    <span class="block text-primary text-5xl mt-2">
                        Productos
                    </span>

                </h2>

                <p class="mt-6 max-w-2xl mx-auto text-gray-700">
                    Soluciones completas para el sector alimenticio e industrial.
                    Equipos de primer nivel, tecnología avanzada y servicio experto.
                </p>

            </div>


            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-2">

                <!-- Sierras -->
                <a href="#" data-aos="fade-right"
                    class="relative md:col-span-6 md:row-span-2 h-[420px] overflow-hidden group">

                    <img
                        src="{{ asset('storage\img\sierra-circular-dientes-mesa.jpg') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                        alt="Sierras industriales">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>

                    <div class="absolute bottom-6 left-6">
                        <h3 class="text-white font-black uppercase text-4xl">
                            Sierras Industriales
                        </h3>

                        <p class="text-white text-sm mt-2">
                            Corte de precisión para carne, hueso y más.
                        </p>
                    </div>

                </a>


                <!-- Molinos --> 
                <a href="#" data-aos="fade-left"
                    class="relative md:col-span-3 h-[205px] overflow-hidden group">

                    <img
                        src="{{ asset('storage\img\molino.jpg') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                        alt="Molinos">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>

                    <div class="absolute bottom-4 left-4">
                        <h3 class="text-white font-black uppercase">
                            Molinos de carne
                        </h3>

                        <p class="text-white text-xs">
                            Procesamiento industrial
                        </p>
                    </div>

                </a>


                <!-- Empacadoras -->
                <a href="#" data-aos="fade-left"
                    class="relative md:col-span-3 h-[205px] overflow-hidden group">

                    <img
                        src="{{ asset('storage\img\empacadoras.webp') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                        alt="Empacadoras">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>

                    <div class="absolute bottom-4 left-4">
                        <h3 class="text-white font-black uppercase">
                            Empacadoras al vacío
                        </h3>

                        <p class="text-white text-xs">
                            Conservación profesional
                        </p>
                    </div>

                </a>


                <!-- Hornos -->
                <a href="#" data-aos="fade-left"
                    class="relative md:col-span-3 h-[205px] overflow-hidden group">

                    <img
                        src="{{ asset('storage\img\hornos.webp') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                        alt="Hornos">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>

                    <div class="absolute bottom-4 left-4">
                        <h3 class="text-white font-black uppercase">
                            Hornos industriales
                        </h3>

                        <p class="text-white text-xs">
                            Cocción perfecta
                        </p>
                    </div>

                </a>


                <!-- Balanzas -->
                <a href="#" data-aos="fade-left"
                    class="relative md:col-span-3 h-[205px] overflow-hidden group">

                    <img
                        src="{{ asset('storage\img\balanzas.png') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                        alt="Balanzas">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>

                    <div class="absolute bottom-4 left-4">
                        <h3 class="text-white font-black uppercase">
                            Balanzas y básculas
                        </h3>

                        <p class="text-white text-xs">
                            Precisión comercial
                        </p>
                    </div>

                </a>


                <!-- Hardware POS -->
                <a href="#" data-aos="fade-right"
                    class="relative md:col-span-3 h-[170px] overflow-hidden group">

                    <img
                        src="{{ asset('storage\img\pos.png') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                        alt="POS">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>

                    <div class="absolute bottom-4 left-4">
                        <h3 class="text-white font-black uppercase">
                            Hardware POS
                        </h3>

                        <p class="text-white text-xs">
                            Terminales y periféricos
                        </p>
                    </div>

                </a>


                <!-- Acero -->
                <a href="#" data-aos="fade-right"
                    class="relative md:col-span-3 h-[170px] overflow-hidden group">

                    <img
                        src="{{ asset('storage/img/acero.webp') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                        alt="Acero inoxidable">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>

                    <div class="absolute bottom-4 left-4">
                        <h3 class="text-white font-black uppercase">
                            Acero inoxidable
                        </h3>

                        <p class="text-white text-xs">
                            Mesones y estanterías
                        </p>
                    </div>

                </a>


                <!-- Servicio técnico -->
                <a href="#" data-aos="fade-right"
                    class="relative md:col-span-6 h-[170px] overflow-hidden group">

                    <img
                        src="{{ asset('storage/img/img-servicios.jpg') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                        alt="Servicio técnico">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>

                    <div class="absolute bottom-4 left-4">
                        <h3 class="text-white font-black uppercase text-3xl">
                            Servicio técnico
                        </h3>

                        <p class="text-white text-sm">
                            Mantenimiento preventivo y correctivo
                        </p>
                    </div>

                </a>

            </div>

        </div>

        <!-- industria -->
        <div class="max-w-7xl mx-auto px-6 mt-16 sm:mt-32" data-aos="fade-up">

            <!-- Encabezado -->
            <div class="text-center mb-14">

                <div class="flex items-center justify-center gap-4 mb-4">

                    <div class="w-14 h-[2px] bg-primary"></div>

                    <span class="uppercase tracking-[3px] text-xs text-dark">
                        Soluciones por industria
                    </span>

                    <div class="w-14 h-[2px] bg-primary"></div>

                </div>

                <h2 class="font-black uppercase leading-none">

                    <span class="block text-dark text-5xl">
                        Equipamos tu
                    </span>

                    <span class="block text-primary text-5xl">
                        Negocio
                    </span>

                </h2>

                <p class="max-w-xl mx-auto mt-5 text-gray-700">
                    Conocemos las necesidades específicas de cada sector y ofrecemos
                    soluciones personalizadas.
                </p>

            </div>


            <!-- Slider -->
            <div class="relative">

                <!-- Flecha izquierda -->
                <div class="industrias-prev absolute top-1/2 -translate-y-1/2 -left-8 z-20 cursor-pointer">

                    <svg class="w-10 h-10 text-dark hover:text-primary transition"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19l-7-7 7-7" />

                    </svg>

                </div>


                <div class="swiper industriasSwiper h-auto">

                    <div class="swiper-wrapper">

                        <!-- Carnicerías -->
                        <div class="swiper-slide flex" data-aos="fade-up" data-aos-delay="{{ 1 * 100 }}">

                            <div class="bg-gray-300 rounded-3xl p-10 text-center flex flex-col min-h-[340px] w-full">

                                <img
                                    src="{{ asset('storage/industrias/icons/icon-carniceria.png') }}"
                                    class="w-24 h-24 mx-auto mb-8"
                                    alt="Carnicerías">

                                <h3 class="text-2xl font-black uppercase text-dark">
                                    Carnicerías
                                </h3>

                                <p class="mt-4 text-gray-800 flex-grow">
                                    Equipos especializados para el procesamiento y venta de carnes.
                                </p>

                            </div>

                        </div>


                        <!-- Pesquerías -->
                        <div class="swiper-slide flex" data-aos="fade-up" data-aos-delay="{{ 2 * 100 }}">

                            <div class="bg-gray-300 rounded-3xl p-10 text-center flex flex-col min-h-[340px] w-full">

                                <img
                                    src="{{ asset('storage/industrias/icons/icon-pesqueria.png') }}"
                                    class="w-24 h-24 mx-auto mb-8"
                                    alt="Pesquerías">

                                <h3 class="text-2xl font-black uppercase text-dark">
                                    Pesquerías
                                </h3>

                                <p class="mt-4 text-gray-800 flex-grow">
                                    Soluciones para conservación y exhibición de productos del mar.
                                </p>

                            </div>

                        </div>


                        <!-- Panaderías -->
                        <div class="swiper-slide flex" data-aos="fade-up" data-aos-delay="{{ 3 * 100 }}">

                            <div class="bg-gray-300 rounded-3xl p-10 text-center flex flex-col min-h-[340px] w-full">

                                <img
                                    src="{{ asset('storage/industrias/icons/icon-panaderia.png') }}"
                                    class="w-24 h-24 mx-auto mb-8"
                                    alt="Panaderías">

                                <h3 class="text-2xl font-black uppercase text-dark">
                                    Panaderías
                                </h3>

                                <p class="mt-4 text-gray-800 flex-grow">
                                    Maquinaria para producción de pan y repostería artesanal.
                                </p>

                            </div>

                        </div>


                        <!-- Supermercados -->
                        <div class="swiper-slide flex" data-aos="fade-up" data-aos-delay="{{ 4 * 100 }}">

                            <div class="bg-gray-300 rounded-3xl p-10 text-center flex flex-col min-h-[340px] w-full">

                                <img
                                    src="{{ asset('storage\industrias\icons\icon-supermercado.png') }}"
                                    class="w-24 h-24 mx-auto mb-8"
                                    alt="Supermercados">

                                <h3 class="text-2xl font-black uppercase text-dark">
                                    Supermercados
                                </h3>

                                <p class="mt-4 text-gray-800 flex-grow">
                                    Sistemas completos para operación de retail alimenticio.
                                </p>

                            </div>

                        </div>

                        <!-- Supermercados -->
                        <div class="swiper-slide flex" data-aos="fade-up" data-aos-delay="{{ 5 * 100 }}">

                            <div class="bg-gray-300 rounded-3xl p-10 text-center flex flex-col min-h-[340px] w-full">

                                <img
                                    src="{{ asset('storage\industrias\icons\icon-supermercado.png') }}"
                                    class="w-24 h-24 mx-auto mb-8"
                                    alt="Supermercados">

                                <h3 class="text-2xl font-black uppercase text-dark">
                                    Supermercados
                                </h3>

                                <p class="mt-4 text-gray-800 flex-grow">
                                    Sistemas completos para operación de retail alimenticio.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- Flecha derecha -->
                <div class="industrias-next absolute top-1/2 -translate-y-1/2 -right-8 z-20 cursor-pointer">

                    <svg class="w-10 h-10 text-dark hover:text-primary transition"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 5l7 7-7 7" />

                    </svg>

                </div>

            </div>

        </div>

    </section>

    <!-- Seccion marcas -->
    <section class="relative py-24 bg-cover bg-center overflow-hidden" style="background-image: url('{{ asset('storage/img/fondo-marca-home.jpg') }}')" id="section-brands">

        <!-- Capa dorada -->
        <div class="absolute inset-0 bg-primary/75"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6" data-aos="fade-up">

            <!-- Título -->
            <div class="mb-16">

                <h2 class="font-black uppercase leading-none text-5xl">

                    <span class="block text-dark">
                        Marcas Líderes
                    </span>

                    <span class="block text-white">
                        Del Mercado
                    </span>

                </h2>

            </div>


            <!-- Slider -->
            <div class="relative">

                <!-- Flecha izquierda -->
                <div class="marcas-prev absolute top-1/2 -translate-y-1/2 -left-8 z-20 cursor-pointer">

                    <svg class="w-10 h-10 text-dark hover:text-white transition"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19l-7-7 7-7" />

                    </svg>

                </div>


                <div class="swiper marcasSwiper">

                    <div class="swiper-wrapper">

                        @for ($i = 1; $i <= 10; $i++)

                            <div class="swiper-slide flex" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">

                                <a href="#"
                                class="bg-white/90 border-2 border-white rounded-3xl
                                        h-[90px] w-full
                                        flex items-center justify-center
                                        text-4xl font-black text-dark
                                        hover:bg-dark hover:text-white transition">

                                    MARCA {{ $i }}

                                </a>

                            </div>

                        @endfor

                    </div>

                </div>


                <!-- Flecha derecha -->
                <div class="marcas-next absolute top-1/2 -translate-y-1/2 -right-8 z-20 cursor-pointer">

                    <svg class="w-10 h-10 text-dark hover:text-white transition"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 5l7 7-7 7" />

                    </svg>

                </div>

            </div>


            <!-- Estadísticas -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-20 text-center">

                <div>

                    <div class="text-6xl font-black text-dark contador" data-target="50">0</div>

                    <p class="mt-3 uppercase tracking-[4px] text-dark">
                        Marcas Disponibles
                    </p>

                </div>

                <div>

                    <div class="text-6xl font-black text-dark contador" data-target="100" data-suffix="%">
                        0%
                    </div>

                    <p class="mt-3 uppercase tracking-[4px] text-dark">
                        Productos Originales
                    </p>

                </div>

                <div>

                    <div class="text-6xl font-black text-dark contador" data-target="24">
                        24
                    </div>

                    <p class="mt-3 uppercase tracking-[4px] text-dark">
                        Meses de Garantía
                    </p>

                </div>

                <div>

                    <div class="text-6xl font-black text-dark contador" data-target="5000" data-suffix="+">
                        5000+
                    </div>

                    <p class="mt-3 uppercase tracking-[4px] text-dark">
                        Productos en Stock
                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- Seccion productos -->
    <section id="section-products" class="py-28 bg-gray-100">

        <div class="max-w-7xl mx-auto px-6">

            <!-- Título -->
            <div class="text-center mb-14" data-aos="fade-up">

                <div class="flex items-center justify-center gap-4 mb-4">

                    <div class="w-14 h-[2px] bg-primary"></div>

                    <span class="uppercase tracking-[3px] text-xs text-dark">
                        Nuestro catálogo
                    </span>

                    <div class="w-14 h-[2px] bg-primary"></div>

                </div>

                <h2 class="font-black uppercase leading-none">

                    <span class="block text-dark text-5xl">
                        Catálogo de
                    </span>

                    <span class="block text-primary text-5xl">
                        Productos
                    </span>

                </h2>

            </div>

            <div class="flex flex-col lg:flex-row gap-4 mb-12">

                <!-- Buscador -->
                <div class="relative">

                    <input
                        type="text"
                        placeholder="Buscar producto"
                        class="w-full lg:w-72 rounded-lg border border-gray-300 py-3 pl-11 pr-4 focus:ring-primary focus:border-primary">

                    <svg class="w-5 h-5 absolute left-4 top-3.5 text-primary"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m21 21-4.35-4.35m1.85-5.15a7 7 0 11-14 0a7 7 0 0114 0z"/>
                    </svg>

                </div>

                <!-- Categorías -->
                <div class="flex flex-wrap gap-2">

                    <button class="bg-primary px-4 py-2 rounded-lg font-bold text-sm">
                        Todos
                    </button>

                    <button class="border px-4 py-2 rounded-lg text-sm font-bold">
                        Sierras
                    </button>

                    <button class="border px-4 py-2 rounded-lg text-sm font-bold">
                        Molinos
                    </button>

                    <button class="border px-4 py-2 rounded-lg text-sm font-bold">
                        Empacadoras
                    </button>

                    <button class="border px-4 py-2 rounded-lg text-sm font-bold">
                        Hornos
                    </button>

                    <button class="border px-4 py-2 rounded-lg text-sm font-bold">
                        Balanzas
                    </button>

                </div>

            </div>

            <!-- productos -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div
                    class="bg-white p-5 rounded-2xl shadow-sm hover:shadow-xl transition"
                    data-aos="fade-up"
                    data-aos-delay="100">

                    <!-- Imagen -->
                    <div class="flex justify-center mb-5">

                    <!-- Categoría -->
                        <p class="text-sm text-dark bg-primary hover:text-white hover:bg-dark rounded-xl absolute top-2 left-2 py-2 px-4">
                            Sierras Industriales
                        </p>
                        <img
                            src="{{ asset('storage/products/producto.png') }}"
                            class="h-56 object-contain"
                            alt="Producto">

                    </div>

                    <!-- Marca -->
                    <span class="text-xs uppercase text-gray-500 font-semibold">
                        Torrey
                    </span>

                    <!-- Nombre -->
                    <h3 class="font-black uppercase text-dark mt-1">
                        Sierra para hueso profesional
                    </h3>

                    <!-- Cantidad -->
                    <div class="flex items-center justify-between mt-6">

                        <div class="flex border rounded-lg overflow-hidden">

                            <button
                                class="w-10 h-10 bg-gray-100 hover:bg-primary hover:text-white transition">
                                -
                            </button>

                            <div class="w-12 flex items-center justify-center font-bold">
                                1
                            </div>

                            <button
                                class="w-10 h-10 bg-gray-100 hover:bg-primary hover:text-white transition">
                                +
                            </button>

                        </div>

                        <!-- Agregar -->
                        <button
                            class="bg-primary px-5 py-3 rounded-xl font-bold text-sm hover:bg-dark hover:text-white transition">

                            Agregar

                        </button>

                    </div>

                </div>

            </div>

            <!-- Botón -->
            <div class="mt-10 text-center" data-aos="fade-in">
                <a
                    href="#"
                    class="inline-flex items-center gap-3 bg-primary transition rounded-full font-semibold text-black text-center px-3 py-1 hover:bg-dark hover:rounded-full hover:text-white"
                >
                    Ver Catálogo Completo

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>

                </a>
            </div>
        </div>
    </section>

    <!-- Seccion servicios -->
    <section class="py-28 bg-gray-100">

        <div class="max-w-7xl mx-auto px-6">

            <div class="grid md:grid-cols-3 gap-16 items-center">

                <!-- Información -->
                <div class="col-span-2 sm:col-span-1" data-aos="fade-right">

                    <!-- Encabezado -->
                    <div class="flex items-center gap-4 mb-4">

                        <div class="w-14 h-[2px] bg-primary"></div>

                        <span class="uppercase tracking-[4px] text-xs text-dark">
                            Soporte Técnico
                        </span>

                    </div>

                    <h2 class="font-black uppercase leading-none">

                        <span class="block text-dark text-3xl">
                            Servicio Técnico
                        </span>

                        <span class="block text-primary text-3xl mt-2">
                            Certificado
                        </span>

                    </h2>


                    <!-- Servicios -->
                    <div class="mt-10 space-y-4">

                        <div class="border border-gray-400 rounded-xl py-5 px-8 text-center font-bold text-2xl text-dark">
                            Mantenimiento Preventivo
                        </div>

                        <div class="border border-gray-400 rounded-xl py-5 px-8 text-center font-bold text-2xl text-dark">
                            Reparación Especializada
                        </div>

                        <div class="border border-gray-400 rounded-xl py-5 px-8 text-center font-bold text-2xl text-dark">
                            Garantía Oficial
                        </div>

                    </div>


                    <!-- Botón -->
                    <div class="mt-5">

                        <a href="#"
                        class="inline-flex w-full items-center gap-4 bg-primary px-10 py-5 rounded-xl font-bold text-xl hover:bg-dark hover:text-white transition">

                            Agendar Visita Técnica

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"/>

                            </svg>

                        </a>

                    </div>

                </div>


                <!-- Imagen -->
                <div class="relative col-span-2" data-aos="fade-left">

                    <img
                        src="{{ asset('storage/img/img-servicios.jpg') }}"
                        class="rounded-3xl w-full h-[500px] object-cover"
                        alt="Servicio técnico">

                    <!-- Etiqueta -->
                    <div class="absolute top-8 right-8">

                        <div class="bg-primary rounded-xl px-8 py-4 font-bold text-xl text-dark shadow">

                            Técnicos Certificados

                        </div>

                    </div>

                </div>

            </div>

                    <!-- Proceso -->
            <div
                class="bg-dark rounded-[2rem] mt-20 px-12 py-16"
                data-aos="fade-up">

                <div class="mb-12">

                    <h3 class="text-primary uppercase text-2xl font-bold">
                        Nuestro Proceso
                    </h3>

                </div>


                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10">

                    <!-- Paso 1 -->
                    <div class="relative">

                        <div class="text-white font-black text-7xl">
                            01
                        </div>

                        <h4 class="text-primary text-xl tracking-[4px] uppercase mt-2">
                            Diagnóstico
                        </h4>

                        <p class="text-gray-300 mt-4">
                            Evaluamos tu equipo y te damos un reporte preciso y sin costo.
                        </p>

                    </div>


                    <!-- Paso 2 -->
                    <div class="relative">

                        <div class="absolute left-0 top-0 h-full w-[2px] bg-primary hidden lg:block"></div>

                        <div class="pl-10">

                            <div class="text-white font-black text-7xl">
                                02
                            </div>

                            <h4 class="text-primary text-xl tracking-[4px] uppercase mt-2">
                                Cotización
                            </h4>

                            <p class="text-gray-300 mt-4">
                                Presupuesto detallado, sin letras pequeñas ni sorpresas.
                            </p>

                        </div>

                    </div>


                    <!-- Paso 3 -->
                    <div class="relative">

                        <div class="absolute left-0 top-0 h-full w-[2px] bg-primary hidden lg:block"></div>

                        <div class="pl-10">

                            <div class="text-white font-black text-7xl">
                                03
                            </div>

                            <h4 class="text-primary text-xl tracking-[4px] uppercase mt-2">
                                Reparación
                            </h4>

                            <p class="text-gray-300 mt-4">
                                Técnicos certificados con repuestos originales de cada marca.
                            </p>

                        </div>

                    </div>


                    <!-- Paso 4 -->
                    <div class="relative">

                        <div class="absolute left-0 top-0 h-full w-[2px] bg-primary hidden lg:block"></div>

                        <div class="pl-10">

                            <div class="text-white font-black text-7xl">
                                04
                            </div>

                            <h4 class="text-primary text-xl tracking-[4px] uppercase mt-2">
                                Entrega
                            </h4>

                            <p class="text-gray-300 mt-4">
                                Equipo funcionando como nuevo con garantía escrita.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Seccion contacto -->
    <section id="contacto" class="py-32 bg-gray-100">

        <div class="max-w-7xl mx-auto px-6">

            <!-- Encabezado -->
            <div class="text-center mb-16" data-aos="fade-up">

                <div class="flex items-center justify-center gap-4 mb-4">

                    <div class="w-14 h-[2px] bg-primary"></div>

                    <span class="uppercase tracking-[4px] text-xs text-dark">
                        Contáctanos
                    </span>

                    <div class="w-14 h-[2px] bg-primary"></div>

                </div>

                <h2 class="font-black uppercase leading-none">

                    <span class="block text-dark text-5xl">
                        Estamos para
                    </span>

                    <span class="block text-primary text-5xl">
                        Ayudarte
                    </span>

                </h2>

                <p class="max-w-2xl mx-auto mt-6 text-gray-600">
                    Nuestro equipo comercial está listo para brindarte asesoría,
                    cotizaciones y acompañamiento en la selección de equipos industriales.
                </p>

            </div>


            <!-- Contenedor principal -->
            <div class="grid lg:grid-cols-5 overflow-hidden rounded-[2.5rem] shadow-2xl">

                <!-- Formulario -->
                <div class="lg:col-span-3 bg-white p-10 lg:p-14" data-aos="fade-right">

                    <h3 class="text-3xl font-bold text-dark mb-10">
                        Envíanos un mensaje
                    </h3>

                    <form class="space-y-6">

                        <div>

                            <label class="block mb-2 text-sm font-semibold text-gray-700">
                                Nombre completo
                            </label>

                            <input
                                type="text"
                                class="w-full rounded-xl border-gray-300 px-5 py-4 focus:border-primary focus:ring-primary">

                        </div>


                        <div>

                            <label class="block mb-2 text-sm font-semibold text-gray-700">
                                Correo electrónico
                            </label>

                            <input
                                type="email"
                                class="w-full rounded-xl border-gray-300 px-5 py-4 focus:border-primary focus:ring-primary">

                        </div>


                        <div>

                            <label class="block mb-2 text-sm font-semibold text-gray-700">
                                Mensaje
                            </label>

                            <textarea
                                rows="6"
                                class="w-full rounded-2xl border-gray-300 px-5 py-4 resize-none focus:border-primary focus:ring-primary"></textarea>

                        </div>


                        <button
                            class="bg-primary px-8 py-4 rounded-xl font-bold text-dark hover:bg-dark hover:text-white transition">

                            Enviar mensaje <i class='bx bx-send text-xl'></i> 

                        </button>

                    </form>

                </div>


                <!-- Panel lateral -->
                <div
                    class="lg:col-span-2 bg-dark text-white p-10 lg:p-14"
                    data-aos="fade-left">

                    <h3 class="text-3xl font-bold mb-4">
                        Información de contacto
                    </h3>

                    <p class="text-gray-300 mb-12">
                        Estamos disponibles para atender tus requerimientos y brindarte soporte especializado.
                    </p>


                    <div class="space-y-10">

                        <!-- Teléfono -->
                        <div class="flex gap-5">

                            <div class="bg-primary w-14 h-14 rounded-2xl flex items-center justify-center">

                                <i class='bx bx-phone text-3xl'></i>

                            </div>

                            <div>

                                <p class="text-gray-400 text-sm uppercase">
                                    Teléfono
                                </p>

                                <p class="font-semibold text-lg">
                                    +57 302 6400248
                                </p>

                            </div>

                        </div>


                        <!-- Correo -->
                        <div class="flex gap-5">

                            <div class="bg-primary w-14 h-14 rounded-2xl flex items-center justify-center">

                                <i class='bx bx-envelope text-3xl'></i>

                            </div>

                            <div>

                                <p class="text-gray-400 text-sm uppercase">
                                    Correo
                                </p>

                                <p class="font-semibold text-lg">
                                    ventas@distrimorgan.com
                                </p>

                            </div>

                        </div>


                        <!-- Dirección -->
                        <div class="flex gap-5">

                            <div class="bg-primary w-14 h-14 rounded-2xl flex items-center justify-center">

                                <i class='bx bx-map-pin text-3xl'></i>

                            </div>

                            <div>

                                <p class="text-gray-400 text-sm uppercase">
                                    Dirección
                                </p>

                                <p class="font-semibold text-lg">
                                    Neiva, Huila - Colombia
                                </p>

                            </div>

                        </div>


                        <!-- Horario -->
                        <div class="flex gap-5">

                            <div class="bg-primary w-14 h-14 rounded-2xl flex items-center justify-center">

                                <i class='bx bx-time text-3xl'></i>

                            </div>

                            <div>

                                <p class="text-gray-400 text-sm uppercase">
                                    Horario
                                </p>

                                <p class="font-semibold text-lg">
                                    Lun - Sáb: 8:00 AM - 6:00 PM
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Slide industrias -->
    <script>
        new Swiper('.industriasSwiper', {
            slidesPerView: 1.2,
            spaceBetween: 12,
            loop: true,

            navigation: {
                nextEl: '.industrias-next',
                prevEl: '.industrias-prev',
            },

            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },

            breakpoints: {
                640: {
                    slidesPerView: 1.2,
                },
                768: {
                    slidesPerView: 2.2,
                },
                1024: {
                    slidesPerView: 3,
                },
                1280: {
                    slidesPerView: 4,
                }
            }
        });
    </script>

    <!-- Slide marcas -->
    <script>
        new Swiper('.marcasSwiper', {
            slidesPerView: 1.2,
            spaceBetween: 12,
            loop: true,

            navigation: {
                nextEl: '.marcas-next',
                prevEl: '.marcas-prev',
            },

            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },

            breakpoints: {
                640: {
                    slidesPerView: 2.2,
                },
                768: {
                    slidesPerView: 3.2,
                },
                1024: {
                    slidesPerView: 4,
                },
                1280: {
                    slidesPerView: 5,
                }
            }
        });
    </script>

    <!-- estadisticas de marcas -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {

        const counters = document.querySelectorAll('.contador');

        const observer = new IntersectionObserver((entries) => {

            entries.forEach(entry => {

                if (entry.isIntersecting) {

                    counters.forEach(counter => {

                        if (counter.dataset.started) return;

                        counter.dataset.started = true;

                        const target = parseInt(counter.dataset.target);
                        const suffix = counter.dataset.suffix || '';

                        let current = 0;
                        const increment = target / 120;

                        const update = () => {

                            current += increment;

                            if (current >= target) {
                                counter.textContent =
                                    target.toLocaleString() + suffix;
                            } else {

                                counter.textContent =
                                    Math.floor(current).toLocaleString() + suffix;

                                requestAnimationFrame(update);
                            }

                        };

                        update();

                    });

                    observer.disconnect();

                }

            });

        }, {
            threshold: 0.4
        });

        observer.observe(document.querySelector('#section-brands'));

    });
    </script>

    <!-- WhatsApp -->
    <a
        href="https://wa.me/573026400248?text=Hola%20DistriMorgan,%20quiero%20solicitar%20una%20cotizaci%C3%B3n"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Contactar por WhatsApp"
        class="fixed bottom-6 right-6 z-[60] flex h-16 w-16 items-center justify-center rounded-full bg-[#25D366] text-white shadow-xl transition duration-300 hover:scale-110 hover:bg-[#128C7E]"
    >
        <i class="bx bxl-whatsapp text-4xl" aria-hidden="true"></i>
    </a>

    <!-- Footer -->
    @include('partials.footer')


</body>
</html>

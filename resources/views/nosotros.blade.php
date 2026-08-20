<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    @include('partials.header')
    <title>Distribuidora Morgan</title>
    <meta name="description" content="Distribuidora líder en herramientas y equipos industriales. Más de 15 años ofreciendo calidad y servicio excepcional">
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('partials.navbar')

        <!-- Page Content -->
        <main>
            @yield('content')
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
            <section class="py-16 bg-gray-100">
                <div class="max-w-6xl mx-auto px-4 py-12 flex flex-col md:flex-row items-center justify-between gap-8 md:gap-16">
    
                <!-- Bloque de Texto (Izquierda) -->
                <div class="w-full md:w-1/2 flex flex-col items-start text-left">
                    <h1 class="font-black uppercase leading-none">

                        <span class="block text-black text-5xl md:text-7xl">
                            Nuestra
                        </span>

                        <span class="block text-primary text-5xl md:text-7xl">
                            Empresa
                        </span>

                    </h1>
                    
                    <p class="mt-6 text-sm md:text-base text-gray-600 leading-relaxed font-normal">
                        En Distri Morgan trabajamos para ofrecer maquinaria industrial, herramientas especializadas, repuestos y servicio técnico certificado para diferentes sectores productivos.
                    </p>
                    
                    <!-- Botón -->
                    <div class="mt-10">
                        <a
                            href="#"
                            class="inline-flex items-center gap-3 bg-primary transition rounded-full font-semibold text-black text-center px-3 py-1 hover:bg-dark hover:rounded-full hover:text-white"
                        >
                            Contáctanos

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

                <!-- Bloque de Imagen (Derecha) -->
                <div class="w-full md:w-1/2 rounded-t-[40px] rounded-br-[40px] rounded-bl-[120px]">
                    <div class="relative overflow-hidden rounded-t-[40px] rounded-br-[40px] rounded-bl-[120px] aspect-[4/3] shadow-md">
                        <img src="{{ asset('storage\img\img-servicios.jpg') }}" alt="Operario trabajando" class="w-full h-full object-cover">
                    </div>
                </div>

            </section>
                <!-- Contenedor Principal (Fondo gris claro) -->
<section class="bg-[#F8FAFC] py-16 px-4">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Tarjeta: Misión -->
        <div class="flex items-center gap-6 p-8 bg-white border border-gray-200 rounded-[20px] shadow-sm">
            <!-- Círculo del Ícono -->
            <div class="flex-shrink-0 flex items-center justify-center w-20 h-20 bg-[#D1A13B] rounded-full">
                <!-- Ícono de Diana (SVG) -->
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://w3.org">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18c3.314 0 6-2.686 6-6s-2.686-6-6-6-6 2.686-6 6 2.686 6 6 6z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 5l-3 3"></path>
                </svg>
            </div>
            <!-- Textos -->
            <div class="flex flex-col justify-center">
                <h3 class="text-2xl font-black text-black mb-1">Misión</h3>
                <p class="text-xs text-gray-600 leading-relaxed max-w-sm">
                    En Distri Morgan trabajamos para ofrecer maquinaria industrial, herramientas especializadas, repuestos y servicio técnico.
                </p>
            </div>
        </div>

        <!-- Tarjeta: Visión -->
        <div class="flex items-center gap-6 p-8 bg-white border border-gray-200 rounded-[20px] shadow-sm">
            <!-- Círculo del Ícono -->
            <div class="flex-shrink-0 flex items-center justify-center w-20 h-20 bg-[#D1A13B] rounded-full">
                <!-- Ícono de Ojo (SVG) -->
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://w3.org">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </div>
            <!-- Textos -->
            <div class="flex flex-col justify-center">
                <h3 class="text-2xl font-black text-black mb-1">Visión</h3>
                <p class="text-xs text-gray-600 leading-relaxed max-w-sm">
                    En Distri Morgan trabajamos para ofrecer maquinaria industrial, herramientas especializadas, repuestos y servicio técnico certificado.
                </p>
            </div>
        </div>

    </div>
</section>
                 
        </main>

    </div>

    @include('partials.footer')
</body>
</html>

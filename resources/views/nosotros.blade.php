
@include('partials.navbar')
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
                                    CONOCE
                                </span>

                                <span class="block text-primary text-5xl md:text-7xl">
                                    DISTRI MORGAN
                                </span>

                            </h1>

                            <!-- Descripción -->
                            <p class="mt-8 text-gray-200 text-lg max-w-xl text-center mx-auto">
                                Más de XX años ofreciendo soluciones industriales para empresas
                                que buscan productividad, precision y respaldo tecnico.
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
            <!-- Nuestra empresa -->
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
                        Distribuimos maquinaria industrial (sierras, molinos, empacadoras al vacio, embutidoras, balanzas, plataformas y basculas tipo gancho, estibadora, colgantes y de mesa, equipos para sistema POS.. y consumibles (papel, cuchillas, cintas, bolsas al vacio)... Demas utensilios como cuchillos profesionales, tablas para picar, guantes y ganchos en acero inoxidable... Estamos en el mercado comercial e industrial con nuestras marcas aliadas JAVAR TRAMONTINA, DIBAL, SALVADOR, DIGITAL POS, SAT, JALTECH KRAMER, METTLER
                    </p>
                    
                    <!-- Botón -->
                    <div class="mt-10 ">
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
            <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Misión -->
            <div class="flex items-start gap-6 border border-gray-300 rounded-2xl p-8">
                <div class="flex-shrink-0 w-20 h-20 aspect-square rounded-full bg-primary flex items-center justify-center">
                    <i class='bx bx-target-lock text-white text-4xl'></i>
                </div>
                <div>
                    <h3 class="font-black text-dark text-3xl mb-2">Misión</h3>
                    <p class="text-dark text-sm">
                        En Distri Morgan trabajamos para ofrecer maquinaria industrial,
                        herramientas especializadas, repuestos y servicio técnico
                    </p>
                </div>
            </div>

            <!-- Visión -->
            <div class="flex items-start gap-6 border border-gray-300 rounded-2xl p-8">
                <div class="flex-shrink-0 w-20 h-20 aspect-square rounded-full bg-primary flex items-center justify-center">
                    <i class='bx bx-show text-white text-4xl'></i>
                </div>
                <div>
                    <h3 class="font-black text-dark text-3xl mb-2">Visión</h3>
                    <p class="text-dark text-sm">
                        En Distri Morgan trabajamos para ofrecer maquinaria industrial,
                        herramientas especializadas, repuestos y servicio técnico certificado
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
            
                 
        </main>

    </div>

    @include('partials.footer')
</body>

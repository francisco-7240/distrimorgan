<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        @include('partials.header')

        <title>{{ config('app.name') }} - Nosotros</title>
        <meta name="description" content="Distribuidora Morgan - Conoce nuestra empresa, misión y visión. Descubre cómo ofrecemos maquinaria industrial, herramientas especializadas y servicio técnico certificado para potenciar tu negocio.">

    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- Banner -->
        <section class="relative w-full h-64 sm:h-80 md:h-96 bg-cover bg-center overflow-hidden" style="background-image: url('{{ asset('storage/img/banner_mis_productos.jpeg') }}')">
            <!-- Capa oscura -->
            <div class="absolute inset-0 bg-black/70"></div>

            <!-- Contenido -->
            <div class="relative flex min-h-screen items-start pt-28 pb-28 md:pt-44 lg:pt-48">
                <div class="container px-6 lg:px-10 w-full">
                    <!-- Título -->
                    <h1 class="font-black uppercase leading-none text-white text-4xl md:text-7xl">Conoce a <span class="text-primary">Distri Morgan</span>
                    </h1>
                </div>
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
                        href="/contacto"
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
                            <p class="text-dark text-sm text-justify">
                                DISTRI MORGAN es la empresa que se especializa en la distribución de equipos industriales y profesionales, repuestos, utensilios entre otros; ofreciendo un producto y servicio diversificado con calidad y confianza, proporcionando soluciones logísticas e innovadoras, contribuyendo a la optimización de tiempos y recursos en los procesos, brindando seguridad a los clientes en cumplimiento a las normas sanitarias, conectando de manera efectiva a un servicio excepcional a los productores con los consumidores, lo que les garantiza generar un mayor rendimiento, aportando al crecimiento y desarrollo en el ámbito comercial e industrial en un mercado más competitivo, gracias a la innovación y durabilidad de nuestros productos.
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
                            <p class="text-dark text-sm text-justify">
                                DISTRI MORGAN será la empresa líder y referente en la distribución de equipos industriales y profesionales, repuestos y utensilios a nivel nacional, reconocida por la excelencia, calidad y confianza de sus productos y servicios. Consolidaremos alianzas estratégicas con productores y consumidores, ampliando nuestra cobertura y presencia en el mercado, mediante la incorporación continua de tecnología, innovación logística y procesos sostenibles. Seremos la opción preferida de nuestros clientes gracias a un equipo humano altamente calificado y comprometido, que garantiza soluciones eficientes, seguras y de vanguardia, impulsando el crecimiento del sector comercial e industrial y contribuyendo al desarrollo económico de la región.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        @include('partials.footer')

    </body>
</html>


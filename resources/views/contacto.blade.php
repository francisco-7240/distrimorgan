<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        @include('partials.header')

        <title>{{ config('app.name') }} - Contacto</title>
        <meta name="description" content="Distribuidora Morgan - Contáctanos para obtener información sobre nuestros productos y servicios. Estamos aquí para ayudarte a potenciar tu negocio con maquinaria industrial, herramientas especializadas y servicio técnico certificado.">

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
                    <h1 class="font-black uppercase leading-none text-white text-4xl md:text-7xl">Estamos para <span class="text-primary">Ayudarte</span>
                    </h1>
                </div>
            </div>

        </section>

        <section id="contacto" class="py-32 bg-gray-100">

            
            <div class="max-w-7xl mx-auto px-6">
                <div class="mb-10 border-b border-gray-200 pb-6">
                    <p class="mb-2 text-lg font-semibold uppercase tracking-[0.18em] text-primary">¿Necesitas ayuda?</p>
                    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
                        <div>
                            <p class="mt-2 max-w-xl text-sm text-gray-600">Nuestro equipo comercial está listo para brindarte asesoría, cotizaciones y acompañamiento en la selección de equipos industriales.</p>
                        </div>
                    </div>
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
                                        Calle 45 #23-67, Bogotá, Colombia
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
                                        Lun - Sáb: 7:00 AM - 6:00 PM
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        @include('partials.footer')

    </body>
</html>



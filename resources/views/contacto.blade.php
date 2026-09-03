
@include('partials.navbar')
<head>
    @include('partials.header')
    <title>Distribuidora Morgan</title>
    <meta name="description" content="Distribuidora líder en herramientas y equipos industriales. Más de 15 años ofreciendo calidad y servicio excepcional">
</head>
<main>
    <section @class(['relative', 'w-full', 'min-h-screen', 'bg-cover', 'bg-center']) style="background-image: url('{{ asset('storage/img/img-banner-principal.jpg') }}')">
                <!-- Capa oscura -->
        <div @class(['absolute', 'inset-0', 'bg-black/60'])></div>

                <!-- Contenido -->
                <div @class(['relative', 'z-10', 'flex', 'items-center', 'min-h-screen'])>
                    <div @class(['max-w-1xl', 'mx-auto', 'text-center', 'px-6', 'lg:px-10', 'w-full'])>

                        <div @class(['max-w-1xl'])>

                            <!-- Título -->
                            <h1 @class(['font-black', 'uppercase', 'leading-none'])>

                                <span @class(['block', 'text-white', 'text-5xl', 'md:text-7xl'])>
                                    Estamos para
                                </span>

                                <span @class(['block', 'text-primary', 'text-5xl', 'md:text-7xl'])>
                                    Ayudarte
                                </span>

                            </h1>

                            <!-- Descripción -->
                            <p @class(['mt-8', 'text-gray-200', 'text-lg', 'max-w-xl', 'text-center', 'mx-auto'])>
                                Nuestro equipo comercial está listo para brindarte asesoría,
                                cotizaciones y acompañamiento en la selección de equipos industriales.
                            </p>
                        </div>

                    </div>
                </div>
                <!-- Indicador de scroll -->
                <div @class(['absolute', 'bottom-8', 'left-1/2', '-translate-x-1/2', 'z-20'])>
                    <a href="#section-category" @class(['flex', 'flex-col', 'items-center', 'text-white', 'transition', 'duration-300', 'hover:scale-110'])>
                        <div @class(['w-5', 'h-10', 'border', 'border-white', 'rounded-full', 'flex', 'justify-center', 'pt-2'])>
                            <div @class(['w-1', 'h-2', 'bg-primary', 'rounded-full', 'animate-bounce'])></div>
                        </div>
                    </a>
                </div>
    </section>
    <section id="contacto" class="py-32 bg-gray-100">

        <div class="max-w-7xl mx-auto px-6">

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
</main>

@include('partials.footer')

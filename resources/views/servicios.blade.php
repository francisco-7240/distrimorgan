
@include('partials.navbar')
<head>
    @include('partials.header')
    <title>Distribuidora Morgan</title>
    <meta name="description" content="Distribuidora líder en herramientas y equipos industriales. Más de 15 años ofreciendo calidad y servicio excepcional">
</head>
<main>
    <!-- Banner principal -->
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
                                    SERVICIO TÉCNICO
                                </span>

                                <span @class(['block', 'text-primary', 'text-5xl', 'md:text-7xl'])>
                                    PARA TU NEGOCIO
                                </span>

                            </h1>

                            <!-- Descripción -->
                            <p @class(['mt-8', 'text-gray-200', 'text-lg', 'max-w-xl', 'text-center', 'mx-auto'])>
                                Diagnóstico, reparación y mantenimiento especializado para
                                cocinas profesionales que necesitan seguir produciendo.
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
    <!-- Encabezado -->
    <section>
        <div @class(['max-w-7xl', 'mx-auto', 'px-6', 'mt-16', 'sm:mt-32']) data-aos="fade-up">

            <!-- Encabezado -->
            <div @class(['text-center', 'mb-14'])>

                <div @class(['flex', 'items-center', 'justify-center', 'gap-4', 'mb-4'])>

                    <div @class(['w-14', 'h-[2px]', 'bg-primary'])></div>

                    <span @class(['uppercase', 'tracking-[3px]', 'text-xs', 'text-dark'])>
                        EL RESPALDO QUE TU OPERACIÓN NECESITA
                    </span>

                    <div @class(['w-14', 'h-[2px]', 'bg-primary'])></div>

                </div>

                <h2 @class(['font-black', 'uppercase', 'leading-none'])>

                    <span @class(['block', 'text-dark', 'text-5xl'])>
                        MENOS TIEMPO DETENIDO
                    </span>

                    <span @class(['block', 'text-primary', 'text-5xl'])>
                        MÁS NEGOCIO FUNCIONANDO
                    </span>

                </h2>

                <p @class(['max-w-xl', 'mx-auto', 'mt-5', 'text-gray-700'])>
                    Cuando un equipo falla, cada minuto cuenta. Somos el aliado técnico de restaurantes,
                    hoteles y negocios de alimentos que exigen soluciones claras, rápidas y duraderas.
                </p>

        </div>
    </section>
    {{-- Soluciones especializadas --}}
    <section
        id="soluciones"
        @class(['bg-[#e6e4e1]', 'px-4', 'py-14', 'sm:px-8', 'lg:px-16', 'sm:py-20', 'overflow-hidden'])
        aria-labelledby="soluciones-title"
    >
    <div @class(['mx-auto', 'max-w-7xl'])>

        {{-- Encabezado --}}
        <div @class(['grid', 'grid-cols-1', 'gap-8', 'lg:grid-cols-2', 'lg:items-end'])>
            <div>
                <div @class(['flex', 'items-center', 'gap-3'])>
                    <span @class(['h-0.5', 'w-12', 'bg-[#c99b3a]'])></span>
                    <span @class(['text-xs', 'font-bold', 'uppercase', 'tracking-[0.25em]', 'text-[#c99b3a]'])>
                        Soluciones especializadas
                    </span>
                </div>

                <h2 id="soluciones-title" @class(['mt-5', 'font-sans', 'text-4xl', 'font-black', 'uppercase', 'leading-[0.95]', 'tracking-tight', 'sm:text-5xl'])>
                    <span @class(['block', 'text-slate-950'])>Todo el soporte.</span>
                    <span @class(['block', 'text-[#c99b3a]'])>En un solo equipo.</span>
                </h2>
            </div>

            <p @class(['max-w-md', 'text-xl', 'leading-relaxed', 'text-slate-700', 'lg:justify-self-end', 'lg:text-right'])>
                Conocemos la presión de una cocina profesional. Por eso resolvemos con precisión desde el primer diagnóstico.
            </p>
        </div>

        {{-- Tarjetas --}}
        <div @class(['mt-12', 'grid', 'grid-cols-1', 'gap-6', 'sm:grid-cols-2', 'lg:grid-cols-3'])>

            {{-- Tarjeta 1: fondo negro --}}
            <article @class(['relative', 'flex', 'min-h-[320px]', 'flex-col', 'justify-end', 'overflow-hidden', 'bg-slate-950', 'p-8', 'transition', 'hover:-translate-y-1'])>
                <h3 @class(['font-sans', 'text-2xl', 'font-black', 'leading-tight', 'text-white'])>
                    Reparación<br>especializada
                </h3>
                <p @class(['mt-4', 'text-sm', 'font-semibold', 'leading-relaxed', 'text-slate-200'])>
                    Intervenimos tus equipos con piezas de calidad y procesos certificados.
                </p>
            </article>

            {{-- Tarjeta 2: imagen de fondo con overlay --}}
            <article @class(['group', 'relative', 'flex', 'min-h-[320px]', 'flex-col', 'justify-end', 'overflow-hidden', 'p-8', 'transition', 'hover:-translate-y-1'])>
                <img
                    src="{{ asset('storage/img/img-servicios.jpg') }}"
                    alt="Técnico realizando mantenimiento"
                    @class(['absolute', 'inset-0', 'h-full', 'w-full', 'object-cover'])
                >
                <div @class(['absolute', 'inset-0', 'bg-gradient-to-t', 'from-black/80', 'via-black/30', 'to-black/10'])></div>

                <div @class(['relative'])>
                    <h3 @class(['font-sans', 'text-2xl', 'font-black', 'leading-tight', 'text-white'])>
                        Mantenimiento<br>preventivo
                    </h3>
                    <p @class(['mt-4', 'text-sm', 'font-semibold', 'leading-relaxed', 'text-slate-100'])>
                        Evita paros inesperados y alarga la vida útil de tu inversión.
                    </p>
                </div>
            </article>

            {{-- Tarjeta 3: fondo dorado --}}
            <article @class(['relative', 'flex', 'min-h-[320px]', 'flex-col', 'justify-end', 'overflow-hidden', 'bg-[#c99b3a]', 'p-8', 'transition', 'hover:-translate-y-1'])>
                <h3 @class(['font-sans', 'text-2xl', 'font-black', 'leading-tight', 'text-slate-950'])>
                    Diagnóstico<br>confiable
                </h3>
                <p @class(['mt-4', 'text-sm', 'font-semibold', 'leading-relaxed', 'text-slate-900'])>
                    Te explicamos qué sucede y cuál es la mejor decisión para tu negocio.
                </p>
            </article>

        </div>
    </div>
    </section>
    <section>
        <div
                @class(['bg-dark', 'mt-20', 'px-80', 'py-16','mx-auto' ])
                data-aos="fade-up">

                <div @class(['mb-12'])>

                    <span @class(['uppercase', 'tracking-[3px]', 'text-xs', 'text-white'])>
                        EL RESPALDO QUE TU OPERACIÓN NECESITA
                    </span>


                    <h3 @class(['text-primary', 'uppercase', 'text-2xl', 'font-bold'])>
                        Nuestro Proceso
                    </h3>

                </div>


                <div @class(['grid', 'md:grid-cols-2', 'lg:grid-cols-4', 'gap-10'])>

                    <!-- Paso 1 -->
                    <div @class(['relative'])>

                        <div @class(['text-white', 'font-black', 'text-7xl'])>
                            01
                        </div>

                        <h4 @class(['text-primary', 'text-xl', 'tracking-[4px]', 'uppercase', 'mt-2'])>
                            Diagnóstico
                        </h4>

                        <p @class(['text-gray-300', 'mt-4'])>
                            Evaluamos tu equipo y te damos un reporte preciso y sin costo.
                        </p>

                    </div>


                    <!-- Paso 2 -->
                    <div @class(['relative'])>

                        <div @class(['absolute', 'left-0', 'top-0', 'h-full', 'w-[2px]', 'bg-primary', 'hidden', 'lg:block'])></div>

                        <div @class(['pl-10'])>

                            <div @class(['text-white', 'font-black', 'text-7xl'])>
                                02
                            </div>

                            <h4 @class(['text-primary', 'text-xl', 'tracking-[4px]', 'uppercase', 'mt-2'])>
                                Cotización
                            </h4>

                            <p @class(['text-gray-300', 'mt-4'])>
                                Presupuesto detallado, sin letras pequeñas ni sorpresas.
                            </p>

                        </div>

                    </div>


                    <!-- Paso 3 -->
                    <div @class(['relative'])>

                        <div @class(['absolute', 'left-0', 'top-0', 'h-full', 'w-[2px]', 'bg-primary', 'hidden', 'lg:block'])></div>

                        <div @class(['pl-10'])>

                            <div @class(['text-white', 'font-black', 'text-7xl'])>
                                03
                            </div>

                            <h4 @class(['text-primary', 'text-xl', 'tracking-[4px]', 'uppercase', 'mt-2'])>
                                Reparación
                            </h4>

                            <p @class(['text-gray-300', 'mt-4'])>
                                Técnicos certificados con repuestos originales de cada marca.
                            </p>

                        </div>

                    </div>


                    <!-- Paso 4 -->
                    <div @class(['relative'])>

                        <div @class(['absolute', 'left-0', 'top-0', 'h-full', 'w-[2px]', 'bg-primary', 'hidden', 'lg:block'])></div>

                        <div @class(['pl-10'])>

                            <div @class(['text-white', 'font-black', 'text-7xl'])>
                                04
                            </div>

                            <h4 @class(['text-primary', 'text-xl', 'tracking-[4px]', 'uppercase', 'mt-2'])>
                                Entrega
                            </h4>

                            <p @class(['text-gray-300', 'mt-4'])>
                                Equipo funcionando como nuevo con garantía escrita.
                            </p>

                        </div>

                    </div>

                </div>

            </div>
    </section>
    {{-- La diferencia Morgan --}}
<section
    id="experiencia"
    @class(['bg-white', 'px-4', 'py-14', 'sm:px-8', 'lg:px-16', 'sm:py-20'])
    aria-labelledby="experiencia-title"
>
    <div @class(['mx-auto', 'grid', 'max-w-7xl', 'grid-cols-1', 'items-center', 'gap-10', 'lg:grid-cols-2', 'lg:gap-16'])>

        {{-- Imagen --}}
        <div @class(['order-1'])>
            <img
                src="{{ asset('storage/img/img-servicios.jpg') }}"
                alt="Técnico especializado reparando un equipo de cocina"
                @class(['aspect-[4/3]', 'w-full', 'rounded-[2.5rem]', 'object-cover', 'shadow-[0_20px_50px_rgba(0,0,0,0.18)]'])
            >
        </div>

        {{-- Contenido --}}
        <div @class(['order-2'])>
            {{-- Rótulo --}}
            <div @class(['flex', 'items-center', 'gap-3'])>
                <span @class(['h-0.5', 'w-12', 'bg-[#c99b3a]'])></span>
                <span @class(['text-xs', 'font-bold', 'uppercase', 'tracking-[0.25em]', 'text-[#c99b3a]'])>
                    La diferencia Morgan
                </span>
            </div>

            {{-- Título --}}
            <h2 id="experiencia-title" @class(['mt-5', 'font-display', 'text-4xl', 'font-black', 'uppercase', 'leading-[0.95]', 'tracking-tight', 'sm:text-5xl'])>
                <span @class(['block', 'text-slate-950'])>La experiencia</span>
                <span @class(['block', 'text-slate-950'])>se nota</span>
                <span @class(['block', 'text-[#c99b3a]'])>en cada detalle.</span>
            </h2>

            {{-- Lista de beneficios --}}
            <ul @class(['mt-8', 'space-y-2.5'])>
                @foreach([
                    'Técnicos certificados y capacitados',
                    'Repuestos originales y compatibles',
                    'Garantía por escrito en cada trabajo',
                    'Atención cercana, clara y sin rodeos',
                ] as $beneficio)
                    <li @class(['text-base', 'font-semibold', 'text-slate-800'])>
                        {{ $beneficio }}
                    </li>
                @endforeach
            </ul>

            {{-- Botón --}}
            <div @class(['mt-9'])>
                <a
                    href="#contacto"
                    @class(['group', 'inline-flex', 'items-center', 'gap-3', 'rounded-xl', 'bg-[#c99b3a]', 'px-8', 'py-4', 'text-base', 'font-bold', 'text-slate-950', 'shadow-lg', 'transition', 'hover:bg-[#b3862d]'])
                >
                    Contáctanos
                    <span aria-hidden="true" @class(['text-lg', 'leading-none', 'transition-transform', 'group-hover:translate-x-1'])>&rsaquo;</span>
                </a>
            </div>
        </div>
    </div>
</section>
    
    
</main>

@include('partials.footer')
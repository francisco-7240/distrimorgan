
<!-- Footer -->
<footer
    class="relative bg-cover bg-center"
    style="background-image: url('{{ asset('storage/img/img-fondo-footer.jpg') }}')"
    data-aos="fade-in"
>

    <!-- Capa oscura -->
    <div class="absolute inset-0 bg-black/80"></div>

    <div class="relative z-10 border-t-4 border-primary">

        <div class="max-w-7xl mx-auto px-6 py-20">

            <div class="grid lg:grid-cols-3 gap-16">

                <!-- Logo y descripción -->
                <div data-aos="fade-right">

                    <img
                        src="{{ asset('storage/logo/logo-distri-white.png') }}"
                        class="w-36"
                        alt="Distri Morgan">

                    <p class="mt-8 text-gray-200 text-lg max-w-md leading-relaxed">
                        Distribuidora líder en herramientas y equipos industriales.
                        Más de 15 años ofreciendo calidad y servicio excepcional.
                    </p>

                    <!-- Redes -->
                    <div class="mt-10">

                        <h3 class="text-2xl font-semibold text-white mb-5">
                            Síguenos
                        </h3>

                        <div class="flex items-center gap-4">

                            <!-- Facebook -->
                            <a
                                href="{{ config('app.redfacebook') }}"
                                class="w-8 h-8 rounded-full bg-white flex items-center justify-center
                                text-dark text-2xl hover:bg-primary transition">

                                <i class='bx bxl-facebook'></i>

                            </a>

                            <!-- Instagram -->
                            <a
                                href="{{ config('app.redinstagram') }}"
                                class="w-8 h-8 rounded-full bg-white flex items-center justify-center
                                text-dark text-2xl hover:bg-primary transition">

                                <i class='bx bxl-instagram'></i>

                            </a>
                            <!-- Youtube -->
                            <a
                                href="{{ config('app.redyoutube') }}"
                                class="w-8 h-8 rounded-full bg-white flex items-center justify-center
                                text-dark text-2xl hover:bg-primary transition">

                                <i class='bx bxl-youtube'></i>

                            </a>

                        </div>

                    </div>

                </div>


                <!-- Menú -->
                <div data-aos="fade-up">

                    <h3 class="text-3xl font-bold text-white mb-8">
                        Enlaces Rápidos
                    </h3>
                    <div class="mb-8 h-1 w-12 rounded-full bg-primary"></div>

                    <ul class="space-y-4 text-gray-200">

                        <li>
                            <a href="{{ route('home') }}"
                               class="hover:text-primary transition">
                                Inicio
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('nosotros') }}"
                               class="hover:text-primary transition">
                                Nosotros
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('productos') }}"
                               class="hover:text-primary transition">
                                Productos
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('servicios') }}"
                               class="hover:text-primary transition">
                                Servicios
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('contacto') }}"
                               class="hover:text-primary transition">
                                Contacto
                            </a>
                        </li>

                    </ul>

                </div>


                <!-- Contacto -->
                <div data-aos="fade-left">

                    <h3 class="text-3xl font-bold text-white mb-8">
                        Contacto
                    </h3>
                    <div class="mb-8 h-1 w-12 rounded-full bg-primary"></div>

                    <div class="space-y-6">

                        <!-- Dirección -->
                        <div class="flex gap-4">

                            <i class='bx bx-map text-primary text-3xl'></i>

                            <span class="text-gray-200 text-lg">
                                Calle 45 #23-67, Bogotá, Colombia
                            </span>

                        </div>


                        <!-- Teléfono -->
                        <div class="flex gap-4">

                            <i class='bx bx-phone text-primary text-3xl'></i>

                            <span class="text-gray-200 text-lg">
                                +57 302 6400248
                            </span>

                        </div>


                        <!-- Correo -->
                        <div class="flex gap-4">

                            <i class='bx bx-envelope text-primary text-3xl'></i>

                            <span class="text-gray-200 text-lg">
                                ventas@distrimorgan.com
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- Línea inferior -->
        <div class="border-t border-white/10">

            <div class="max-w-7xl mx-auto px-6 py-6">

                <div class="flex flex-col md:flex-row justify-between items-center gap-4">

                    <p class="text-gray-400 text-center md:text-left">
                        © {{ date('Y') }} Distri Morgan. Todos los derechos reservados.
                    </p>

                    <div class="flex items-center gap-6">
                        <p class="text-slate-400">
                            Desarrollado por
                            <a href="https://sharrys.com/" class="font-semibold text-primary hover:text-white" target="_blank" aria-label="Ir a Sharrys Tech">
                                Sharrys Tech
                            </a>
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</footer>


<!-- BOTÓN FLOTANTE "IR ARRIBA" -->
<button id="scrollTopBtn" aria-label="Ir Arriba"
    class="hidden fixed bottom-6 right-6 bg-primary text-white p-3 rounded-full shadow-lg hover:bg-dark transition transform hover:scale-110 cursor-pointer animate-bounce"
    onclick="scrollToTop()"
>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
         stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
    </svg>
</button>

<script>
    const scrollTopBtn = document.getElementById('scrollTopBtn');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            scrollTopBtn.classList.remove('hidden');
        } else {
            scrollTopBtn.classList.add('hidden');
        }
    });

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>

<!-- animaciones -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
    AOS.init({
        duration: 900,
        easing: 'ease-out-cubic',

        // SOLO se activa cuando entra al viewport
        once: true,

        // distancia antes de activar
        offset: 120,

        // evita activación prematura
        startEvent: 'load',

        // no repetir animación al subir
        mirror: false,
    });
</script>

<!-- Boxicons -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


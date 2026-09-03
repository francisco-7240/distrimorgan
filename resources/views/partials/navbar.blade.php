<header x-data="{ openMenu:false }" x-init="init()" class="absolute w-full z-50">
    <!-- NAVBAR DESKTOP -->
    <div class="hidden md:block" x-data="navbarHandler()" >
    <!-- BLOQUE 1: Top Bar -->
    <div x-transition class="bg-white text-dark">
        <div class="container mx-auto px-2">
            <div class="flex h-24 items-center justify-between gap-4">

                <!-- Logo -->
                <div class="flex justify-center">
                    <a href="{{ route('home') }}" aria-label="Ir al inicio">
                        <img src="{{ asset('storage/logo/logo_distrimorgan.png') }}"
                             alt="Logo opanoticias"
                             class="h-16 w-auto">
                    </a>
                </div>

                <!-- Fecha -->
                <div class="flex items-center gap-2 text-sm whitespace-nowrap">
                    <i class='bx bx-calendar'></i>
                    <span x-text="currentDate"></span>
                    <a href="#" class="text-dark bg-primary text-sm rounded-full font-medium hover:text-white" aria-label="Iniciar cotizacion">
                        <div class="text-center px-3 py-1 hover:bg-dark hover:rounded-full">
                            Solicitar cotización
                        </div>
                    </a>
                </div>

                <!-- Redes -->
                <div class="flex items-center gap-2" >
                    <a
                        target="_blank"
                        aria-label="Red Facebook"
                        href="{{ config('app.redfacebook') }}"
                        class="w-8 h-8 rounded-full bg-black flex items-center justify-center
                        text-white text-2xl hover:bg-primary transition">

                        <i class='bx bxl-facebook'></i>

                    </a>

                    <!-- Instagram -->
                    <a
                        target="_blank"
                        aria-label="Red Instagram"
                        href="{{ config('app.redinstagram') }}"
                        class="w-8 h-8 rounded-full bg-black flex items-center justify-center
                        text-white text-2xl hover:bg-primary transition">

                        <i class='bx bxl-instagram'></i>

                    </a>
                    <!-- Youtube -->
                    <a
                        target="_blank"
                        aria-label="Red Youtube"
                        href="{{ config('app.redyoutube') }}"
                        class="w-8 h-8 rounded-full bg-black flex items-center justify-center
                        text-white text-2xl hover:bg-primary transition">

                        <i class='bx bxl-youtube'></i>

                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- BLOQUE 3: Menú principal -->
    <nav x-data="{ scrolled: false }" @scroll.window="scrolled = window.scrollY > 130"
        :class="scrolled 
            ? 'bg-primary text-dark shadow-lg fixed top-0 z-[9999] w-full' 
            : 'bg-primary text-dark relative rounded-xl w-[800px] justify-self-center -top-4'"
        class="border-b transition-all duration-300">
        <div class="container mx-auto px-2">
            <div class="flex h-14 items-center justify-center">

                <ul class="fuentes flex items-center gap-10 overflow-x-auto whitespace-nowrap scrollbar-hide ">

                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="fuentes inline-flex items-center rounded-t-xl px-5 py-1 text-sm font-semibold !text-inherit hover:!text-white hover:bg-[#a17b1e] transition ">
                        Inicio
                    </x-nav-link>

                    <x-nav-link :href="route('nosotros')" :active="request()->routeIs('nosotros')" class="inline-flex items-center rounded-t-xl px-5 py-1 text-sm font-semibold !text-inherit hover:!text-white hover:bg-[#a17b1e] transition">
                        Nosotros
                    </x-nav-link>

                    <x-nav-link :href="route('productos')" :active="request()->routeIs('productos')" class="inline-flex items-center rounded-t-xl px-5 py-1 text-sm font-semibold !text-inherit hover:!text-white hover:bg-[#a17b1e] transition">
                        Productos
                    </x-nav-link>

                    <x-nav-link :href="route('servicios')" :active="request()->routeIs('servicios')" class="inline-flex items-center rounded-t-xl px-5 py-1 text-sm font-semibold !text-inherit hover:!text-white hover:bg-[#a17b1e] transition">
                        Servicios
                    </x-nav-link>

                    <x-nav-link :href="route('contacto')" :active="request()->routeIs('contacto')" class="inline-flex items-center rounded-t-xl px-5 py-1 text-sm font-semibold !text-inherit hover:!text-white hover:bg-[#a17b1e] transition">
                        Contacto
                    </x-nav-link>

                </ul>

                <!-- BOTÓN BUSCADOR -->
                <div x-data="{ openSearch: false }">

                    <button aria-label="Abrir buscador"
                        @click="openSearch = true"
                        class="rounded-xl border px-3 py-2 transition hover:bg-dark hover:text-primary hover:border-primary"
                    >
                        <i class='bx bx-search text-xl'></i>
                    </button>

                    <!-- MODAL -->
                    <div
                        x-show="openSearch"
                        x-transition
                        class="fixed inset-0 z-[99999] flex items-center justify-center bg-black/70 p-4"
                        style="display: none;"
                    >

                        <!-- Caja -->
                        <div
                            @click.away="openSearch = false"
                            class="w-full max-w-2xl rounded-2xl bg-white shadow-2xl overflow-hidden"
                        >

                            <!-- Header -->
                            <div class="flex items-center justify-between border-b px-6 py-4">
                                <h2 class="text-xl font-bold text-gray-900">
                                    ¿Cuál producto está buscando?
                                </h2>

                                <label for="buscador" class="sr-only">
                                    Buscar
                                </label>

                                <button aria-label="Buscar producto"
                                    @click="openSearch = false"
                                    class="text-gray-500 hover:text-red-600"
                                    id="buscador"
                                >
                                    <i class='bx bx-x text-3xl'></i>
                                </button>
                            </div>

                            <!-- Formulario -->
                            <form
                                x-ref="searchForm"
                                class="p-6"
                                @submit.prevent="
                                    const value = $refs.searchInput.value.trim();

                                    if(value){
                                        window.location.href = '/buscador/' + encodeURIComponent(value);
                                    }
                                "
                            >

                                <div class="relative">

                                    <input
                                        x-ref="searchInput"
                                        type="text"
                                        placeholder="Escribe el nombre del producto..."
                                        class="w-full rounded-2xl border border-gray-300 px-5 py-4 pr-14 text-lg focus:border-primary focus:ring-primary"
                                        autofocus
                                    >

                                    <button aria-label="Buscar la producto"
                                        type="submit"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-primary hover:text-dark"
                                    >
                                        <i class='bx bx-search text-2xl'></i>
                                    </button>

                                </div>

                                <p class="mt-3 text-sm text-gray-500">
                                    Se mostrarán los productos relacionadas con el nombre
                                </p>

                            </form>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </nav>
    </div>

    <!-- NAVBAR MÓVIL -->
    <div class="md:hidden fixed top-0 w-full bg-white shadow">

        <div class="flex items-center justify-between px-5 h-20">

            <!-- Logo -->
            <a href="{{ route('home') }}">
                <img
                    src="{{ asset('storage/logo/logo_distrimorgan.png') }}"
                    class="h-14"
                    alt="Distri Morgan">
            </a>

            <!-- Botón hamburguesa -->
            <button
                @click="openMenu = !openMenu"
                class="text-dark">

                <i
                    x-show="!openMenu"
                    class='bx bx-menu text-4xl'>
                </i>

                <i
                    x-show="openMenu"
                    class='bx bx-x text-4xl'>
                </i>

            </button>

        </div>

        <!-- Menú desplegable -->
        <div
            x-show="openMenu"
            x-transition
            @click.away="openMenu = false"
            class="bg-white border-t">

            <div class="flex flex-col py-3">

                <a href="{{ route('home') }}"
                   class="px-6 py-3 hover:bg-primary hover:text-white">
                    Inicio
                </a>

                <a href="#section-products"
                   class="px-6 py-3 hover:bg-primary hover:text-white">
                    Productos
                </a>

                <a href="#section-services"
                   class="px-6 py-3 hover:bg-primary hover:text-white">
                    Servicios
                </a>

                <a href="#contacto"
                   class="px-6 py-3 hover:bg-primary hover:text-white">
                    Contacto
                </a>

                <!-- Botón cotización -->
                <div class="px-6 mt-4">

                    <a href="#"
                        class="block bg-primary text-dark text-center rounded-xl py-3 font-semibold hover:bg-dark hover:text-white transition">

                        Solicitar cotización

                    </a>

                </div>

            </div>

        </div>

    </div>
</header>

<script>
function navbarHandler() {
    return {
        currentDate: '',

        init() {
            this.updateDate();
        },

        updateDate() {
            const now = new Date();
            this.currentDate = now.toLocaleDateString('es-CO', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        }
    }
}
</script>


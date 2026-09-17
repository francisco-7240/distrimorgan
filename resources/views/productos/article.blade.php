<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>{{ $noticia->titulo }}</title>
        <!-- Metadatos para Facebook y redes sociales -->
        <meta property="og:title" content="{{ $noticia->titulo }}" />
        @php
            // Quitar HTML y limpiar espacios
            $desc = trim(strip_tags($noticia->contenido));
            $desc = preg_replace('/\s+/', ' ', $desc);
        @endphp

        <meta property="og:description" content="{{ $desc !== '' ? Str::limit($desc, 150) : 'Lee la noticia completa en Aguas del Huila' }}" />
        <!-- Imagen principal (URL absoluta) -->
        <meta property="og:image" content="{{ asset('storage/'.$noticia->imagen_portada) }}" />
        <meta property="og:image:secure_url" content="{{ asset('storage/'.$noticia->imagen_portada) }}" />
        <meta property="og:image:alt" content="{{ $noticia->titulo }}" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <!-- URL absoluta del artículo -->
        <meta property="og:url" content="{{ url('/noticias/'.$noticia->slug.'/'.$noticia->id) }}" />
        <!-- Tipo de contenido -->
        <meta property="og:type" content="article" />

        <meta property="og:site_name" content="Aguas del Huila" />
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-96 overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-2xl lg:text-5xl font-bold mb-2">{{ $noticia->titulo }}</h2>
                <p class="text-lg">Inicio / Noticias /</span class="font-bold"> {{ $noticia->titulo }}</span></p>
            </div>
        </div>


        <!-- noticias -->
        <section class="px-2 lg:px-32 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-[70%_30%] gap-8">
                <div class="w-full mx-auto">
                    <img src="{{ asset('storage/'.$noticia->imagen_portada) }}" alt="{{ $noticia->titulo }}" class="w-full h-96 object-cover rounded-lg mb-6">

                    <h1 class="text-3xl font-bold text-[#0047DC] mb-4">{{ $noticia->titulo }}</h1>
                    <p class="text-gray-500 text-sm mb-8">
                        Publicado el {{ $noticia->created_at->format('d M Y') }} 
                        por <strong>{{ $noticia->autor->name ?? 'Aguas del Huila' }}</strong>
                    </p>

                    <div class="prose max-w-none text-justify text-gray-900">
                        {!! $noticia->contenido !!}
                    </div>

                    <hr class="my-10">

                </div>

                <!-- noticias relacionadas -->
                <div class="w-full mx-auto">
                    <h3 class="text-2xl font-bold text-[#0047DC] mb-4">Noticias relacionadas</h3>
                    <div class="grid grid-cols-1 gap-6">
                        @foreach($relacionadas as $relacion)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <!-- Imagen de portada -->
                                <img src="{{ asset('storage/' . $relacion->imagen_portada) }}" 
                                    alt="{{ $relacion->titulo }}" 
                                    class="w-full h-48 object-cover">

                                <!-- Contenido -->
                                <div class="p-4 text-[#0047DC] text-left">
                                    <!-- Título -->
                                    <h3 class="text-lg font-bold mb-2 hover:text-[#00C81F] transition-colors">
                                        <a href="{{ route('noticias.article', [$relacion->slug, $relacion->id]) }}">
                                            {{ Str::limit($relacion->titulo, 70) }}
                                        </a>
                                    </h3>

                                    <!-- Fecha y usuario -->
                                    <div class="text-sm text-gray-500 flex justify-between items-center">
                                        <span>{{ $relacion->created_at->format('d M Y') }}</span>
                                        <span class="font-semibold">{{ $relacion->autor->name }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        @include('partials.footer')

    </body>
</html>

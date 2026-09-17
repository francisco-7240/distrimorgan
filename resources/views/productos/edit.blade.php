<x-layouts.app :title="__('Editar Noticia')">
    <div class="w-full">
        <div class="flex w-full justify-between mb-4">
            <h1 class="text-center content-center font-black">Editar Noticia</h1>
            
            <a href="{{ route('noticias.index') }}" class="flex w-48 px-4 py-2 border-red-700 rounded-lg text-white bg-red-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left-icon lucide-square-arrow-left"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
        </div>

        <form action="{{ route('noticias.update', $noticia->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-5 bg-gray-100 rounded-lg">
            @csrf
            @method('PUT')
            
            <div class="lg:col-span-2 space-y-6">

                <!-- Título -->
                <div>
                    <label for="titulo" class="block text-sm font-semibold text-gray-700 mb-1">Título</label>
                    <input 
                        type="text" 
                        name="titulo" 
                        id="titulo"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="Escribe el título de la noticia"
                        value="{{ old('titulo', $noticia->titulo) }}"
                        required
                    >
                </div>

                <!-- Contenido -->
                <div>
                    <label for="contenido" class="block text-sm font-semibold text-gray-700 mb-1">Contenido</label>
                    <textarea 
                        name="contenido" 
                        id="contenido" 
                        rows="15"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 resize-none px-2 py-4 text-gray-900"
                        placeholder="Escribe el contenido completo de la noticia..."
                        
                    >{{ old('contenido', $noticia->contenido) }}</textarea>
                </div>

            </div>

            <div class="space-y-6">

                <!-- Imagen Portada -->
                <div>
                    <label for="imagen_portada" class="block text-sm font-semibold text-gray-700 mb-1">Imagen Portada (1200*628px)</label>
                    <div class="mt-2 border rounded-lg p-2 flex items-center justify-center bg-gray-50">
                        <img 
                            id="preview-imagen" 
                            src="{{ $noticia->imagen_portada ? asset('storage/' . $noticia->imagen_portada) : asset('storage/portada-web.jpg') }}" 
                            alt="Previsualización" 
                            class="max-h-48 object-cover rounded-lg"
                        >
                    </div>
                    <input 
                        type="file" 
                        name="imagen_portada" 
                        id="imagen_portada"
                        accept="image/*"
                        class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4 text-gray-900"
                    >
                    @error('imagen_portada')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Categoría -->
                <div>
                    <label for="categoria_id" class="block text-sm font-semibold text-gray-700 mb-1">Categoría</label>
                    <select 
                        name="categoria_id" 
                        id="categoria_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        required
                    >
                        <option value="">-- Selecciona una categoría --</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $noticia->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Botón -->
                <div class="pt-4">
                    <button 
                        type="submit"
                        class="flex text-center justify-center gap-2 w-full bg-blue-600 text-white font-semibold py-2 rounded-lg shadow hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 cursor-pointer"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-fading-arrow-up-icon lucide-circle-fading-arrow-up"><path d="M12 2a10 10 0 0 1 7.38 16.75"/><path d="m16 12-4-4-4 4"/><path d="M12 16V8"/><path d="M2.5 8.875a10 10 0 0 0-.5 3"/><path d="M2.83 16a10 10 0 0 0 2.43 3.4"/><path d="M4.636 5.235a10 10 0 0 1 .891-.857"/><path d="M8.644 21.42a10 10 0 0 0 7.631-.38"/></svg> Actualizar
                    </button>
                </div>
            </div>

        </form>
    </div>

    <!-- 🧠 Script para previsualizar la imagen -->
    <script>
        document.getElementById('imagen_portada').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview-imagen');

            if (file) {
                const reader = new FileReader();
                reader.onload = e => preview.src = e.target.result;
                reader.readAsDataURL(file);
            } else {
                preview.src = "http://localhost:8000/storage/portada-web.jpg";
            }
        });
    </script>

    <!-- 🧠 Script para editor de texto -->
    <script src="https://cdn.tiny.cloud/1/vei68lbtpicw0h1neof21mul0wjhn4c8ls4wgi2icevlq716/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    <script>
        tinymce.init({
            selector: 'textarea[name=contenido]',
            plugins: 'lists link image table code fullscreen preview media',
            toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | code fullscreen preview',
            menubar: false,
            height: 400,
            branding: false,
            content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; }',

            relative_urls: false,
            remove_script_host: false,
            document_base_url: "{{ url('/') }}/",

            // ⚙️ Configuración de subida de imágenes
            images_upload_url: "{{ route('upload.image') }}",
            automatic_uploads: true,
            file_picker_types: 'image',

            images_upload_credentials: true, // Enviar cookies CSRF

            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            },

            // ⚙️ Agrega CSRF token al request (Laravel lo necesita)
            images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
                let xhr = new XMLHttpRequest();
                xhr.open('POST', "{{ route('upload.image') }}");
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                xhr.upload.onprogress = (e) => {
                    progress(e.loaded / e.total * 100);
                };

                xhr.onload = () => {
                    if (xhr.status < 200 || xhr.status >= 300) {
                        reject('Error HTTP: ' + xhr.status);
                        return;
                    }

                    const json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location !== 'string') {
                        reject('Respuesta JSON inválida: ' + xhr.responseText);
                        return;
                    }

                    resolve(json.location);
                };

                xhr.onerror = () => {
                    reject('Error de conexión al subir la imagen.');
                };

                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            }),
        });
        </script>
</x-layouts.app>


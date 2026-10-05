<form method="POST" action="{{ route('contacto.store') }}" enctype="multipart/form-data" class="space-y-6 contactoAjaxForm">
                            @csrf
                            <input type="hidden" name="origen" value="{{ $origen ?? 'contacto' }}">

                            <div>

                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                    Nombre completo
                                </label>

                                <input
                                    type="text"
                                    name="nombre"
                                    value="{{ old('nombre') }}"
                                    required
                                    class="w-full rounded-xl border-gray-300 px-5 py-4 focus:border-primary focus:ring-primary">
                                @error('nombre')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                            </div>
                            <div>

                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                    Teléfono
                                </label>

                                <input
                                    type="number"
                                    name="telefono"
                                    value="{{ old('telefono') }}"
                                    class="w-full rounded-xl border-gray-300 px-5 py-4 focus:border-primary focus:ring-primary">
                                @error('telefono')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                            </div>


                            <div>

                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                    Correo electrónico
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    class="w-full rounded-xl border-gray-300 px-5 py-4 focus:border-primary focus:ring-primary">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                            </div>


                            <div>

                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                    Mensaje
                                </label>

                                <textarea
                                    rows="6"
                                    name="mensaje"
                                    required
                                    class="w-full rounded-2xl border-gray-300 px-5 py-4 resize-none focus:border-primary focus:ring-primary">{{ old('mensaje') }}</textarea>
                                @error('mensaje')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                            </div>
                            <div>

                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                    Adjuntar RUT
                                </label>

                                <input
                                    type="file"
                                    name="archivo"
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                    class="w-full rounded-xl border-gray-300 px-5 py-4 focus:border-primary focus:ring-primary">
                                <p class="mt-1 text-sm text-gray-500">PDF, Word o imagen. Máximo 10 MB.</p>
                                @error('archivo')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                            </div>


                            <button
                                type="submit"
                                class="bg-primary px-8 py-4 rounded-xl font-bold text-dark hover:bg-dark hover:text-white transition">

                                Enviar mensaje <i class='bx bx-send text-xl'></i> 

                            </button>

                        </form>
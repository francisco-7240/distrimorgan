<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h1 class="font-black">Mensajes de contacto</h1>
            <span class="rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-800">
                {{ $contactos->total() }} registrados
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            <form method="GET" action="{{ route('contactos.index') }}" class="flex flex-col gap-3 rounded-lg bg-white p-5 shadow-sm sm:flex-row">
                <input
                    type="search"
                    name="buscar"
                    value="{{ request('buscar') }}"
                    placeholder="Buscar por nombre..."
                    oninput="clearTimeout(this.searchTimer); this.searchTimer = setTimeout(() => this.form.submit(), 500)"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:max-w-md"
                >

                <select name="estado" onchange="this.form.submit()" class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Todos los estados</option>
                    <option value="pendiente" @selected(request('estado') === 'pendiente')>Pendientes</option>
                    <option value="respondido" @selected(request('estado') === 'respondido')>Respondidos</option>
                    <option value="archivado" @selected(request('estado') === 'archivado')>Archivados</option>
                </select>

            </form>

            @if (session('success'))
                <div class="rounded-lg bg-green-100 px-5 py-4 text-sm font-semibold text-green-800" role="status">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-100 text-xs uppercase text-gray-700">
                            <tr>
                                <th class="whitespace-nowrap px-6 py-4">Nombre</th>
                                <th class="whitespace-nowrap px-6 py-4">Correo</th>
                                <th class="whitespace-nowrap px-6 py-4">Teléfono</th>
                                <th class="px-6 py-4">Mensaje</th>
                                <th class="whitespace-nowrap px-6 py-4">Documento</th>
                                <th class="whitespace-nowrap px-6 py-4">Estado</th>
                                <th class="whitespace-nowrap px-6 py-4">Fecha</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($contactos as $contacto)
                                <tr class="hover:bg-gray-50">
                                    <td class="whitespace-nowrap px-6 py-4 font-semibold text-gray-900">{{ $contacto->nombre }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-gray-600">{{ $contacto->email }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-gray-600">{{ $contacto->telefono ?: 'No indicado' }}</td>
                                    <td class="min-w-72 px-6 py-4 text-gray-600">{{ $contacto->mensaje }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if ($contacto->archivo)
                                            <a href="{{ route('contactos.archivo', $contacto) }}" class="font-semibold text-blue-600 hover:text-blue-800">
                                                Descargar documento
                                            </a>
                                        @else
                                            <span class="text-gray-500">No adjuntó</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <form method="POST" action="{{ route('contactos.estado', $contacto) }}" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="buscar" value="{{ request('buscar') }}">
                                            <select name="estado" class="rounded-lg border-gray-300 py-1.5 text-sm focus:border-blue-500 focus:ring-blue-500">
                                                <option value="pendiente" @selected($contacto->estado === 'pendiente')>Pendiente</option>
                                                <option value="respondido" @selected($contacto->estado === 'respondido')>Respondido</option>
                                                <option value="archivado" @selected($contacto->estado === 'archivado')>Archivado</option>
                                            </select>
                                            <button type="submit" class="rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-blue-700">
                                                Guardar
                                            </button>
                                        </form>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-gray-600">{{ $contacto->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-gray-500">No hay mensajes de contacto registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $contactos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

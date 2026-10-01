<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-green-700">Administración</p>
                <h1 class="text-2xl font-black text-gray-900">Usuarios</h1>
            </div>
            <a href="{{ route('usuarios.create') }}" class="inline-flex items-center gap-2 rounded-md bg-green-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-green-800">
                <span aria-hidden="true" class="text-lg leading-none">+</span> Nuevo usuario
            </a>
        </div>
    </x-slot>

    <main class="py-8">
        <div class="mx-auto max-w-7xl space-y-5 px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div role="status" class="rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
            @endif

            <section class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
                <div class="flex flex-col gap-4 border-b border-gray-200 p-5 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h2 class="font-bold text-gray-900">Cuentas registradas</h2>
                        <p class="mt-1 text-sm text-gray-500">{{ $users->total() }} usuarios</p>
                    </div>
                    <form method="GET" action="{{ route('usuarios.index') }}" class="flex w-full gap-2 sm:max-w-md">
                        <label class="sr-only" for="buscar">Buscar usuario</label>
                        <input id="buscar" name="buscar" value="{{ $search }}" type="search" placeholder="Nombre o correo" class="min-w-0 flex-1 rounded-md border-gray-300 text-sm focus:border-green-700 focus:ring-green-700">
                        <button type="submit" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Buscar</button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                            <tr>
                                <th scope="col" class="px-5 py-3">Nombre</th>
                                <th scope="col" class="px-5 py-3">Correo electrónico</th>
                                <th scope="col" class="px-5 py-3">Fecha de registro</th>
                                <th scope="col" class="px-5 py-3 text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="whitespace-nowrap px-5 py-4 font-semibold text-gray-900">{{ $user->name }}</td>
                                    <td class="whitespace-nowrap px-5 py-4 text-gray-600">{{ $user->email }}</td>
                                    <td class="whitespace-nowrap px-5 py-4 text-gray-600">{{ $user->created_at?->format('d/m/Y') }}</td>
                                    <td class="whitespace-nowrap px-5 py-4 text-right">
                                        <a href="{{ route('usuarios.edit', $user) }}" class="font-semibold text-green-700 hover:text-green-900">Editar</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-12 text-center text-gray-500">No hay usuarios para mostrar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($users->hasPages())
                    <div class="border-t border-gray-200 px-5 py-4">{{ $users->links() }}</div>
                @endif
            </section>
        </div>
    </main>
</x-app-layout>
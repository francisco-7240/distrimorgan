<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-green-700">Administración</p>
                <h1 class="text-2xl font-black text-gray-900">Editar usuario</h1>
            </div>
            <a href="{{ route('usuarios.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">Volver al listado</a>
        </div>
    </x-slot>

    <main class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div role="status" class="mb-5 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('usuarios.update', $user) }}" class="space-y-6 rounded-lg border border-gray-200 bg-white p-6 shadow-sm sm:p-8">
                @csrf
                @method('PUT')
                <div class="border-b border-gray-200 pb-4">
                    <h2 class="font-bold text-gray-900">{{ $user->name }}</h2>
                    <p class="mt-1 text-sm text-gray-500">Actualiza los datos de la cuenta o define una contraseña nueva.</p>
                </div>

                <div>
                    <label for="name" class="mb-1 block text-sm font-semibold text-gray-700">Nombre completo</label>
                    <input id="name" name="name" value="{{ old('name', $user->name) }}" required maxlength="255" autocomplete="name" class="w-full rounded-md border-gray-300 focus:border-green-700 focus:ring-green-700">
                    @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="email" class="mb-1 block text-sm font-semibold text-gray-700">Correo electrónico</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required maxlength="255" autocomplete="email" class="w-full rounded-md border-gray-300 focus:border-green-700 focus:ring-green-700">
                    @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <fieldset class="space-y-4 rounded-md border border-gray-200 p-4">
                    <legend class="px-1 text-sm font-bold text-gray-900">Cambiar contraseña</legend>
                    <p class="text-sm text-gray-500">Déjala vacía para conservar la contraseña actual.</p>
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="password" class="mb-1 block text-sm font-semibold text-gray-700">Nueva contraseña</label>
                            <input id="password" name="password" type="password" autocomplete="new-password" class="w-full rounded-md border-gray-300 focus:border-green-700 focus:ring-green-700">
                            @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="mb-1 block text-sm font-semibold text-gray-700">Confirmar contraseña</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="w-full rounded-md border-gray-300 focus:border-green-700 focus:ring-green-700">
                        </div>
                    </div>
                </fieldset>

                <div class="flex justify-end border-t border-gray-200 pt-5">
                    <button type="submit" class="rounded-md bg-green-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-green-800">Guardar cambios</button>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>
{{--
  Botón "Agregar a cotización" para una variante producto+color.
  Uso:
    <x-agregar-cotizacion :producto-color-id="$variante->id" />
  Opcional:
    :cantidad="2"  texto="Cotizar"
--}}
@props([
    'productoColorId',
    'cantidad' => 1,
    'texto' => 'Agregar a cotización',
])

<form action="{{ route('carrito.agregar') }}" method="POST">
    @csrf
    <input type="hidden" name="producto_color_id" value="{{ $productoColorId }}">
    <input type="hidden" name="cantidad" value="{{ $cantidad }}">
    <button
        type="submit"
        {{ $attributes->merge(['class' => 'inline-flex items-center justify-center gap-2 rounded-xl bg-[#c99b3a] px-6 py-3 text-sm font-bold text-slate-950 transition hover:bg-[#b3862d]']) }}
    >
        {{ $texto }}
    </button>
</form>

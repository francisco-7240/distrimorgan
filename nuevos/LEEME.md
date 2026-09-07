# Carrito de cotización (sesión + WhatsApp)

Carrito para visitantes SIN cuenta. No maneja precios ni pagos: junta
productos+colores con cantidades y, al finalizar, arma un mensaje de WhatsApp
para pedir cotización. Todo vive en la sesión, así que NO requiere tablas nuevas.

## Cómo encaja con tus modelos

- La unidad que se agrega es un **ProductoColor** (producto + color), porque ahí
  está el `stock`. El carrito guarda `producto_color_id` + cantidad.
- Al mostrar, hidrata cada item con su Producto, Color e imagen de portada.
- Respeta el `stock` de cada ProductoColor (no deja pedir más del disponible).

## Archivos y destino

    app/Services/CarritoService.php                          -> igual ruta
    app/Http/Controllers/CarritoController.php               -> igual ruta
    config/carrito.php                                       -> igual ruta
    resources/views/carrito/index.blade.php                  -> igual ruta
    resources/views/components/carrito-icono.blade.php       -> igual ruta
    resources/views/components/agregar-cotizacion.blade.php  -> igual ruta

`routes/web.php` es de referencia: copia el bloque a tu routes/web.php.

## Pasos

1. **Copiar los archivos** a sus rutas.

2. **Añadir las rutas** del archivo de referencia a tu `routes/web.php`.

3. **Configurar el número de WhatsApp.** En tu archivo `.env`:

       CARRITO_WHATSAPP=573001234567

   Formato internacional, solo dígitos (57 = Colombia). Sin +, sin espacios.

4. **Verificar el storage link** (para las imágenes de producto):

       php artisan storage:link

5. **(Opcional) placeholder** en public/images/producto-placeholder.jpg para
   productos sin imagen.

## Cómo usarlo en las vistas

### Botón "Agregar a cotización" (en la ficha/tarjeta de producto)

Necesitas el id de la variante producto+color. Ejemplo dentro de un producto:

    @foreach($producto->productoColores as $variante)
        <div class="flex items-center gap-3">
            <span>{{ $variante->color->nombre }}</span>
            <x-agregar-cotizacion :producto-color-id="$variante->id" />
        </div>
    @endforeach

Si tu producto tiene un selector de color, pon un solo botón y cambia el
`producto_color_id` según la variante elegida (con Alpine o JS).

### Icono del carrito con contador (en el navbar)

    <x-carrito-icono />

Muestra un globo rojo con la cantidad total. Se actualiza en cada carga de
página (el carrito vive en sesión).

## Rutas generadas

| Método | URL                        | Nombre             | Acción            |
|--------|----------------------------|--------------------|-------------------|
| GET    | /carrito                   | carrito.index      | Ver cotización    |
| POST   | /carrito/agregar           | carrito.agregar    | Agregar variante  |
| PATCH  | /carrito/{id}              | carrito.actualizar | Cambiar cantidad  |
| DELETE | /carrito/{id}              | carrito.eliminar   | Quitar variante   |
| DELETE | /carrito                   | carrito.vaciar     | Vaciar todo       |

(el {id} es el producto_color_id)

## El mensaje de WhatsApp

Se arma solo, con este formato:

    Hola, quisiera cotizar los siguientes productos:

    1. Horno industrial - Color: Acero (Cantidad: 2)
    2. Licuadora - Color: Negro (Cantidad: 1)

    Quedo atento a la información. ¡Gracias!

Para cambiar el texto, edita `mensajeWhatsApp()` en CarritoService.

## Notas

- Las vistas usan `<x-app-layout>`. Si tu layout es `@extends('layouts.app')`,
  cámbialo en `carrito/index.blade.php`.
- El dorado usado es #c99b3a (el mismo de tus otras secciones).
- Como todo es por sesión, si el visitante cierra el navegador y la sesión
  expira, el carrito se pierde. Es lo esperado para cotización sin cuenta.
- Más adelante, si quieres carrito persistente o pedidos guardados en BD, se
  puede migrar la misma lógica a tablas sin rehacer las vistas.

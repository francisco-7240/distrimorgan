document.addEventListener('DOMContentLoaded', () => {

    const CART_KEY = 'distrimorgan_carrito';

    /*
    |--------------------------------------------------------------------------
    | Obtener carrito
    |--------------------------------------------------------------------------
    */

    function obtenerCarrito() {
        return JSON.parse(localStorage.getItem(CART_KEY)) || [];
    }


    /*
    |--------------------------------------------------------------------------
    | Guardar carrito
    |--------------------------------------------------------------------------
    */

    function guardarCarrito(carrito) {
        localStorage.setItem(CART_KEY, JSON.stringify(carrito));
    }


    /*
    |--------------------------------------------------------------------------
    | Actualizar contador del carrito
    |--------------------------------------------------------------------------
    */

    function actualizarContadorCarrito() {

        const carrito = obtenerCarrito();

        const cantidadTotal = carrito.reduce((total, item) => {
            return total + item.cantidad;
        }, 0);

        const contador = document.querySelector('#carritoContador');

        if (!contador) {
            return;
        }

        contador.textContent = cantidadTotal > 99
            ? '99+'
            : cantidadTotal;

        // Ocultar si el carrito está vacío
        if (cantidadTotal === 0) {
            contador.classList.add('hidden');
        } else {
            contador.classList.remove('hidden');
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Botones aumentar / disminuir
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.btn-cantidad-mas').forEach(button => {

        button.addEventListener('click', () => {

            const card = button.closest('[data-aos]');
            const cantidadElement = card.querySelector('.cantidad-producto');

            let cantidad = parseInt(cantidadElement.textContent);

            cantidad++;

            cantidadElement.textContent = cantidad;
        });

    });


    document.querySelectorAll('.btn-cantidad-menos').forEach(button => {

        button.addEventListener('click', () => {

            const card = button.closest('[data-aos]');
            const cantidadElement = card.querySelector('.cantidad-producto');

            let cantidad = parseInt(cantidadElement.textContent);

            if (cantidad > 1) {
                cantidad--;
            }

            cantidadElement.textContent = cantidad;
        });

    });


    /*
    |--------------------------------------------------------------------------
    | Seleccionar color
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.producto-color').forEach(button => {

        button.addEventListener('click', () => {

            const card = button.closest('[data-aos]');

            // Quitar selección anterior
            card.querySelectorAll('.producto-color').forEach(color => {

                color.classList.remove(
                    'ring-2',
                    'ring-primary',
                    'ring-offset-2'
                );

            });

            // Seleccionar color
            button.classList.add(
                'ring-2',
                'ring-primary',
                'ring-offset-2'
            );

            // Mostrar nombre
            const colorSeleccionado = card.querySelector(
                '.color-seleccionado'
            );

            if (colorSeleccionado) {
                colorSeleccionado.textContent =
                    button.dataset.colorName;
            }

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Agregar producto al carrito
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.btn-agregar-carrito').forEach(button => {

        button.addEventListener('click', () => {

            const card = button.closest('[data-aos]');

            const productoId = button.dataset.productoId;
            const productoNombre = button.dataset.productoNombre;

            const tieneColores = button.dataset.tieneColores === '1';

            const cantidadElement = card.querySelector(
                '.cantidad-producto'
            );

            const cantidad = parseInt(
                cantidadElement.textContent
            );


            /*
            |--------------------------------------------------------------------------
            | Obtener color seleccionado
            |--------------------------------------------------------------------------
            */

            let color = null;

            if (tieneColores) {

                const colorSeleccionado = card.querySelector(
                    '.producto-color.ring-2'
                );

                if (!colorSeleccionado) {

                    alert('Seleccione un color antes de agregar el producto al carrito.');

                    return;
                }

                color = {
                    id: colorSeleccionado.dataset.colorId,
                    producto_color_id:
                        colorSeleccionado.dataset.productoColorId,
                    nombre: colorSeleccionado.dataset.colorName,
                    hex: colorSeleccionado.dataset.colorHex
                };
            }


            /*
            |--------------------------------------------------------------------------
            | Obtener carrito
            |--------------------------------------------------------------------------
            */

            const carrito = obtenerCarrito();


            /*
            |--------------------------------------------------------------------------
            | Buscar si ya existe
            |--------------------------------------------------------------------------
            */

            const productoExistente = carrito.find(item => {

                // Producto sin color
                if (!color && !item.color) {
                    return item.producto_id == productoId;
                }

                // Producto con color
                if (color && item.color) {

                    return (
                        item.producto_id == productoId &&
                        item.color.id == color.id
                    );
                }

                return false;

            });


            /*
            |--------------------------------------------------------------------------
            | Actualizar o agregar
            |--------------------------------------------------------------------------
            */

            if (productoExistente) {

                productoExistente.cantidad += cantidad;

            } else {

                carrito.push({
                    producto_id: productoId,
                    nombre: productoNombre,
                    cantidad: cantidad,
                    color: color
                });

            }


            /*
            |--------------------------------------------------------------------------
            | Guardar
            |--------------------------------------------------------------------------
            */

            guardarCarrito(carrito);


            /*
            |--------------------------------------------------------------------------
            | Actualizar contador
            |--------------------------------------------------------------------------
            */

            actualizarContadorCarrito();


            /*
            |--------------------------------------------------------------------------
            | Reiniciar cantidad
            |--------------------------------------------------------------------------
            */

            cantidadElement.textContent = '1';


            /*
            |--------------------------------------------------------------------------
            | Mensaje
            |--------------------------------------------------------------------------
            */

            alert('Producto agregado al carrito.');

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Inicializar contador
    |--------------------------------------------------------------------------
    */

    actualizarContadorCarrito();

    async function cargarProductosCarrito() {

        const carrito = obtenerCarrito();

        const acciones = document.querySelector('#accionesCarrito');

        if (carrito.length === 0) {

            if (acciones) {
                acciones.classList.add('hidden');
            }

            mostrarCarritoVacio();
            return;
        }

        if (acciones) {
            acciones.classList.remove('hidden');
        }

        const ids = carrito.map(item => item.producto_id);

        try {

            const response = await fetch('/carrito/productos', {

                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                    'Accept': 'application/json'
                },

                body: JSON.stringify({
                    productos: ids
                })

            });

            if (!response.ok) {
                throw new Error('No fue posible obtener los productos.');
            }

            const productos = await response.json();

            mostrarProductosCarrito(carrito, productos);

        } catch (error) {

            console.error(error);

        }

    }

    /*
    |--------------------------------------------------------------------------
    | Mostrar productos del carrito
    |--------------------------------------------------------------------------
    */

    function mostrarProductosCarrito(carrito, productos) {

        const contenedor = document.querySelector('#carritoProductos');

        if (!contenedor) {
            return;
        }

        contenedor.innerHTML = '';

        carrito.forEach(item => {

            const producto = productos.find(
                producto => producto.id == item.producto_id
            );

            if (!producto) {
                return;
            }

            // Imagen de portada
            const imagenPortada = producto.imagenes
                .find(imagen => imagen.es_portada);

            const imagen = imagenPortada
                ? `/storage/productos/${imagenPortada.imagen}`
                : '/storage/productos/producto-default.png';


            // Color
            let colorHTML = '';

            if (item.color) {

                colorHTML = `
                    <div class="flex items-center gap-2 mt-2">

                        <span class="text-sm text-gray-500">
                            Color:
                        </span>

                        <span
                            class="w-5 h-5 rounded-full border"
                            style="background-color: ${item.color.hex}"
                            title="${item.color.nombre}"
                        ></span>

                        <span class="text-sm">
                            ${item.color.nombre}
                        </span>

                    </div>
                `;
            }


            // HTML del producto
            const html = `
                <div
                    class="bg-white rounded-2xl shadow-sm p-5 mb-4"
                    data-carrito-producto="${item.producto_id}"
                    data-carrito-color="${item.color ? item.color.id : ''}"
                >

                    <div class="flex flex-wrap gap-5 items-center">

                        <!-- Imagen -->
                        <div class="w-16 h-16 flex-shrink-0 border rounded-lg overflow-hidden">

                            <img
                                src="${imagen}"
                                class="w-full h-full object-contain"
                                alt="${producto.nombre}"
                            >

                        </div>


                        <!-- Información -->
                        <div class="flex-1">

                            ${
                                producto.marca
                                    ? `
                                        <span class="text-xs uppercase text-gray-500 font-semibold">
                                            ${producto.marca.nombre}
                                        </span>
                                    `
                                    : ''
                            }

                            <h3 class="font-black uppercase text-dark text-md">
                                ${producto.nombre}
                            </h3>

                            ${colorHTML}

                        </div>


                        <!-- Cantidad -->
                        <div class="flex border rounded-lg overflow-hidden">

                            <button
                                type="button"
                                class="btn-carrito-menos w-10 h-10 bg-gray-100 hover:bg-primary hover:text-white transition"
                            >
                                -
                            </button>

                            <div class="cantidad-carrito w-12 flex items-center justify-center font-bold">
                                ${item.cantidad}
                            </div>

                            <button
                                type="button"
                                class="btn-carrito-mas w-10 h-10 bg-gray-100 hover:bg-primary hover:text-white transition"
                            >
                                +
                            </button>

                        </div>


                        <!-- Eliminar -->
                        <button
                            type="button"
                            class="btn-carrito-eliminar text-red-600 hover:bg-dark hover:text-white hover:rounded-full transition p-2"
                            title="Eliminar producto"
                        >
                            <i class="bx bx-trash text-2xl"></i>
                        </button>

                    </div>

                </div>
            `;

            contenedor.insertAdjacentHTML('beforeend', html);

        });

    }

    document.addEventListener('click', (event) => {

        /*
        |--------------------------------------------------------------------------
        | Aumentar cantidad
        |--------------------------------------------------------------------------
        */

        const btnMas = event.target.closest('.btn-carrito-mas');

        if (btnMas) {

            const card = btnMas.closest('[data-carrito-producto]');

            const productoId = card.dataset.carritoProducto;
            const colorId = card.dataset.carritoColor || null;

            aumentarCantidad(productoId, colorId);

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Disminuir cantidad
        |--------------------------------------------------------------------------
        */

        const btnMenos = event.target.closest('.btn-carrito-menos');

        if (btnMenos) {

            const card = btnMenos.closest('[data-carrito-producto]');

            const productoId = card.dataset.carritoProducto;
            const colorId = card.dataset.carritoColor || null;

            disminuirCantidad(productoId, colorId);

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Eliminar
        |--------------------------------------------------------------------------
        */

        const btnEliminar = event.target.closest('.btn-carrito-eliminar');

        if (btnEliminar) {

            const card = btnEliminar.closest('[data-carrito-producto]');

            const productoId = card.dataset.carritoProducto;
            const colorId = card.dataset.carritoColor || null;

            eliminarDelCarrito(productoId, colorId);

        }

    });

    /*
    |--------------------------------------------------------------------------
    | Aumentar cantidad
    |--------------------------------------------------------------------------
    */

    function aumentarCantidad(productoId, colorId = null) {

        const carrito = obtenerCarrito();

        const item = carrito.find(item => {

            if (colorId === null || colorId === '') {

                return (
                    item.producto_id == productoId &&
                    !item.color
                );

            }

            return (
                item.producto_id == productoId &&
                item.color &&
                item.color.id == colorId
            );

        });


        if (!item) {
            return;
        }


        item.cantidad++;


        guardarCarrito(carrito);

        actualizarContadorCarrito();

        cargarProductosCarrito();

    }

    /*
    |--------------------------------------------------------------------------
    | Disminuir cantidad
    |--------------------------------------------------------------------------
    */

    function disminuirCantidad(productoId, colorId = null) {

        const carrito = obtenerCarrito();

        const itemIndex = carrito.findIndex(item => {

            if (colorId === null || colorId === '') {

                return (
                    item.producto_id == productoId &&
                    !item.color
                );

            }

            return (
                item.producto_id == productoId &&
                item.color &&
                item.color.id == colorId
            );

        });


        if (itemIndex === -1) {
            return;
        }


        const item = carrito[itemIndex];


        if (item.cantidad > 1) {

            item.cantidad--;

        } else {

            carrito.splice(itemIndex, 1);

        }


        guardarCarrito(carrito);

        actualizarContadorCarrito();

        cargarProductosCarrito();

    }

    /*
    |--------------------------------------------------------------------------
    | Eliminar producto del carrito
    |--------------------------------------------------------------------------
    */

    function eliminarDelCarrito(productoId, colorId = null) {

        let carrito = obtenerCarrito();


        carrito = carrito.filter(item => {

            if (colorId === null || colorId === '') {

                return !(
                    item.producto_id == productoId &&
                    !item.color
                );

            }

            return !(
                item.producto_id == productoId &&
                item.color &&
                item.color.id == colorId
            );

        });


        guardarCarrito(carrito);

        actualizarContadorCarrito();

        cargarProductosCarrito();

    }

    /*
    |--------------------------------------------------------------------------
    | Carrito vacio
    |--------------------------------------------------------------------------
    */

    function mostrarCarritoVacio() {

        const contenedor = document.querySelector('#carritoProductos');

        if (!contenedor) {
            return;
        }

        contenedor.innerHTML = `
            <div class="text-center py-20 col-span-2">

                <i class="bx bx-cart text-6xl text-gray-300"></i>

                <h2 class="text-2xl font-black text-dark mt-4">
                    Tu carrito está vacío
                </h2>

                <p class="text-gray-500 mt-2">
                    Agrega productos para solicitar una cotización.
                </p>

                <a
                    href="/"
                    class="inline-block mt-6 bg-primary text-white font-bold px-6 py-3 rounded-xl hover:bg-dark transition"
                >
                    Ver productos
                </a>

            </div>
        `;
    }

    if (document.querySelector('#carritoProductos')) {
        cargarProductosCarrito();
    }

    /*
    |--------------------------------------------------------------------------
    | Enviar carrito por WhatsApp
    |--------------------------------------------------------------------------
    */

    const btnEnviarWhatsApp = document.querySelector('#btnEnviarWhatsApp');

    if (btnEnviarWhatsApp) {
        btnEnviarWhatsApp.addEventListener('click', enviarCarritoWhatsApp);
    }

    function enviarCarritoWhatsApp() {

        const carrito = obtenerCarrito();

        if (carrito.length === 0) {
            alert('El carrito está vacío.');
            return;
        }

        const contenedor = document.querySelector('#carritoProductos');

        if (!contenedor) return;

        const numeroWhatsApp = contenedor.dataset.whatsapp;

        if (!numeroWhatsApp) {
            console.error('No se ha configurado el número de WhatsApp.');
            alert('No se pudo configurar el envío por WhatsApp.');
            return;
        }

        let mensaje = 'Hola, quisiera solicitar una cotización con los siguientes productos: \n';

        carrito.forEach((item, index) => {

            mensaje += `${index + 1}. ${item.nombre}\n`;
            mensaje += `   Cantidad: ${item.cantidad}\n`;

            if (item.color) {
                mensaje += `   Color: ${item.color.nombre}\n`;
            }

            mensaje += '\n';
        });

        mensaje += 'Quedo atento(a) a la cotización. Muchas gracias.';

        const url = `${numeroWhatsApp}&text=${encodeURIComponent(mensaje)}`;

        window.open(url, '_blank');
    }

});
document.addEventListener('DOMContentLoaded', () => {

    const buscador = document.querySelector('#buscadorProductos');
    const selectOrden = document.querySelector('#orden');

    const botonesCategoria = document.querySelectorAll('.btn-categoria');
    const botonesMarca = document.querySelectorAll('.btn-marca');

    const contenedorProductos = document.querySelector('#listaProductos');
    const productos = Array.from(
        document.querySelectorAll('.producto-card')
    );

    let categoriaActual = 'todos';
    let marcaActual = 'todos';
    let textoBusqueda = '';
    let ordenActual = '';

    function filtrarProductos() {

        let productosVisibles = [];

        productos.forEach(producto => {

            const categoriaId = producto.dataset.categoriaId;
            const marcaId = producto.dataset.marcaId;
            const nombre = producto.dataset.productoNombre;

            // Filtro categoría
            const coincideCategoria =
                categoriaActual === 'todos' ||
                categoriaId === categoriaActual;

            // Filtro marca
            const coincideMarca =
                marcaActual === 'todos' ||
                marcaId === marcaActual;

            // Filtro nombre
            const coincideBusqueda =
                nombre.includes(textoBusqueda);

            const coincide =
                coincideCategoria &&
                coincideMarca &&
                coincideBusqueda;

            if (coincide) {

                producto.classList.remove('hidden');

                productosVisibles.push(producto);

            } else {

                producto.classList.add('hidden');

            }

        });

        // Actualizar número de resultados
        actualizarContadorProductos(productosVisibles.length);

        ordenarProductos(productosVisibles);

        mostrarMensajeSinResultados(productosVisibles.length);

    }


    // ==============================
    // ORDENAR PRODUCTOS
    // ==============================

    function ordenarProductos(productosVisibles) {

        if (!contenedorProductos) return;

        if (ordenActual === 'recientes') {

            productosVisibles.sort((a, b) => {

                return (
                    Number(b.dataset.createdAt) -
                    Number(a.dataset.createdAt)
                );

            });

        }

        if (ordenActual === 'nombre') {

            productosVisibles.sort((a, b) => {

                const nombreA = a.dataset.productoNombre;
                const nombreB = b.dataset.productoNombre;

                return nombreA.localeCompare(
                    nombreB,
                    'es',
                    {
                        sensitivity: 'base'
                    }
                );

            });

        }

        // Volver a insertar en el orden correspondiente
        productosVisibles.forEach(producto => {
            contenedorProductos.appendChild(producto);
        });

    }


    // ==============================
    // FILTRO CATEGORÍA
    // ==============================

    botonesCategoria.forEach(boton => {

        boton.addEventListener('click', () => {

            categoriaActual =
                boton.dataset.categoriaId;

            actualizarCategoriaActiva();

            filtrarProductos();

        });

    });


    // ==============================
    // FILTRO MARCA
    // ==============================

    botonesMarca.forEach(boton => {

        boton.addEventListener('click', () => {

            marcaActual =
                boton.dataset.marcaId;

            actualizarMarcaActiva();

            filtrarProductos();

        });

    });


    // ==============================
    // BUSCADOR
    // ==============================

    if (buscador) {

        buscador.addEventListener('input', () => {

            textoBusqueda =
                buscador.value
                    .trim()
                    .toLowerCase();

            filtrarProductos();

        });

    }


    // ==============================
    // ORDEN
    // ==============================

    if (selectOrden) {

        selectOrden.addEventListener('change', () => {

            ordenActual =
                selectOrden.value;

            filtrarProductos();

        });

    }


    // ==============================
    // CATEGORÍA ACTIVA
    // ==============================

    function actualizarCategoriaActiva() {

        botonesCategoria.forEach(boton => {

            const activo =
                boton.dataset.categoriaId === categoriaActual;

            if (activo) {

                boton.classList.add(
                    'bg-primary',
                    'text-dark'
                );

                boton.classList.remove('border');

            } else {

                boton.classList.remove(
                    'bg-primary',
                    'text-dark'
                );

                boton.classList.add('border');

            }

        });

    }


    // ==============================
    // MARCA ACTIVA
    // ==============================

    function actualizarMarcaActiva() {

        botonesMarca.forEach(boton => {

            const activo =
                boton.dataset.marcaId === marcaActual;

            if (activo) {

                boton.classList.add(
                    'bg-primary',
                    'text-dark'
                );

                boton.classList.remove('border');

            } else {

                boton.classList.remove(
                    'bg-primary',
                    'text-dark'
                );

                boton.classList.add('border');

            }

        });

    }

    // ==============================
    // Contador de productos
    // ==============================

    function actualizarContadorProductos(cantidad) {
        const contador = document.querySelector('#contadorProductos');

        if (!contador) return;

        contador.textContent =
            `${cantidad} ${cantidad === 1 ? 'producto' : 'productos'} disponible${cantidad === 1 ? '' : 's'}`;
    }


    // ==============================
    // SIN RESULTADOS
    // ==============================

    function mostrarMensajeSinResultados(cantidad) {

        const sinResultados =
            document.querySelector('#sinResultados');

        const mensaje =
            document.querySelector('#mensajeSinResultados');

        if (!sinResultados || !mensaje) return;

        if (cantidad > 0) {

            sinResultados.classList.add('hidden');

            return;

        }

        sinResultados.classList.remove('hidden');

        if (
            textoBusqueda &&
            categoriaActual !== 'todos' &&
            marcaActual !== 'todos'
        ) {

            mensaje.textContent =
                'No hay productos que coincidan con la categoría, marca y nombre buscados.';

        } else if (
            textoBusqueda &&
            categoriaActual !== 'todos'
        ) {

            mensaje.textContent =
                'No hay productos que coincidan con la categoría y el nombre buscados.';

        } else if (
            textoBusqueda &&
            marcaActual !== 'todos'
        ) {

            mensaje.textContent =
                'No hay productos que coincidan con la marca y el nombre buscados.';

        } else if (
            categoriaActual !== 'todos' &&
            marcaActual !== 'todos'
        ) {

            mensaje.textContent =
                'No hay productos que coincidan con la categoría y marca seleccionadas.';

        } else if (textoBusqueda) {

            mensaje.textContent =
                `No hay productos que coincidan con "${buscador.value}".`;

        } else if (categoriaActual !== 'todos') {

            const botonCategoria =
                document.querySelector(
                    `.btn-categoria[data-categoria-id="${categoriaActual}"]`
                );

            const nombreCategoria =
                botonCategoria
                    ? botonCategoria.textContent.trim()
                    : 'esta categoría';

            mensaje.textContent =
                `No hay productos disponibles en la categoría "${nombreCategoria}".`;

        } else if (marcaActual !== 'todos') {

            const botonMarca =
                document.querySelector(
                    `.btn-marca[data-marca-id="${marcaActual}"]`
                );

            const nombreMarca =
                botonMarca
                    ? botonMarca.textContent.trim()
                    : 'esta marca';

            mensaje.textContent =
                `No hay productos disponibles de la marca "${nombreMarca}".`;

        } else {

            mensaje.textContent =
                'No hay productos disponibles.';

        }

    }

});
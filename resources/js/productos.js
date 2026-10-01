document.addEventListener('turbo:load', () => {

    const buscador = document.querySelector('#buscadorProductos');
    const selectOrden = document.querySelector('#orden');

    const botonesCategoria = document.querySelectorAll('.btn-categoria');
    const botonesSubcategorias = document.querySelectorAll('.toggle-subcategorias');
    const botonesMarca = document.querySelectorAll('.btn-marca');

    const contenedorProductos = document.querySelector('#listaProductos');
    const panelFiltros = document.querySelector('#panelFiltros');
    const fondoFiltros = document.querySelector('#fondoFiltros');
    const abrirFiltros = document.querySelector('#abrirFiltros');
    const cerrarFiltros = document.querySelector('#cerrarFiltros');
    const productos = Array.from(
        document.querySelectorAll('.producto-card')
    );

    let categoriaActual = 'todos';
    let marcaActual = 'todos';
    let textoBusqueda = '';
    let ordenActual = '';

    function cambiarEstadoFiltros(abierto) {
        if (!panelFiltros || !fondoFiltros) return;

        panelFiltros.classList.toggle('hidden', !abierto);
        panelFiltros.classList.toggle('flex', abierto);
        fondoFiltros.classList.toggle('hidden', !abierto);
        document.body.classList.toggle('overflow-hidden', abierto);
        abrirFiltros?.setAttribute('aria-expanded', abierto ? 'true' : 'false');
    }

    abrirFiltros?.addEventListener('click', () => {
        if (panelFiltros) {
            panelFiltros.scrollTop = 0;
        }
        panelFiltros?.querySelectorAll('.overflow-y-auto').forEach(lista => {
            lista.scrollTop = 0;
        });
        cambiarEstadoFiltros(true);
    });
    cerrarFiltros?.addEventListener('click', () => cambiarEstadoFiltros(false));
    fondoFiltros?.addEventListener('click', () => cambiarEstadoFiltros(false));

    botonesSubcategorias.forEach(boton => {
        boton.addEventListener('click', () => {
            const grupo = boton.closest('.categoria-grupo');
            const subcategorias = grupo?.querySelector('.categoria-subcategorias');
            const abierto = subcategorias?.classList.toggle('hidden') === false;

            boton.setAttribute('aria-expanded', abierto ? 'true' : 'false');
            boton.querySelector('svg')?.classList.toggle('rotate-180', abierto);
        });
    });

    function filtrarProductos() {

        let productosVisibles = [];

        productos.forEach(producto => {

            const categoriaId = producto.dataset.categoriaId;
            const marcaId = producto.dataset.marcaId;
            const nombre = producto.dataset.productoNombre;
            const slug = producto.dataset.productoSlug;

            // Filtro categoría
            const categoriasSeleccionadas = categoriaActual.split(',');
            const coincideCategoria =
                categoriaActual === 'todos' ||
                categoriasSeleccionadas.includes(categoriaId);

            // Filtro marca
            const coincideMarca =
                marcaActual === 'todos' ||
                marcaId === marcaActual;

            // Filtro nombre
            const coincideBusqueda =
                nombre.includes(textoBusqueda) ||
                slug.includes(textoBusqueda);

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

        const limiteProductos = Number(contenedorProductos?.dataset.maxProductos) || Infinity;
        const productosMostrados = productosVisibles.slice(0, limiteProductos);

        productosVisibles.slice(limiteProductos).forEach(producto => {
            producto.classList.add('hidden');
        });

        // Actualizar número de resultados
        actualizarContadorProductos(productosMostrados.length);

        ordenarProductos(productosMostrados);

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
                boton.dataset.categoriaIds || boton.dataset.categoriaId;

            actualizarCategoriaActiva();

            filtrarProductos();
            cambiarEstadoFiltros(false);

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
            cambiarEstadoFiltros(false);

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

        const buscarInicial =
            new URLSearchParams(window.location.search).get('buscar');

        if (buscarInicial) {
            buscador.value = buscarInicial;
            textoBusqueda = buscarInicial.trim().toLowerCase();
            filtrarProductos();
        }

    }

    const categoriaInicial =
        new URLSearchParams(window.location.search).get('categoria_id');

    if (categoriaInicial) {
        categoriaActual = categoriaInicial;
        actualizarCategoriaActiva();
    }

    const marcaInicial =
        new URLSearchParams(window.location.search).get('marca_id');

    if (marcaInicial) {
        marcaActual = marcaInicial;
        actualizarMarcaActiva();
    }

    filtrarProductos();


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

            const categoriaBoton =
                boton.dataset.categoriaIds || boton.dataset.categoriaId;

            const activo =
                categoriaBoton === categoriaActual;

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
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        @include('partials.header')

        <title>{{ config('app.name') }} - Política de privacidad</title>
        <meta name="description" content="Distribuidora Morgan - Política de privacidad y tratamiento de datos personales conforme a la Ley 1581 de 2012.">

    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- Banner -->
        <section class="relative w-full h-64 sm:h-80 md:h-96 bg-cover bg-center overflow-hidden" style="background-image: url('{{ asset('storage/img/banner_mis_productos.jpeg') }}')">
            <!-- Capa oscura -->
            <div class="absolute inset-0 bg-black/70"></div>

            <!-- Contenido -->
            <div class="relative flex min-h-screen items-start pt-28 pb-28 md:pt-44 lg:pt-48">
                <div class="container px-6 lg:px-10 w-full">
                    <h1 class="font-black uppercase leading-none text-white text-4xl md:text-7xl">Política de <span class="text-primary">privacidad</span></h1>
                </div>
            </div>
        </section>

        <!-- Contenido -->
        <section class="py-16">
            <div class="mx-auto max-w-4xl px-6 lg:px-10 space-y-8 text-gray-700 leading-relaxed text-justify">

                <p>
                    En <strong>DISTRI MORGAN</strong> respetamos la privacidad de nuestros clientes, proveedores y visitantes.
                    Esta política explica cómo recolectamos, usamos y protegemos sus datos personales, en cumplimiento de la
                    Ley 1581 de 2012, el Decreto 1377 de 2013 (compilado en el Decreto 1074 de 2015) y demás normas de protección
                    de datos personales en Colombia.
                </p>

                <div>
                    <h2 class="text-2xl font-black uppercase text-dark mb-3">1. Responsable del tratamiento</h2>
                    <ul class="list-disc pl-6 space-y-1">
                        <li><strong>Razón social:</strong> DISTRI MORGAN</li>
                        <li><strong>Domicilio:</strong> Neiva, Huila - Colombia</li>
                        <li><strong>Correo electrónico:</strong> <a href="mailto:ventas@distrimorgan.com" class="text-primary underline">ventas@distrimorgan.com</a></li>
                        <li><strong>Teléfono:</strong> +57 302 6400248</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-black uppercase text-dark mb-3">2. Datos que recolectamos</h2>
                    <p>
                        A través del formulario de contacto, el carrito de cotización y nuestros canales de atención podemos recolectar:
                        nombre completo, número de teléfono, correo electrónico, el contenido de su mensaje y los documentos que usted
                        adjunte voluntariamente (por ejemplo, el RUT). No solicitamos datos sensibles.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-black uppercase text-dark mb-3">3. Finalidades del tratamiento</h2>
                    <ul class="list-disc pl-6 space-y-1">
                        <li>Responder sus solicitudes, preguntas y requerimientos.</li>
                        <li>Elaborar y enviar cotizaciones de productos y servicios.</li>
                        <li>Gestionar la relación comercial: facturación, despachos, garantías y servicio técnico.</li>
                        <li>Enviar información comercial, promociones y novedades, cuando usted lo haya autorizado.</li>
                        <li>Cumplir obligaciones legales, contables y tributarias.</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-black uppercase text-dark mb-3">4. Derechos del titular</h2>
                    <p class="mb-2">Como titular de los datos, usted tiene derecho a:</p>
                    <ul class="list-disc pl-6 space-y-1">
                        <li>Conocer, actualizar y rectificar sus datos personales.</li>
                        <li>Solicitar prueba de la autorización otorgada para el tratamiento.</li>
                        <li>Ser informado sobre el uso que se ha dado a sus datos.</li>
                        <li>Revocar la autorización y/o solicitar la supresión de sus datos, cuando no exista un deber legal o contractual de conservarlos.</li>
                        <li>Presentar quejas ante la Superintendencia de Industria y Comercio por infracciones a la ley.</li>
                        <li>Acceder de forma gratuita a sus datos personales.</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-black uppercase text-dark mb-3">5. Consultas y reclamos</h2>
                    <p>
                        Para ejercer sus derechos puede escribirnos a
                        <a href="mailto:ventas@distrimorgan.com" class="text-primary underline">ventas@distrimorgan.com</a>
                        indicando su nombre, número de identificación, la descripción de su solicitud y un medio de respuesta.
                    </p>
                    <ul class="list-disc pl-6 mt-2 space-y-1">
                        <li><strong>Consultas:</strong> se responden en un máximo de diez (10) días hábiles, prorrogables por cinco (5) días hábiles más.</li>
                        <li><strong>Reclamos:</strong> se responden en un máximo de quince (15) días hábiles, prorrogables por ocho (8) días hábiles más.</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-black uppercase text-dark mb-3">6. Seguridad de la información</h2>
                    <p>
                        Adoptamos medidas técnicas, humanas y administrativas razonables para proteger sus datos contra pérdida,
                        consulta, uso o acceso no autorizado. Los documentos adjuntos se almacenan en un espacio privado al que solo
                        accede personal autorizado de DISTRI MORGAN. No vendemos ni compartimos sus datos con terceros, salvo cuando
                        sea necesario para prestar el servicio solicitado o lo exija la ley.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-black uppercase text-dark mb-3">7. Autorización</h2>
                    <p>
                        Al marcar la casilla de aceptación en nuestros formularios, usted autoriza de manera previa, expresa e informada
                        a DISTRI MORGAN para tratar sus datos personales de acuerdo con esta política.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-black uppercase text-dark mb-3">8. Vigencia</h2>
                    <p>
                        Esta política rige desde su publicación. Los datos se conservarán mientras sean necesarios para las finalidades
                        descritas o mientras exista una obligación legal de conservarlos. Cualquier cambio será publicado en esta página.
                    </p>
                </div>

                <p class="text-sm text-gray-500">Última actualización: 26 de octubre de 2026</p>

            </div>
        </section>

        @include('partials.footer')

    </body>
</html>

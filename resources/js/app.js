

import Alpine from 'alpinejs';
import { cache as turboCache, start as startTurbo } from '@hotwired/turbo';
import './carrito';
import './productos';

window.Alpine = Alpine;

Alpine.start();
startTurbo();

document.addEventListener('turbo:load', () => {
	turboCache.exemptPageFromCache();

	document.querySelectorAll('.contactoAjaxForm').forEach((formularioContacto) => {
		formularioContacto.addEventListener('submit', async (event) => {
			event.preventDefault();

			const boton = formularioContacto.querySelector('button[type="submit"]');
			const datos = new FormData(formularioContacto);

			if (boton) boton.disabled = true;

			try {
				const response = await fetch(formularioContacto.action, {
					method: 'POST',
					body: datos,
					headers: {
						Accept: 'application/json',
						'X-Requested-With': 'XMLHttpRequest',
					},
				});

				const resultado = await response.json();

				if (!response.ok) {
					const errores = Object.values(resultado.errors ?? {}).flat();
					throw new Error(errores.join(' ') || 'No fue posible enviar el mensaje. Revisa los datos ingresados.');
				}

				formularioContacto.reset();
				window.Swal.fire({
					icon: 'success',
					title: '¡Mensaje enviado!',
					text: resultado.message,
					confirmButtonText: 'Aceptar',
					confirmButtonColor: '#a17b1e',
				});
			} catch (error) {
				window.Swal.fire({
					icon: 'error',
					title: 'No se pudo enviar',
					text: error.message,
					confirmButtonText: 'Aceptar',
				});
			} finally {
				if (boton) boton.disabled = false;
			}
	});
	});
});

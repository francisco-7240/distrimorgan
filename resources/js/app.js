

import Alpine from 'alpinejs';
import { cache as turboCache, start as startTurbo } from '@hotwired/turbo';
import './carrito';
import './productos';
import './proteccion';
import './logos';

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
			const archivo = formularioContacto.querySelector('input[name="archivo"]')?.files[0];

			if (archivo && archivo.size > 10 * 1024 * 1024) {
				window.Swal.fire({
					icon: 'error',
					title: 'Archivo muy grande',
					text: 'El archivo no puede superar los 10 MB.',
					confirmButtonText: 'Aceptar',
				});
				return;
			}

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

				const contentType = response.headers.get('content-type') ?? '';
				const resultado = contentType.includes('application/json')
					? await response.json()
					: null;

				if (!response.ok) {
					const errores = Object.values(resultado?.errors ?? {}).flat();
					const rutaRespuesta = new URL(response.url).pathname;
					const mensaje = errores.join(' ')
						|| resultado?.message
						|| (response.status === 419
							? 'La sesión expiró. Actualiza la página e inténtalo nuevamente.'
							: `El servidor respondió con el error ${response.status} en ${rutaRespuesta}. Revisa los registros del servidor.`);

					throw new Error(mensaje);
				}

				if (!resultado) {
					const rutaRespuesta = new URL(response.url).pathname;
					throw new Error(`El servidor respondió con una página en vez de JSON (HTTP ${response.status}, ${rutaRespuesta}). Revisa la configuración del servidor.`);
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

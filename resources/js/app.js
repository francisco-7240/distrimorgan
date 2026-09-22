

import Alpine from 'alpinejs';
import './carrito';
import './productos';

window.Alpine = Alpine;

Alpine.start();

const formularioContactoHome = document.querySelector('#contactoHomeForm');
const estadoContactoHome = document.querySelector('#contactoHomeEstado');

formularioContactoHome?.addEventListener('submit', async (event) => {
	event.preventDefault();

	const boton = formularioContactoHome.querySelector('button[type="submit"]');
	const datos = new FormData(formularioContactoHome);

	boton && (boton.disabled = true);
	estadoContactoHome.className = 'hidden mb-6 rounded-xl px-5 py-4 text-sm font-semibold';

	try {
		const response = await fetch(formularioContactoHome.action, {
			method: 'POST',
			body: datos,
			headers: {
				Accept: 'application/json',
				'X-Requested-With': 'XMLHttpRequest',
			},
		});

		const resultado = await response.json();

		if (!response.ok) {
			throw new Error('No fue posible enviar el mensaje. Revisa los datos ingresados.');
		}

		formularioContactoHome.reset();
		estadoContactoHome.textContent = resultado.message;
		estadoContactoHome.classList.add('bg-green-100', 'text-green-800');
	} catch (error) {
		estadoContactoHome.textContent = error.message;
		estadoContactoHome.classList.add('bg-red-100', 'text-red-800');
	} finally {
		estadoContactoHome.classList.remove('hidden');
		boton && (boton.disabled = false);
	}
});

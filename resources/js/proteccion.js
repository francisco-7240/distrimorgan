// Bloquea el clic derecho y los atajos de las herramientas de desarrollador.
// Se registra una sola vez a nivel de documento, por lo que sigue activo
// en las navegaciones de Turbo sin duplicar listeners.

document.addEventListener('contextmenu', (event) => {
	event.preventDefault();
});

document.addEventListener('keydown', (event) => {
	const tecla = event.key?.toUpperCase();
	const ctrlOCmd = event.ctrlKey || event.metaKey;

	const bloquear =
		// F12
		event.key === 'F12' ||
		// Ctrl+Shift+I / J / C (Windows/Linux) y Cmd+Option+I / J / C (Mac)
		(ctrlOCmd && (event.shiftKey || event.altKey) && ['I', 'J', 'C'].includes(tecla)) ||
		// Ctrl+U / Cmd+U (ver código fuente)
		(ctrlOCmd && tecla === 'U');

	if (bloquear) {
		event.preventDefault();
		event.stopPropagation();
	}
}, true);

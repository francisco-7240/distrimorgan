// Recorta el espacio en blanco o transparente alrededor de los logos marcados
// con data-recortar-logo, para que todos ocupen el mismo recuadro aunque la
// imagen original traiga márgenes de distinto tamaño.

const UMBRAL_BLANCO = 235;
const UMBRAL_ALFA = 20;
const MARGEN = 0.04;
const recortados = new Map();

function esFondo(datos, i) {
	return datos[i + 3] < UMBRAL_ALFA
		|| (datos[i] > UMBRAL_BLANCO && datos[i + 1] > UMBRAL_BLANCO && datos[i + 2] > UMBRAL_BLANCO);
}

function recortar(img) {
	const ancho = img.naturalWidth;
	const alto = img.naturalHeight;
	if (!ancho || !alto) return null;

	const canvas = document.createElement('canvas');
	canvas.width = ancho;
	canvas.height = alto;
	const ctx = canvas.getContext('2d', { willReadFrequently: true });
	ctx.drawImage(img, 0, 0);

	let datos;
	try {
		datos = ctx.getImageData(0, 0, ancho, alto).data;
	} catch {
		return null; // Imagen de otro dominio: se deja como está.
	}

	let minX = ancho, minY = alto, maxX = -1, maxY = -1;
	for (let y = 0; y < alto; y++) {
		for (let x = 0; x < ancho; x++) {
			if (!esFondo(datos, (y * ancho + x) * 4)) {
				if (x < minX) minX = x;
				if (x > maxX) maxX = x;
				if (y < minY) minY = y;
				if (y > maxY) maxY = y;
			}
		}
	}

	if (maxX < 0) return null;

	const margen = Math.round(Math.max(maxX - minX, maxY - minY) * MARGEN);
	minX = Math.max(0, minX - margen);
	minY = Math.max(0, minY - margen);
	maxX = Math.min(ancho - 1, maxX + margen);
	maxY = Math.min(alto - 1, maxY + margen);

	const anchoFinal = maxX - minX + 1;
	const altoFinal = maxY - minY + 1;
	if (anchoFinal === ancho && altoFinal === alto) return null;

	const salida = document.createElement('canvas');
	salida.width = anchoFinal;
	salida.height = altoFinal;
	salida.getContext('2d').drawImage(canvas, minX, minY, anchoFinal, altoFinal, 0, 0, anchoFinal, altoFinal);

	return salida.toDataURL('image/png');
}

function procesar(img) {
	if (img.dataset.logoRecortado) return;
	img.dataset.logoRecortado = '1';

	const original = img.currentSrc || img.src;
	if (!recortados.has(original)) {
		recortados.set(original, recortar(img));
	}

	const resultado = recortados.get(original);
	if (resultado) img.src = resultado;
}

document.addEventListener('turbo:load', () => {
	document.querySelectorAll('img[data-recortar-logo]').forEach((img) => {
		if (img.complete && img.naturalWidth) {
			procesar(img);
		} else {
			img.addEventListener('load', () => procesar(img), { once: true });
		}
	});
});

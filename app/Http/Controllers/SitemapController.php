<?php

namespace App\Http\Controllers;

use App\Models\Producto;

/**
 * Sitemap XML del sitio público: páginas fijas y la ficha de cada producto activo
 * (con su imagen de portada, para que Google también indexe las fotos).
 * Se arma en cada petición, así que los productos nuevos aparecen solos.
 */
class SitemapController extends Controller
{
    public function __invoke()
    {
        $paginas = [
            ['loc' => route('home'), 'changefreq' => 'weekly', 'priority' => '1.0'],
            ['loc' => route('productos.catalogo'), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => route('servicios'), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('nosotros'), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => route('contacto'), 'changefreq' => 'monthly', 'priority' => '0.6'],
        ];

        $productos = Producto::where('estado', 1)
            ->with(['imagenes' => fn ($query) => $query->where('es_portada', true)])
            ->orderBy('id')
            ->get(['id', 'nombre', 'slug', 'updated_at']);

        foreach ($productos as $producto) {
            $portada = $producto->imagenes->first();

            $paginas[] = [
                'loc' => route('producto.detalle', ['producto' => $producto, 'slug' => $producto->slug]),
                'lastmod' => $producto->updated_at?->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
                'imagen' => $portada ? asset('storage/' . $portada->imagen) : null,
                'titulo' => $producto->nombre,
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
            . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

        foreach ($paginas as $pagina) {
            $xml .= "  <url>\n    <loc>" . $this->escapar($pagina['loc']) . "</loc>\n";

            if (!empty($pagina['lastmod'])) {
                $xml .= "    <lastmod>{$pagina['lastmod']}</lastmod>\n";
            }

            $xml .= "    <changefreq>{$pagina['changefreq']}</changefreq>\n"
                . "    <priority>{$pagina['priority']}</priority>\n";

            if (!empty($pagina['imagen'])) {
                $xml .= "    <image:image>\n"
                    . '      <image:loc>' . $this->escapar($this->codificarUrl($pagina['imagen'])) . "</image:loc>\n"
                    . '      <image:title>' . $this->escapar($pagina['titulo']) . "</image:title>\n"
                    . "    </image:image>\n";
            }

            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    private function escapar(string $texto): string
    {
        return htmlspecialchars($texto, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }

    /**
     * Codifica espacios, tildes y ñ del nombre del archivo, que no son válidos en una URL de sitemap.
     */
    private function codificarUrl(string $url): string
    {
        $partes = parse_url($url);
        $ruta = implode('/', array_map('rawurlencode', array_map('rawurldecode', explode('/', $partes['path'] ?? ''))));

        return ($partes['scheme'] ?? 'https') . '://' . ($partes['host'] ?? '')
            . (isset($partes['port']) ? ':' . $partes['port'] : '') . $ruta;
    }
}

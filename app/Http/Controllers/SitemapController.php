<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    /**
     * Generate dynamic XML sitemap.
     */
    public function index(): Response
    {
        $now = now()->toAtomString();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Homepage (Very high priority for National SEO)
        $xml .= '<url>';
        $xml .= '<loc>' . route('home') . '</loc>';
        $xml .= '<lastmod>' . $now . '</lastmod>';
        $xml .= '<changefreq>daily</changefreq>';
        $xml .= '<priority>1.0</priority>';
        $xml .= '</url>';

        // Gallery
        $xml .= '<url>';
        $xml .= '<loc>' . route('gallery.index') . '</loc>';
        $xml .= '<lastmod>' . $now . '</lastmod>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>0.8</priority>';
        $xml .= '</url>';

        // Tracker
        $xml .= '<url>';
        $xml .= '<loc>' . route('tracker.index') . '</loc>';
        $xml .= '<lastmod>' . $now . '</lastmod>';
        $xml .= '<changefreq>monthly</changefreq>';
        $xml .= '<priority>0.5</priority>';
        $xml .= '</url>';

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'text/xml'
        ]);
    }
}

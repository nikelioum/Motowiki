<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\MotoCategory;
use App\Models\MotoBrand;
use App\Models\Bike;


class SitemapController extends Controller
{
    //Generate sitemap.xml
    public function index()
    {
        $urls = [];

        // Static pages
        $urls[] = url('/');
        $urls[] = url('/categories');
        $urls[] = url('/brands');
        $urls[] = url('/vendors');
        $urls[] = url('/contact');

        // Dynamic category pages
        $categories = MotoCategory::all();
        foreach ($categories as $category) {
            $urls[] = url("/category/{$category->slug}");
        }

        // Dynamic brand pages
        $brands = MotoBrand::all();
        foreach ($brands as $brand) {
            $urls[] = url("/brand/{$brand->slug}");
        }

        // Dynamic bike pages
        $bikes = Bike::all();
        foreach ($bikes as $bike) {
            $urls[] = url("/bike/{$bike->slug}");
        }

        // Build XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as $url) {
            $xml .= '
                <url>
                    <loc>' . htmlspecialchars($url) . '</loc>
                    <changefreq>weekly</changefreq>
                    <priority>0.8</priority>
                </url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }
}

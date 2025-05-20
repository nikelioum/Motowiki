<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\MotoBrand as Brand;
use App\Models\Bike;

class MotoBrandController extends Controller
{
    // Fetch categories
    public function index()
    {
        $brands = Brand::orderBy('sort_order', 'desc')->where('status', true)->get();

        return Inertia::render('Brands', [
            'brands' => $brands,
            'breadcrumb' => [
                ['label' => 'Αρχική', 'url' => '/'],
                ['label' => 'Εταιρείες', 'url' => '/brands'],
            ],
        ]);
    }


    // Single Brand page
    public function singleBrand($slug)
    {
        $brand = Brand::where('slug', $slug)->first();

        if (!$brand) {
            // Show your Inertia 404 component
            return Inertia::render('Notfound')->toResponse(request())->setStatusCode(404);
        }

        $brandId = $brand->id;

        $bikes = Bike::where('brand_id', $brandId)->with('category', 'brand', 'specValues.spec.specCategory')->get();

        return Inertia::render('BrandBikes', [
            'bikes' => $bikes,
            'brand' => $brand,
            'breadcrumb' => [
                ['label' => 'Αρχική', 'url' => '/'],
                ['label' => 'Εταιρείες', 'url' => '/brands'],
                ['label' => $brand->name, 'url' => $brand->slug],
            ],
        ]);
    }


}

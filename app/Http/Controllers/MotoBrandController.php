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
        $brands = Brand::all();

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
        $brandId = Brand::where('slug', $slug)->get('id')->first()->id;
        $brand = Brand::where('slug', $slug)->first();
        $bikes = Bike::where('brand_id', $brandId)->with('category', 'brand')->get();



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

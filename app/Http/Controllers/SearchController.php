<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MotoCategory as Category;
use App\Models\MotoBrand as Brand;
use App\Models\Bike;

class SearchController extends Controller
{
    //Recomendations results
    public function recommendations(){
        $popularCategories = Category::where('status', true)->where('is_popular', true)->orderBy('sort_order', 'desc')->take(4)->get();
        $popularBrands = Brand::where('status', true)->where('is_popular', true)->orderBy('sort_order', 'desc')->take(4)->get();
        $popularBikes = Bike::with('category', 'brand')->where('status', true)->orderBy('id', 'desc')->take(4)->get();

        return response()->json([
            'popularCategories' => $popularCategories,
            'popularBrands' => $popularBrands,
            'popularBikes' => $popularBikes,
        ]);
    }
}

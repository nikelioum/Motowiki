<?php

namespace App\Http\Controllers;

use App\Models\MotoCategory as Category;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bike;
use App\Models\MotoBrand as Brand;

class MotoCategoryController extends Controller
{
    // Fetch categories
    public function index()
    {
        $categories = Category::orderBy('sort_order', 'desc')->where('is_show', true)->get();

        return Inertia::render('Categories', [
            'categories' => $categories,
            'breadcrumb' => [
                ['label' => 'Αρχική', 'url' => '/'],
                ['label' => 'Κατηγορίες', 'url' => '/categories'],
            ],
        ]);
    }

    public function singleCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return Inertia::render('Notfound')->toResponse(request())->setStatusCode(404);
        }

        $categoryId = $category->id;

        $bikes = Bike::with('brand', 'category')
            ->where('category_id', $categoryId)
            ->get();

        $brands = Brand::whereIn('id', $bikes->pluck('brand_id')->filter())->get();

        return Inertia::render('CategoryBikes', [
            'category' => $category,
            'bikes' => $bikes,
            'brands' => $brands,
            'breadcrumb' => [
                ['label' => 'Αρχική', 'url' => '/'],
                ['label' => 'Κατηγορίες', 'url' => '/categories'],
                ['label' => $category->title, 'url' => $category->slug],
            ],
        ]);
    }




}

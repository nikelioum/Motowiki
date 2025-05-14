<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\MotoBrand;
use App\Models\Bike;
use App\Models\MotoCategory;
use App\Http\Controllers\MotoCategoryController;
use App\Http\Controllers\MotoBrandController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\NewsletterController;


//Homepage
Route::get('/', [PagesController::class, 'homepage'])->name('homepage');

//Categories page
Route::get('/categories', [MotoCategoryController::class, 'index'])->name('categories');

//Single Category page
Route::get('/category/{slug}', [MotoCategoryController::class, 'singleCategory'])->name('single_category');

//Brands page
Route::get('/brands', [MotoBrandController::class, 'index'])->name('brands');

//Single Brand page
Route::get('/brand/{slug}', [MotoBrandController::class, 'singleBrand'])->name('single_brand');

//Single Brand page
Route::get('/bike/{slug}', [PagesController::class, 'singleBike'])->name('single_bike');

//Vendors page
Route::get('/vendors', [PagesController::class, 'vendors'])->name('vendors');

//Contact page
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');

//Submit contact form
Route::post('/contact', [PagesController::class, 'submit_contact']);

//Newsletter submit
Route::post('/newsletter', [NewsletterController::class, 'store']);

//Unsubscribe to Newsletter
Route::get('/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');


//Route::get('/category/{slug}', function ($slug) {
//    $brand = MotoCategory::where('slug', $slug)->get('id')->first()->id;
//    $bikes = Bike::with('brand', 'category')->where('category_id', $brand)->get();
//
//    return Inertia::render('Bikes', [
//        'brand' => $brand,
//        'bikes' => $bikes,
//    ]);
//})->name('brands.bikes');


Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

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
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReviewController;


//homepage
Route::get('/', [PagesController::class, 'homepage'])->name('home');

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

//About page
Route::get('/about', [PagesController::class, 'about'])->name('about');

//Moto Quiz page
Route::get('/moto-quiz', [PagesController::class, 'motoQUiz'])->name('moto_quiz');

//Moto Quiz results
Route::get('/moto-quiz-results', [PagesController::class, 'motoQUizResults'])->name('moto_quiz_results');

//Contact page
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');

//Submit contact form
Route::post('/contact', [PagesController::class, 'submit_contact']);

//Newsletter submit
Route::post('/newsletter', [NewsletterController::class, 'store']);

//Unsubscribe to Newsletter
Route::get('/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

//Define 404 for not existing routes
Route::fallback(function () {
    return Inertia::render('Notfound');
});

//Sitemap generate
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

//Feedback submit
Route::post('/feedback', [FeedbackController::class, 'store']);

//Terms page
Route::get('/terms', [PagesController::class, 'terms'])->name('terms');

//Privacy page
Route::get('/privacy', [PagesController::class, 'privacy'])->name('privacy');

//Search
Route::get('/search/recommendations', [SearchController::class, 'recommendations']);

//Search bikes
Route::get('/bikes/search', [SearchController::class, 'searchBikes']);

//Disable Login and Register
Route::match(['get', 'post'], '/login', function () {
    return Inertia::render('Notfound')->toResponse(request())->setStatusCode(404);
});

Route::match(['get', 'post'], '/register', function () {
    return Inertia::render('Notfound')->toResponse(request())->setStatusCode(404);
});

Route::match(['get', 'post'], '/dashboard', function () {
    return Inertia::render('Notfound')->toResponse(request())->setStatusCode(404);
});

//Review show
Route::get('/bikes/{id}/reviews', [ReviewController::class, 'index'])->name('bikes.reviews.index');

//Review post
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');


//Test api
use Illuminate\Support\Facades\Http;
Route::get('/test-motorcycles', function () {
    $response = Http::withHeaders([
        'X-Api-Key' => 'bTHW9N/jfAX3/rKEo8LX1A==0JtkhctSSPu6zhnE',
    ])->get('https://api.api-ninjas.com/v1/motorcycles', [
        'make' => 'honda',
        'year' => '2025'
    ]);

    return response()->json($response->json());
});


//Admin dashboard for user
//Route::get('dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

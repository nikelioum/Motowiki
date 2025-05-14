<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Vendor;
use App\Models\MotoBrand as Brand;

class PagesController extends Controller
{

    //homepage
    public function homepage()
    {

        $popularBrands = Brand::orderBy('sort_order', 'desc')->where('status', true)->where('is_popular', true)->take(4)->get();
        $newBikes = Bike::orderBy('created_at', 'desc')->where('status', true)->take(8)->get();
        return Inertia::render('Homepage', [
            'brands' => $popularBrands,
            'newBikes' => $newBikes,
        ]);
    }


    // Categories page
    public function contact()
    {

        return Inertia::render('Contact', [
            'breadcrumb' => [
                ['label' => 'Αρχική', 'url' => '/'],
                ['label' => 'Επικοινωνία', 'url' => '/contact'],
            ],
        ]);
    }


    // Single Bike page
    public function singleBike($slug)
    {

        $bike = Bike::where('slug', $slug)->with('category', 'brand', 'specValues.spec.specCategory')->first();

        return Inertia::render('Bike', [
            'bike' => $bike,
            'breadcrumb' => [
                ['label' => 'Αρχική', 'url' => '/'],
                ['label' => $bike->name, 'url' => '#'],
            ],
        ]);
    }

    //Submit contact form
    public function submit_contact(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'message' => 'nullable|string',
            'terms' => 'accepted',
        ]);

        // Handle the contact submission: save to DB, send email, etc.

        return redirect()->back()->with('success', 'Το μήνυμά σας εστάλη με επιτυχία!');
    }


    // Vendors page
    public function vendors()
    {

        $vendors = Vendor::with('brand')->get();
        return Inertia::render('Vendors', [
            'breadcrumb' => [
                ['label' => 'Αρχική', 'url' => '/'],
                ['label' => 'Αντιπροσωπίες', 'url' => '/vendors'],
            ],
            'vendors' => $vendors
        ]);
    }
}

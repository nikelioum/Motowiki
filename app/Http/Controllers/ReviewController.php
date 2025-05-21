<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;
use App\Models\Bike;

class ReviewController extends Controller
{

    public function index($bikeId)
    {
        // Load reviews with status = approved (assuming status = true means approved)
        $bike = Bike::with(['reviews' => function($query) {
            $query->where('status', 'approved')->orderBy('created_at', 'desc');
        }])->findOrFail($bikeId);

        // Return reviews as JSON (for API) or as Inertia props if you want to render in Blade/Inertia
        return response()->json($bike->reviews);

        // OR if you want to return Inertia page with reviews:
        // return Inertia::render('Bike/Show', [
        //     'bike' => $bike,
        //     'reviews' => $reviews,
        // ]);
    }

    
    //Post Review
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bike_id' => 'required|exists:bikes,id',
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'stars'   => 'required|integer|min:1|max:5',
            'text'    => 'nullable|string|max:1000',
        ]);

        Review::create([
            'bike_id' => $validated['bike_id'],
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'stars'   => $validated['stars'],
            'text'    => $validated['text'] ?? null,
            'status'  => 'pending', // default status
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }

}

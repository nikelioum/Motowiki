<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Inertia\Inertia;

class FeedbackController extends Controller
{

    //Store Feeback Controller
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mood'    => 'required|string|max:10',
            'feedback' => 'nullable|string|max:1000',
        ]);

        Feedback::create([
            'mood'       => $validated['mood'],
            'message'    => $validated['feedback'] ?? null,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'Ευχαριστούμε για το feedback.');
    }
    


   

}

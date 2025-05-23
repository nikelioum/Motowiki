<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Inertia\Inertia;

class FeedbackController extends Controller
{

    /**
     * Handles the submission and storage of user feedback.
     *
     * Validates the incoming request for a required mood and optional feedback message, then creates a new feedback record with the user's IP address. Redirects back with a success message upon completion.
     *
     * @param Request $request The HTTP request containing feedback data.
     * @return \Illuminate\Http\RedirectResponse
     */
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

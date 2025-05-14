<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Mail\NewsletterWelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Inertia\Inertia;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:newsletters,email',
            'accepted_terms' => 'accepted',
        ]);

        // Add a unique token
        $validated['unsubscribe_token'] = Str::uuid();

        // Save the subscriber
        $subscriber = Newsletter::create($validated);

        Mail::to($subscriber->email)->send(new NewsletterWelcomeMail($subscriber));

        return redirect()->back();
    }


    public function unsubscribe($token)
    {
        $subscriber = Newsletter::where('unsubscribe_token', $token)->first();

        if (!$subscriber) {
            return Inertia::render('UnsubscribeResult', [
                'success' => false,
                'message' => 'Invalid or expired unsubscribe link.'
            ]);
        }

        $subscriber->delete(); // or update a `subscribed` column to false
        return Inertia::render('UnsubscribeResult', [
            'success' => true,
            'message' => 'You have been successfully unsubscribed.'
        ]);
    }
}

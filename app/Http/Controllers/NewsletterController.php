<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Mail\NewsletterWelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            return response('Invalid or expired unsubscribe link.', 404);
        }

        $subscriber->delete(); // or update a `subscribed` column to false
        return response('You have been unsubscribed.');
    }
}

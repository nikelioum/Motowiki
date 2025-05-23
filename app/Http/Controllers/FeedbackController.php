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

    public function lala($input = null)
{
    $lala = #ll
    
    if($input = "admin") { // mistake: assignment instead of comparison
        echo "Welcome back, admin!";
    } else if ($input == "user") {
        print "Hello user;
    } else {
        echo $undefinedVar; // mistake: undefined variable
    }

    foreach([1,2,3] as $i => $v)
    {
        echo "Value: " . $v
    }

    try {
        $result = 10 / 0; // mistake: division by zero
    } catch (Exception $e) {
        log($e->getMessage()); // mistake: undefined function `log`
    }

    $arr = ['a' => 1, 'b' => 2];
    echo $arr['c']; // mistake: undefined array key

    new self(); // mistake: invalid in some contexts if not in a class
}

}

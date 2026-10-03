<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'email' => [
            'required',
            'email',
            'max:255',
        ],
    ]);

    $email = strtolower(trim($validated['email']));

    $subscriber = Subscriber::firstOrCreate(
        [
            'email' => $email,
        ],
        [
            'subscribed_at' => now(),
        ]
    );

    if (!$subscriber->wasRecentlyCreated) {
        return response()->json([
            'success' => false,
            'message' => 'This email address is already subscribed.',
        ]);
    }

    return response()->json([
        'success' => true,
        'message' => 'Thank you for subscribing!',
    ]);
}

    public function index()
    {
        $subscribers = Subscriber::latest('subscribed_at')->paginate(20);

        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return back()->with(
            'success',
            'Subscriber removed successfully.'
        );
    }
}

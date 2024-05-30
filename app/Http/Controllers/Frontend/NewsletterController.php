<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscribers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewsletterController extends Controller
{
    function subscribe(Request $request): Response
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:subscribers,email']
        ]);

        $subscriber = new Subscribers();
        $subscriber->email = $request->email;
        $subscriber->save();

        return response(['message' => 'You have successfully subscribed to our newsletter.']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterMail;
use App\Models\Subscribers;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Mail;

class NewsletterController extends Controller
{
    use Searchable;

    public function __construct()
    {
        $this->middleware(['permission:newsletter']);
    }
    function index(): View
    {
        $query = Subscribers::query();
        $this->search($query, ['email']);
        $subscribers = $query->orderBy('id', 'desc')->paginate(20);
        return view('admin.newsletter.index', compact('subscribers'));
    }

    function destroy($id)
    {
        try {
            Subscribers::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again!'], 500);
        }
    }

    function send(Request $request)
    {
        $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string']
        ]);

        $subscribers = Subscribers::all();

        foreach ($subscribers as $key => $subscriber) {
            Mail::to($subscriber->email)->send(new NewsletterMail($request->subject, $request->message));
        }

        Notify::successNotification();

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Services\Notify;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CounterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:sections']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $counter = Counter::first();
        return view('admin.counter.index', compact('counter'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title_one' => ['required', 'string', 'max:255'],
            'counter_one' => ['required', 'numeric'],
            'title_two' => ['required', 'string', 'max:255'],
            'counter_two' => ['required', 'numeric'],
            'title_three' => ['required', 'string', 'max:255'],
            'counter_three' => ['required', 'numeric'],
            'title_four' => ['required', 'string', 'max:255'],
            'counter_four' => ['required', 'numeric'],
        ]);





        Counter::updateOrCreate(
            ['id' => 1],
            [
                'title_one' => $request->title_one,
                'counter_one' => $request->counter_one,
                'title_two' => $request->title_two,
                'counter_two' => $request->counter_two,
                'title_three' => $request->title_three,
                'counter_three' => $request->counter_three,
                'title_four' => $request->title_four,
                'counter_four' => $request->counter_four,
            ]
        );

        Notify::updatedNotification();

        return redirect()->back();
    }
}

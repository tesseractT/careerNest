<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialIcon;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SocialIconController extends Controller
{
    use Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = SocialIcon::query();
        $this->search($query, ['url']);
        $icons = $query->orderBy('id', 'desc')->paginate(20);
        return view('admin.social-icon.index', compact('icons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.social-icon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'url' => ['required'],
            'icon' => ['required', 'string'],
        ]);

        $social = new SocialIcon();
        $social->url = $request->url;
        $social->icon = $request->icon;
        $social->save();

        Notify::createdNotification();

        return redirect()->route('admin.social-icon.index');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $icon = SocialIcon::findOrFail($id);
        return view('admin.social-icon.edit', compact('icon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'url' => ['required'],
        ]);

        $social = SocialIcon::findOrFail($id);
        $social->url = $request->url;
        if ($request->filled('icon')) {
            $social->icon = $request->icon;
        }
        $social->save();

        Notify::updatedNotification();

        return redirect()->route('admin.social-icon.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            SocialIcon::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again!'], 500);
        }
    }
}

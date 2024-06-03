<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeroController extends Controller
{
    use FileUploadTrait;

    public function __construct()
    {
        $this->middleware(['permission:sections']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $hero = Hero::first();
        return view('admin.hero.index', compact('hero'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:3000'],
            'background_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:3000'],
        ]);

        $image = $this->uploadFile($request, 'image');
        $backgroundImage = $this->uploadFile($request, 'background_image');

        $formData = [];
        if ($image) {
            $formData['image'] = $image;
        }
        if ($backgroundImage) {
            $formData['background_image'] = $backgroundImage;
        }

        $formData['title'] = $request->title;
        $formData['subtitle'] = $request->subtitle;


        Hero::updateOrCreate(
            ['id' => 1],
            $formData
        );

        Notify::updatedNotification();

        return redirect()->back();
    }
}

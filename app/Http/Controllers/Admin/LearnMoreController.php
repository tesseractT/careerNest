<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LearnMore;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LearnMoreController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $learn = LearnMore::first();
        return view('admin.learn-more.index', compact('learn'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'main_title' => ['required', 'string', 'max:255'],
            'sub_title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:3000'],
            'url' => ['nullable'],
        ]);

        $image = $this->uploadFile($request, 'image');

        $formData = [];
        if ($image) {
            $formData['image'] = $image;
        }

        $formData['title'] = $request->title;
        $formData['sub_title'] = $request->sub_title;
        $formData['main_title'] = $request->main_title;
        $formData['url'] = $request->url;


        LearnMore::updateOrCreate(
            ['id' => 1],
            $formData
        );

        Notify::updatedNotification();

        return redirect()->back();
    }
}

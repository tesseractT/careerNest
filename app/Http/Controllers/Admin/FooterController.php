<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FooterController extends Controller
{
    use FileUploadTrait;

    public function __construct()
    {
        $this->middleware(['permission:site footer']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $footer = Footer::first();
        return view('admin.footer.index', compact('footer'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $logoPath = $this->uploadFile($request, 'logo');
        $data = [
            'copy_right' => $request->copy_right,
            'details' => $request->description,
        ];
        if ($logoPath) {
            $data['logo'] = $logoPath;
        }
        Footer::updateOrCreate(
            ['id' => 1],
            $data
        );

        Notify::updatedNotification();

        return redirect()->route('admin.footer.index');
    }
}

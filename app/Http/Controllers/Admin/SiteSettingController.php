<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GeneralSettingUpdateRequest;
use App\Models\SiteSetting;
use App\Services\Notify;
use App\Services\SiteSettingService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SiteSettingController extends Controller
{
    use FileUploadTrait;
    public function __construct()
    {
        $this->middleware(['permission:site settings']);
    }
    function index(): View
    {
        return view('admin.site-setting.index');
    }

    function updateGeneralSetting(GeneralSettingUpdateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        foreach ($validatedData as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $siteSetting = app()->make(SiteSettingService::class);
        $siteSetting->clearCachedSettings();

        Notify::updatedNotification();

        return redirect()->back();
    }


    function updateLogoSetting(Request $request): RedirectResponse
    {
        $request->validate([
            'logo' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'favicon' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $logoPath = $this->uploadFile($request, 'logo');
        $faviconPath = $this->uploadFile($request, 'favicon');

        $logoData = [];
        if ($logoPath) $logoData['value'] = $logoPath;

        SiteSetting::updateOrCreate(
            ['key' => 'site_logo'],
            $logoData
        );

        $faviconData = [];
        if ($faviconPath) $faviconData['value'] = $faviconPath;

        SiteSetting::updateOrCreate(
            ['key' => 'site_favicon'],
            $faviconData
        );

        $siteSetting = app()->make(SiteSettingService::class);
        $siteSetting->clearCachedSettings();

        Notify::updatedNotification();

        return redirect()->back();
    }
}

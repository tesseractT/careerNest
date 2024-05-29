<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GeneralSettingUpdateRequest;
use App\Models\SiteSetting;
use App\Services\Notify;
use App\Services\SiteSettingService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SiteSettingController extends Controller
{
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
}

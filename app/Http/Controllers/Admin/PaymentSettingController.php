<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaypalSettingUpdateRequest;
use App\Models\PaymentSetting;
use App\Services\Notify;
use App\Services\PaymentGatewaySettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentSettingController extends Controller
{
    function index(): View
    {
        return view('admin.payment-setting.index');
    }

    function updatePaypalSetting(PaypalSettingUpdateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        foreach ($validatedData as $key => $value) {
            PaymentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        // session()->flash('success', 'Paypal settings updated successfully');

        // Clear cache
        $settingService = app(PaymentGatewaySettingService::class);
        $settingService->clearCachedSettings();
        // $settingService->setGlobalSettings();

        Notify::updatedNotification();
        return redirect()->back();
    }
}

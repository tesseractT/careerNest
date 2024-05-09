<?php

namespace App\Services;

use App\Models\PaymentSetting;
use Cache;

class PaymentGatewaySettingService
{
    function getSettings()
    {
        return Cache::rememberForever('getewaySettings', function () {
            return PaymentSetting::pluck('value', 'key')->toArray();
        });
    }

    function setGlobalSettings()
    {
        $settings = $this->getSettings();
        config()->set('getewaySettings', $settings);
    }

    function clearCachedSettings(): void
    {
        Cache::forget('getewaySettings');
    }
}

<?php

/** Check Input Error */

use App\Models\Company;

if (!function_exists('hasError')) {
    function hasError($errors, string $name): ?String
    {
        return $errors->has($name) ? 'is-invalid' : '';
    }
}

/** Set Sidebar Active */

if (!function_exists('setSidebarActive')) {

    function setSidebarActive(array $routes): ?String
    {
        foreach ($routes as $route) {
            if (request()->routeIs($route)) {
                return 'active';
            }
        }

        return '';
    }
}

/** Check Profile Completion */

if (!function_exists('isCompanyProfileComplete')) {

    function isCompanyProfileComplete(): bool
    {
        $requiredFields = [
            'logo',
            'banner',
            'bio',
            'vision',
            'name',
            'industry_type_id',
            'organization_type_id',
            'team_size_id',
            'establishment_date',
            'phone',
            'email',
            'country',
        ];

        $companyProfile = Company::where('user_id', auth()->user()->id)->first();

        foreach ($requiredFields as $field) {
            if (empty($companyProfile->{$field})) {
                return false;
            }
        }

        return true;
    }
}

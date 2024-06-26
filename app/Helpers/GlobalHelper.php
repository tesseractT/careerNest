<?php

/** Check Input Error */

use App\Models\Candidate;
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

/** Check Company Profile Completion */

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

/** Check Candidate Profile Completion */

if (!function_exists('isCandidateProfileComplete')) {

    function isCandidateProfileComplete(): bool
    {
        $requiredFields = [
            'experience_id',
            'profession_id',
            'image',
            'full_name',
            'dob',
            'gender',
            'bio',
            'marital_status',
            'country',
            'status'

        ];

        $candidateProfile = Candidate::where('user_id', auth()->user()->id)->first();

        foreach ($requiredFields as $field) {
            if (empty($candidateProfile->{$field})) {
                return false;
            }
        }

        return true;
    }
}


/** Format Date */

if (!function_exists('formatDate')) {

    function formatDate(?string $date): ?String
    {
        if ($date) {
            return date('d M, Y', strtotime($date));
        }

        return null;
    }
}

/** Set User Plan Info in Session*/

if (!function_exists('storePlanInformation')) {

    function storePlanInformation()
    {
        session()->forget('user_plan');
        session([
            'user_plan' => isset(auth()->user()?->company?->userPlan) ? auth()->user()?->company?->userPlan : null,
        ]);
    }
}

/** Format Location */
if (!function_exists('formatLocation')) {

    function formatLocation($country = null, $state = null, $city = null, $address = null): ?String
    {
        $location = '';

        if ($address) {
            $location .= $address;
        }

        if ($city) {
            $location .= $address ? ', ' . $city : $city;
        }

        if ($state) {
            $location .= $city ? ', ' . $state : $state;
        }

        if ($country) {
            $location .= $state ? ', ' . $country : $country;
        }

        return $location;
    }
}

/** Calculate Earnings */

if (!function_exists('calculateEarnings')) {

    function calculateEarnings($amount)
    {
        $total = 0;
        foreach ($amount as $value) {
            $amount = intval(preg_replace('/[^0-9]/', '', $value));
            $total += $amount;
        }

        return $total;
    }
}

/** Check Permission */

if (!function_exists('canAccess')) {

    function canAccess(array $permissions): bool
    {
        $permission = auth()->guard('admin')->user()->hasAnyPermission($permissions);
        $superAdmin = auth()->guard('admin')->user()->hasRole('Super Admin');

        if ($superAdmin || $permission) {
            return true;
        }

        return false;
    }
}

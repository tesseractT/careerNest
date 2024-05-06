<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendCompanyPageController extends Controller
{
    function index(): View
    {
        $companies = Company::where(['profile_completed' => 1, 'visibility' => 1])->get();
        return view('frontend.pages.company-index', compact('companies'));
    }

    function show(String $slug): View
    {
        $company = Company::where(['slug' => $slug, 'profile_completed' => 1, 'visibility' => 1])->first();
        return view('frontend.pages.company-details', compact('company'));
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Hero;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    function index(): View
    {
        $hero = Hero::first();
        $jobCategories = JobCategory::all();
        $popularJobCategories = JobCategory::withCount(['jobs' => function ($query) {
            $query->where(['status' => 'active'])->whereDate('deadline', '>=', date('Y-m-d'));
        }])->where('is_popular', 1)->get();
        $countries = Country::all();
        $jobCount = Job::count();
        $plans = Plan::where(['frontend_show' => 1, 'show_at_home' => 1])->get();
        return view('frontend.home.index', compact('plans', 'hero', 'jobCategories', 'countries', 'jobCount', 'popularJobCategories'));
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Country;
use App\Models\Hero;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\LearnMore;
use App\Models\Plan;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    function index(): View
    {
        $hero = Hero::first();
        $jobCategories = JobCategory::all();
        $popularJobCategories = JobCategory::withCount(['jobs' => function ($query) {
            $query->where(['status' => 'active'])->where('deadline', '>=', date('Y-m-d'));
        }])->where('is_popular', 1)->get();
        $countries = Country::all();
        $jobCount = Job::count();
        $whyChooseUs = WhyChooseUs::first();
        $plans = Plan::where(['frontend_show' => 1, 'show_at_home' => 1])->get();
        $featuredCategory = JobCategory::where('is_featured', 1)->take(10)->get();
        $learn = LearnMore::first();
        $counter = Counter::first();
        return view('frontend.home.index', compact('plans', 'hero', 'jobCategories', 'countries', 'jobCount', 'popularJobCategories', 'featuredCategory', 'whyChooseUs', 'learn', 'counter'));
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Order;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyDashboardController extends Controller
{
    function index(): View
    {
        $pendingJobPosts = Job::where('company_id', auth()->user()->company->id)->where('status', 'pending')->count();
        $jobPosts = Job::where('company_id', auth()->user()->company->id)->count();
        $orders = Order::where('company_id', auth()->user()->company->id)->count();
        $currentPackage = UserPlan::where('company_id', auth()->user()->company->id)->latest()->first();
        return view('frontend.company-dashboard.dashboard', compact('pendingJobPosts', 'jobPosts', 'orders', 'currentPackage'));
    }
}

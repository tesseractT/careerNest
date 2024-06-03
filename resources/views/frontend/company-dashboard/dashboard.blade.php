@extends('frontend.layouts.master')\
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Dashboard</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">


            <div class="row">
                @include('frontend.company-dashboard.sidebar')
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
                    <div class="content-single">
                        <h3 class="mt-0 mb-0 color-brand-1">Dashboard</h3>
                        <div class="dashboard_overview">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="dash_overview_item bg-info-subtle">
                                        <h2>{{ $pendingJobPosts }} <span>Pending Jobs</span></h2>
                                        <span style="align-content: center" class="icon"><i
                                                class="fas fa-briefcase"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="dash_overview_item bg-danger-subtle">
                                        <h2>{{ $jobPosts }} <span>Total Jobs</span></h2>
                                        <span style="align-content: center" class="icon"><i
                                                class="fas fa-briefcase"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="dash_overview_item bg-warning-subtle">
                                        <h2>{{ $orders }} <span>Orders</span></h2>
                                        <span style="align-content: center" class="icon"><i
                                                class="fas fa-cart-plus"></i></span>
                                    </div>
                                </div>
                            </div>
                            @if (!isCompanyProfileComplete())
                                <div class="row">
                                    <div class="col-12 mt-30">
                                        <div class="dash_alert_box p-30 bg-danger rounded-4 d-flex flex-wrap">
                                            <span class="img">
                                                <img src="{{ asset(auth()->user()->image) }}" alt="alert">
                                            </span>
                                            <div class="text">
                                                <h4 class="color-white">Please Complete Your Profile Information!</h4>
                                                <p class="color-white"> Complete all your profile information to use all
                                                    faetures and visible to potential employees </p>
                                            </div>
                                            <a href="{{ route('company.profile') }}" class="btn btn-default rounded-1">Edit
                                                Profile</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <br>
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered">

                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td><b>Current Package</b></td>
                                                <td><code>{{ $currentPackage->plan->label }} </code> Package</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td><b>Package Price</b></td>
                                                <td><code>{{ config('settings.site_currency_icon') }}{{ $currentPackage->plan->price }}</code>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td><b>Job Post Limit Available</b></td>
                                                <td> <code>{{ $currentPackage->plan->job_limit }}</code> Job Postings Left
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">4</th>
                                                <td><b>Featured Post Available</b></td>
                                                <td><code>{{ $currentPackage->plan->featured_job_limit }}</code> Featured
                                                    Postings Left
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">5</th>
                                                <td><b>Highlight Post Available</b></td>
                                                <td><code>{{ $currentPackage->plan->highlight_job_limit }}</code>
                                                    Highlighted Postings
                                                    Left</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <div class="mt-120"></div>
@endsection

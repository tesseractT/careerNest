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
                @include('frontend.candidate-dashboard.sidebar')
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
                    <div class="content-single">
                        <h3 class="mt-0 mb-0 color-brand-1">Dashboard</h3>
                        <div class="dashboard_overview">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="dash_overview_item bg-info-subtle">
                                        <h2>{{ $appliedJobsCount }} <span>job applied</span></h2>
                                        <span style="align-content: center;" class="icon"><i
                                                class="fas fa-briefcase"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="dash_overview_item bg-danger-subtle">
                                        <h2>{{ $userBookmarkJobsCount }} <span>job bookmarked</span></h2>
                                        <span style="align-content: center;" class="icon"><i
                                                class="fas fa-bookmark"></i></span>
                                    </div>
                                </div>

                            </div>

                            @if (!isCandidateProfileComplete())
                                <div class="row">
                                    <div class="col-12 mt-30">
                                        <div class="dash_alert_box p-30 bg-danger rounded-4 d-flex flex-wrap">
                                            <span class="img">
                                                <img src="{{ asset(auth()->user()->image) }}" alt="alert">
                                            </span>
                                            <div class="text">
                                                <h4 class="color-white">Please Complete Your Profile</h4>
                                                <p>
                                                    Your profile is not complete. Please complete your <b
                                                        style="font-weight: bold">"Basic Info",
                                                        "Profile Info" and "Account Settings" </b> to get
                                                    better job opportunities and aceess all features of the website.
                                                </p>
                                            </div>
                                            <a href="{{ route('candidate.profile.index') }}"
                                                class="btn btn-default rounded-1">Edit Profile</a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <br>
                            <hr>

                            <h3 class="color-text-mutted mb-10"> Recently Applied Jobs</h3>


                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>Salary</th>
                                        <th>Date</th>
                                        <th>Status</th>

                                        <th style="width:15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="experience-tbody">
                                    @foreach ($appliedJobs as $appliedJob)
                                        <tr>

                                            <td>
                                                <div class="d-flex">
                                                    <img src="{{ asset($appliedJob->job?->company?->logo) }}" alt=""
                                                        srcset="" style="width: 50px; height:50px; object-fit:cover">
                                                    <div style="padding-left:15px">
                                                        <h6>
                                                            {{ $appliedJob->job?->company?->name }}
                                                        </h6>
                                                        <b>
                                                            {{ $appliedJob->job?->company?->companyCountry->name }}
                                                        </b>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($appliedJob->job?->salary_mode === 'range')
                                                    {{ $appliedJob->job?->min_salary }} -
                                                    {{ $appliedJob->job?->max_salary }}
                                                    {{ config('settings.site_currency_icon') }}
                                                @else
                                                    {{ $appliedJob->job?->custom_salary }}
                                                @endif
                                            </td>

                                            <td>
                                                {{ formatDate($appliedJob->created_at) }}
                                            </td>
                                            <td>
                                                @if ($appliedJob->job->deadline < date('Y-m-d'))
                                                    <span class="badge bg-danger">Expired</span>
                                                @else
                                                    <span class="badge bg-success">Active</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($appliedJob->job->deadline < date('Y-m-d'))
                                                    <a href="javascript:void(0)" class="btn-sm btn btn-primary disabled"><i
                                                            class="fas fa-eye" aria-hidden="true"></i></a>
                                                @else
                                                    <a href="{{ route('jobs.show', $appliedJob->job->slug) }}"
                                                        class="btn-sm btn btn-primary"><i class="fas fa-eye"
                                                            aria-hidden="true"></i></a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="mt-120"></div>
@endsection

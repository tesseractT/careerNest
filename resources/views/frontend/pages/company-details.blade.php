@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Company Profile</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>{{ $company?->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box-2">
        <div class="container">
            <div class="banner-hero banner-image-single"><img style="height: 374px; object-fit:cover;"
                    src="{{ asset($company?->banner) }}" alt="careernest"></div>
            <div class="box-company-profile">
                <div class="row mt-10">
                    <div class="col-lg-8 col-md-12">
                        <div>
                            <img style="width: 100px; height: 100px; object-fit:cover; border-radius:50%"
                                src="{{ asset($company?->logo) }}" alt="careernest">
                        </div>
                        <h5 class="f-18">{{ $company?->name }}<span
                                class="card-location font-regular ml-20">{{ $company?->companyState->name }},
                                {{ $company?->companyCountry->name }}</span></h5>
                    </div>
                    <div class="col-lg-4 col-md-12 text-lg-end"><a class="btn btn-apply btn-apply-big" href="javascript:;"
                            onclick="document.getElementById('open-positions').scrollIntoView()">Open Positions</a></div>
                </div>
            </div>

            <div class="border-bottom pt-10 pb-10"></div>
        </div>
    </section>

    <section class="section-box mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="content-single">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-about" role="tabpanel"
                                aria-labelledby="tab-about">
                                <h4>About Us</h4>
                                <p>{!! $company?->bio !!}</p>

                                <h4>Company Vision</h4>
                                <p>{!! $company?->vision !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="box-related-job content-page" id="open-positions">
                        <h5 class="mb-30">Open Jobs</h5>
                        <div class="box-list-jobs display-list">
                            @forelse ($openJobs as $job)
                                <div class="col-xl-12 col-12">
                                    <div class="card-grid-2 hover-up"><span class="flash"></span>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="card-grid-2-image-left">
                                                    <div class="image-box"><img src="{{ asset($job->company->logo) }}"
                                                            alt="joblist"></div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="{{ route('companies.show', $job->company->slug) }}">{{ $job->company->name }}</a><span
                                                            class="location-small">{{ formatLocation($job->company->companyCountry->name, $job->company?->companyState?->name) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 text-start text-md-end pr-60 col-md-6 col-sm-12">
                                                <div class="pl-15 mb-15 mt-30">
                                                    @if ($job->featured)
                                                        <a class="btn btn-grey-small mr-5 featured"
                                                            href="javascript:;">Featured</a>
                                                    @endif
                                                    @if ($job->highlight)
                                                        <a class="btn btn-grey-small mr-5 highlight"
                                                            href="javascript:;">Highlight</a>
                                                    @endif
                                                    @if ($job->company->userPlan->profile_verified)
                                                        <a class="btn btn-grey-small verified" href="javascript:;"> Verified
                                                            Company</a>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block-info">
                                            <h4><a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a>
                                            </h4>
                                            <div class="mt-5">

                                                <span class="card-briefcase">{{ $job->jobType?->name }}</span>
                                                <span class="card-briefcase">{{ $job->jobExperience?->name }}</span>
                                                <span
                                                    class="card-time"><span>{{ $job->created_at->diffForHumans() }}</span>
                                            </div>
                                            {{-- <p class="font-sm color-text-paragraph mt-10">Lorem ipsum dolor sit amet,
                                            consectetur adipisicing
                                            elit. Recusandae architecto eveniet, dolor quo repellendus pariatur</p> --}}

                                            <div class="mt-10">
                                                @foreach ($job->skills as $jobSkill)
                                                    @if ($loop->index <= 5)
                                                        <a class="btn btn-grey-small mr-5 job-skill"
                                                            href="javascript:;">{{ $jobSkill->skill->name }}</a>
                                                    @elseif($loop->index == 6)
                                                        <a class="btn btn-grey-small mr-5 job-skill"
                                                            href="javascript:;">More...</a>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="card-2-bottom">
                                                <div class="row">
                                                    @if ($job->salary_mode === 'range')
                                                        <div class="col-lg-7 col-7"><span
                                                                class="card-text-price">{{ config('settings.site_currency_icon') }}{{ $job->min_salary }}
                                                                -
                                                                {{ $job->max_salary }}</span><span
                                                                class="text-muted">/{{ $job->salaryType->name }}</span>
                                                        </div>
                                                    @else
                                                        <div class="col-lg-7 col-7"><span
                                                                class="card-text-price">{{ $job->custom_salary }}</span>
                                                        </div>
                                                    @endif
                                                    <div class="col-lg-5 col-5 text-end">
                                                        <div class="btn bookmark-btn">
                                                            <i class="far fa-bookmark"></i>
                                                            {{-- <i class="fas fa-bookmark"></i> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-lg-12 col-xl-12 col-md-4">
                                    <div class="alert alert-warning" role="alert">
                                        <h5> No Open Jobs At The Momment</h5>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="paginations mt-60">
                            <nav class="d-inline-block">
                                @if ($openJobs->hasPages())
                                    {{ $openJobs->withQueryString()->links() }}
                                @endif
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                    <div class="sidebar-border">
                        <div class="sidebar-heading">
                            <div class="avatar-sidebar">
                                <div class="sidebar-info pl-0"><span
                                        class="sidebar-company">{{ $company?->name }}</span><span
                                        class="card-location">{{ $company?->companyState->name }},
                                        {{ $company?->companyCountry->name }}</span></div>
                            </div>
                        </div>
                        <div class="sidebar-list-job">
                            <div class="box-map">
                                {!! $company?->map_link !!}
                            </div>
                        </div>
                        <div class="sidebar-list-job">
                            <ul>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-briefcase"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Industry
                                            Type</span><strong
                                            class="small-heading">{{ $company?->companyIndustry->name }}</strong></div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-marker"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Organization
                                            Type</span><strong
                                            class="small-heading">{{ $company?->organizationType->name }}</strong></div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi fi-rr-user"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Team Size</span><strong
                                            class="small-heading">{{ $company?->companySize->name }}</strong></div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-clock"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">
                                            Date Founded</span><strong
                                            class="small-heading">{{ formatDate($company?->establishment_date) }}</strong>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="sidebar-list-job">
                            <ul class="ul-disc">
                                <li>{{ $company?->address }}{{ $company?->companyCity?->name ? ', ' . $company?->companyCity?->name : '' }}{{ $company?->companyState?->name ? ', ' . $company?->companyState?->name : '' }}{{ $company?->companyCountry?->name ? ', ' . $company?->companyCountry?->name : '' }}
                                </li>
                                <li>Phone: <a href="tel:{{ $company?->phone }}">{{ $company?->phone }}</a></li>
                                <li>Email: <a href="mailto:{{ $company?->email }}">{{ $company?->email }}</a></li>
                                <li>Website: <a href="{{ $company?->website }}">{{ $company?->website }}</a></li>
                            </ul>
                            <div class="mt-30"><a class="btn btn-send-message"
                                    href="mailto:{{ $company?->email }}">Send
                                    Message</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

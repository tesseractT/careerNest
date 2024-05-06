@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Candidate Details</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>{{ $candidate?->full_name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box-2">
        <div class="container">
            <div class="banner-hero banner-image-single"><img
                    style="width: 100px; height: 100px; object-fit:cover; border-radius:50%"
                    src="{{ asset($candidate?->image) }}" alt="careernest">
            </div>
            <div class="box-company-profile">
                <div class="row mt-10">
                    <div class="col-lg-8 col-md-12">
                        <h5 class="f-18">{{ $candidate?->full_name }}<span class="card-location font-regular ml-20">
                                {{ $candidate?->companyCountry?->name }}</span>
                        </h5>
                        <p class="mt-0 font-md color-text-paragraph-2 mb-15">{{ $candidate?->title }}</p>
                        {{-- <div class="mt-0 mb-15 d-flex flex-wrap align-items-center">
                            <img src="assets/imgs/template/icons/star.svg" alt="joblist">
                            <img src="assets/imgs/template/icons/star.svg" alt="joblist">
                            <img src="assets/imgs/template/icons/star.svg" alt="joblist">
                            <img src="assets/imgs/template/icons/star.svg" alt="joblist">
                            <img src="assets/imgs/template/icons/star.svg" alt="joblist">
                            <span class="font-xs color-text-mutted ml-10">(66)</span>
                            <img class="ml-30" src="assets/imgs/page/candidates/verified.png" alt="joblist">
                        </div> --}}
                    </div>

                    @if ($candidate->cv)
                        <div class="col-lg-4 col-md-12 text-lg-end"><a class="btn btn-download-icon btn-apply btn-apply-big"
                                href="{{ asset($candidate?->cv) }}">Download CV</a></div>
                    @endif

                </div>
            </div>

            <div class="border-bottom pt-10 pb-10"></div>
        </div>
    </section>

    <section class="section-box mt-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="content-single">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-short-bio" role="tabpanel"
                                aria-labelledby="tab-short-bio">
                                <h4>Biography</h4>
                                <p>{!! $candidate?->bio !!}</p>

                            </div>

                        </div>
                    </div>
                    <div class="box-related-job content-page   cadidate_details_list">
                        <div class="mt-5 mb-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Experience</h4>
                                    <ul class="timeline">

                                        @foreach ($candidate->experiences as $experience)
                                            <li>
                                                <a href="#"
                                                    class="float-right">{{ formatDate($experience->start_date) }} -
                                                    {{ $experience->currently_working ? 'Current' : formatDate($experience->end_date) }}</a>
                                                <a href="javascript:;">{{ $experience->designation }}</a> |
                                                <span>{{ $experience->department }}</span>
                                                <p>{{ $experience->company }}</p>
                                                <p>{{ $experience->responsibilities }}</p>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <h4>Education</h4>
                                    <ul class="timeline">

                                        @foreach ($candidate->educations as $education)
                                            <li>
                                                <a href="#"
                                                    class="float-right">{{ formatDate($education->year) }}</a>
                                                <a href="javascript:;">{{ $education->level }}</a>
                                                <p>{{ $education->degree }}</p>
                                                <p>{{ $education->note }}</p>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                    <div class="sidebar-border">
                        <h5 class="f-18">Overview</h5>
                        <div class="sidebar-list-job">
                            <ul>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-briefcase"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Experience</span><strong
                                            class="small-heading">{{ $candidate?->experience?->name }}</strong></div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi fi-rr-settings-sliders"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Skills</span>
                                        <strong>
                                            @foreach ($candidate?->skill as $candidateSkill)
                                                <span
                                                    class="badge bg-info text-light">{{ $candidateSkill?->skills?->name }}</span>
                                            @endforeach
                                        </strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-dollar"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Languages
                                        </span><strong class="small-heading">
                                            @foreach ($candidate?->language as $candidateLanguage)
                                                <span
                                                    class="badge bg-info text-light">{{ $candidateLanguage?->languages?->name }}</span>
                                            @endforeach
                                        </strong></div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-time-fast"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Profession
                                        </span><strong
                                            class="small-heading">{{ ucfirst($candidate?->profession?->name) }}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-marker"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Date of
                                            Birth</span><strong
                                            class="small-heading">{{ formatDate($candidate?->dob) }}</strong></div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-time-fast"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Gender
                                        </span><strong class="small-heading">{{ ucfirst($candidate?->gender) }}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-time-fast"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Marital Status
                                        </span><strong
                                            class="small-heading">{{ ucfirst($candidate?->marital_status) }}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-time-fast"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Website
                                        </span><strong class="small-heading"><a href="{{ $candidate?->website }}"
                                                target="_blank"
                                                rel="noopener noreferrer">{{ $candidate?->website }}</a></strong></div>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar-list-job">
                            <ul class="ul-disc">
                                <li>{{ $candidate?->address }}{{ $candidate?->companyCity?->name ? ', ' . $candidate?->companyCity?->name : '' }}{{ $candidate?->companyState?->name ? ', ' . $candidate?->companyState?->name : '' }}{{ $candidate?->companyCountry?->name ? ', ' . $candidate?->companyCountry?->name : '' }}
                                </li>
                                <li>Primary Phone: <a
                                        href="tel:{{ $candidate?->phone_one }}">{{ $candidate?->phone_one }}</a></li>
                                @if ($candidate?->phone_two)
                                    <li>Secondary Phone: <a
                                            href="tel:{{ $candidate?->phone_two }}">{{ $candidate?->phone_two }}</a></li>
                                @endif
                                <li>Email: <a href="mailto:{{ $candidate?->email }}">{{ $candidate?->email }}</a></li>
                            </ul>
                            <div class="mt-30"><a class="btn btn-send-message"
                                    href="mailto:{{ $candidate?->email }}">Send
                                    Message</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

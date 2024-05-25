@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Job Details</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>{{ $job->title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box-2">
        <div class="container">
            <div class="banner-hero banner-image-single"><img style="object-fit: cover; height:300px"
                    src="{{ asset($job->company->banner) }}" alt="joblist">
            </div>
            <div class="row mt-10">
                <div class="col-lg-8 col-md-12">
                    <h3>{{ $job->title }}</h3>
                    <div class="mb-15 mt-0">

                        <span class="card-briefcase">{{ $job->jobType?->name }}</span>
                        <span class="card-briefcase">{{ $job->jobExperience?->name }}</span>
                        <span class="card-time"><span>{{ $job->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 text-lg-end">
                    @if ($alreadyApplied)
                        <div class="btn btn-apply-icon btn-apply btn-apply-big hover-up apply-now"
                            style="background-color: #8d8c8c;">Applied
                        </div>
                    @else
                        <div class="btn btn-apply-icon btn-apply btn-apply-big hover-up apply-now">Apply now</div>
                    @endif
                </div>
            </div>
            <div class="border-bottom pt-10 pb-10"></div>
        </div>
    </section>

    <section class="section-box mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="job-overview">
                        <h5 class="border-bottom pb-15 mb-30">Employment Information</h5>
                        <div class="row">
                            <div class="col-md-6 d-flex">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/industry.svg') }}"
                                        alt="joblist">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description industry-icon mb-10">Industry</span><strong
                                        class="small-heading">
                                        {{ $job->category->name }}</strong></div>
                            </div>
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/job-level.svg') }}"
                                        alt="joblist">
                                </div>
                                <div class="sidebar-text-info ml-10"><span class="text-description joblevel-icon mb-10">Job
                                        Role</span><strong class="small-heading">{{ $job->jobRole->name }}</strong></div>
                            </div>
                        </div>
                        <div class="row mt-25">
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/salary.svg') }}"
                                        alt="joblist"></div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description salary-icon mb-10">Salary</span><strong
                                        class="small-heading">
                                        @if ($job->salary_mode === 'range')
                                            {{ config('settings.site_currency_icon') }}{{ $job->min_salary }}
                                            -
                                            {{ $job->max_salary }}
                                        @else
                                            {{ $job->custom_salary }}
                                        @endif
                                    </strong></div>
                            </div>
                            <div class="col-md-6 d-flex">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/experience.svg') }}"
                                        alt="joblist">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description experience-icon mb-10">Experience</span><strong
                                        class="small-heading">{{ $job->jobExperience?->name }}</strong></div>
                            </div>
                        </div>
                        <div class="row mt-25">
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/job-type.svg') }}"
                                        alt="joblist">
                                </div>
                                <div class="sidebar-text-info ml-10"><span class="text-description jobtype-icon mb-10">Job
                                        type</span><strong class="small-heading">{{ $job->jobType->name }}</strong></div>
                            </div>
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/deadline.svg') }}"
                                        alt="joblist">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description mb-10">Deadline</span><strong
                                        class="small-heading">{{ formatDate($job->deadline) }}</strong></div>
                            </div>
                        </div>
                        <div class="row mt-25">
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/updated.svg') }}"
                                        alt="joblist"></div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description jobtype-icon mb-10">Education</span><strong
                                        class="small-heading">{{ $job->jobEducation->name }}</strong></div>
                            </div>
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/location.svg') }}"
                                        alt="joblist">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description mb-10">Location</span><strong
                                        class="small-heading">{{ formatLocation($job->country?->name, $job->state?->name, $job->city?->name, $job->address) }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-single">
                        <h5 class="border-bottom pb-15 mb-30">Job Description</h5>
                        <br>
                        {!! $job->description !!}
                    </div>
                    <div class="author-single"><span>{{ $job->company->name }}</span></div>
                    <div class="single-apply-jobs">
                        <div class="row align-items-center">

                            <div class="col-md-7 text-lg-end social-share">
                                <h6 class="color-text-paragraph-2 d-inline-block d-baseline mr-10">Share this</h6>
                                <a data-social="facebook" class="mr-5 d-inline-block d-middle" href="#"><img
                                        alt="joblist"
                                        src="{{ asset('frontend/assets/imgs/template/icons/share-fb.svg') }}">
                                </a>
                                <a data-social="twitter" class="mr-5 d-inline-block d-middle" href="#"><img
                                        alt="joblist"
                                        src="{{ asset('frontend/assets/imgs/template/icons/share-tw.svg') }}"></a>
                                <a data-social="reddit" class="mr-5 d-inline-block d-middle" href="#"><img
                                        alt="joblist"
                                        src="{{ asset('frontend/assets/imgs/template/icons/share-red.svg') }}"></a>
                                <a data-social="linkedin" class="d-inline-block d-middle" href="#"><img
                                        alt="joblist"
                                        src="{{ asset('frontend/assets/imgs/template/icons/share-linkedin.svg') }}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                    <div class="sidebar-border">
                        <div class="sidebar-heading">
                            <div class="avatar-sidebar">
                                <figure><img alt="joblist" src="{{ asset($job->company->logo) }}"></figure>
                                <div class="sidebar-info"><span
                                        class="sidebar-company">{{ $job->company->name }}</span><span
                                        class="card-location">{{ formatLocation($job->company?->companyCountry->name, $job->company?->companyState->name) }}</span>
                                    @if ($openJobs > 0)
                                        <a class="link-underline mt-15"
                                            href="{{ route('companies.show', $job->company?->slug) }}">{{ $openJobs }}
                                            Open Jobs</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="sidebar-list-job">
                            <div class="box-map">
                                {!! $job->company->map_link !!}
                            </div>
                            <ul class="ul-disc">
                                <li>{{ formatLocation($job->country?->name, $job->state?->name, $job->city?->name, $job->address) }}
                                </li>
                                <li>Phone: {{ $job->company->phone }}</li>
                                <li>Email: {{ $job->company->email }}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-border">
                        <div class="sidebar-heading">
                            <h6 class="f-18">Skills</h6>
                        </div>
                        <div class="sidebar-list-job">
                            <div class="mt-10">
                                @foreach ($job->skills as $jobSkill)
                                    <a class="btn btn-grey-small mr-5 mb-2 job-skill"
                                        href="javascript:;">{{ $jobSkill->skill->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-border">
                        <div class="sidebar-heading">
                            <h6 class="f-18">Benefits</h6>
                        </div>
                        <div class="sidebar-list-job">
                            <div class="mt-10">
                                @foreach ($job->benefits as $JobBenefit)
                                    <a class="btn btn-grey-small mr-5 mb-2 job-skill"
                                        href="javascript:;">{{ $JobBenefit->benefit->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-border">
                        <div class="sidebar-heading">
                            <h6 class="f-18">Tags</h6>
                        </div>
                        <div class="sidebar-list-job">
                            <div class="mt-10">
                                @foreach ($job->tags as $jobTag)
                                    <a class="btn btn-grey-small mr-5 mb-2 job-skill"
                                        href="javascript:;">{{ $jobTag->tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.apply-now').on('click', function() {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('apply-jobs.store', $job->id) }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    beforeSend: function() {

                    },
                    success: function(response) {
                        notyf.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(index, value) {
                            notyf.error(value[0]);
                        });
                    },
                })
            });
        });
    </script>
@endpush

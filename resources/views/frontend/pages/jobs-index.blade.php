@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Find a Job</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Jobs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9 col-md-12 col-sm-12 col-12 float-right">
                    <div class="content-page">

                        <div class="row display-list">
                            @forelse ($jobs as $job)
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
                                            <h4><a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a></h4>
                                            <div class="mt-5">

                                                <span class="card-briefcase">{{ $job->jobType?->name }}</span>
                                                <span class="card-briefcase">{{ $job->jobExperience?->name }}</span>
                                                <span class="card-time"><span>{{ $job->created_at->diffForHumans() }}</span>
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
                                                    @php
                                                        $bookmarkedIds = \App\Models\JobBookmark::where(
                                                            'candidate_id',
                                                            auth()?->user()?->candidateProfile?->id,
                                                        )
                                                            ->pluck('job_id')
                                                            ->toArray();
                                                    @endphp
                                                    <div class="col-lg-5 col-5 text-end">
                                                        <div class="btn bookmark-btn job-bookmark"
                                                            data-id="{{ $job->id }}">
                                                            @if (in_array($job->id, $bookmarkedIds))
                                                                <i class="fas fa-bookmark"></i>
                                                            @else
                                                                <i class="far fa-bookmark"></i>
                                                            @endif

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
                                        <h5> No companies found! Please try again with different filters.</h5>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="paginations">
                        <ul class="pager">
                            @if ($jobs->hasPages())
                                {{ $jobs->withQueryString()->links() }}
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="sidebar-shadow none-shadow mb-30">
                        <div class="sidebar-filters">
                            <div class="filter-block head-border mb-30">
                                <h5>Advance Filter <a class="link-reset" href="#">Reset</a></h5>
                            </div>
                            <form action="{{ route('jobs.index') }}" method="GET">
                                <div class="filter-block mb-20">
                                    <div class="form-group">
                                        <input class="form-control" value="{{ request()?->search }}" type="text"
                                            name="search" placeholder="Keyword">
                                    </div>
                                </div>
                                <div class="filter-block mb-20">
                                    <div class="form-group select-style">
                                        <select name="country" class="form-control country form-icons select-active">
                                            <option value="">Country</option>

                                            @foreach ($countries as $country)
                                                <option @selected(request()?->country == $country->id) value="{{ $country->id }}">
                                                    {{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-block mb-20">
                                    <div class="form-group select-style">
                                        <select name="state" class="form-control state form-icons select-active">
                                            @if ($selectedStates)
                                                <option value="">All</option>
                                                @foreach ($selectedStates as $state)
                                                    <option @selected($state->id == request()?->state) value="{{ $state->id }}">
                                                        {{ $state->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">State</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="filter-block mb-30">
                                    <div class="form-group select-style">
                                        <select name="city" class="form-control city form-icons select-active">
                                            @if ($selectedCities)
                                                <option value="">All</option>
                                                @foreach ($selectedCities as $city)
                                                    <option @selected($city->id == request()?->city) value="{{ $city->id }}">
                                                        {{ $city->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">City</option>
                                            @endif

                                        </select>
                                        <button class="submit btn btn-default mt-10 rounded-1 w-100"
                                            type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('jobs.index') }}" method="GET">
                                <div class="filter-block mb-20">
                                    <h5 class="medium-heading mb-15">Categories</h5>
                                    <div class="form-group">
                                        <ul class="list-checkbox">
                                            <li>
                                                @foreach ($jobCategories as $category)
                                            <li>
                                                <label class="cb-container">
                                                    <input multiple name="category[]" value="{{ $category->slug }}"
                                                        type="checkbox"><span
                                                        class="text-small">{{ $category->name }}</span><span
                                                        class="checkmark"></span>
                                                </label><span class="number-item">{{ $category->jobs_count }}</span>
                                            </li>
                                            @endforeach
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="filter-block mb-20">
                                    <h5 class="medium-heading mb-25">Salary Range</h5>
                                    <div class="list-checkbox pb-20">
                                        <div class="row position-relative mt-10 mb-20">
                                            <div class="col-sm-12 box-slider-range">
                                                <div id="slider-range"></div>
                                            </div>
                                            <div class="box-input-money">
                                                <input class="input-disabled form-control min-value-money" type="text"
                                                    name="min-value-money" disabled="disabled" value="">
                                                <input class="form-control min-value" type="hidden" name="min_salary"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="box-number-money">
                                            <div class="row mt-30">
                                                <div class="col-sm-6 col-6"><span
                                                        class="font-sm color-brand-1">{{ config('settings.site_currency_icon') }}0</span>
                                                </div>
                                                <div class="col-sm-6 col-6 text-end"><span
                                                        class="font-sm color-brand-1">{{ config('settings.site_currency_icon') }}100,000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="filter-block mb-20">
                                    <h5 class="medium-heading mb-15">Job type</h5>
                                    <div class="form-group">
                                        <ul class="list-checkbox">
                                            @foreach ($jobTypes as $jobType)
                                                <li>
                                                    <label class="cb-container">
                                                        <input name="jobtype[]" value="{{ $jobType->slug }}"
                                                            type="checkbox" multiple><span
                                                            class="text-small">{{ $jobType->name }}</span><span
                                                            class="checkmark"></span>
                                                    </label><span class="number-item">{{ $jobType->jobs_count }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <button class="submit btn btn-default mt-10 rounded-1 w-100"
                                    type="submit">Search</button>


                            </form>
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
            $('.country').on('change', function() {
                let country_id = $(this).val();
                //Remove all previous cities
                $('.city').html('<option value="">Select City</option>');
                $.ajax({
                    method: 'GET',
                    url: '{{ route('get-states', ':id') }}'.replace(":id", country_id),
                    data: {},
                    success: function(response) {
                        let html = '';
                        $.each(response, function(index, value) {
                            html +=
                                `<option value="${value.id}">${value.name}</option>`;
                        });

                        html = `<option value="">Select State</option>` + html;

                        $('.state').html(html);
                    },
                    error: function(xhr, status, error) {

                    }
                })
            })

            // Get City
            $('.state').on('change', function() {
                let state_id = $(this).val();

                $.ajax({
                    method: 'GET',
                    url: '{{ route('get-cities', ':id') }}'.replace(":id", state_id),
                    data: {},
                    success: function(response) {
                        let html = '';
                        $.each(response, function(index, value) {
                            html +=
                                `<option value="${value.id}">${value.name}</option>`;
                        });

                        html = `<option value="">Select City</option>` + html;

                        $('.city').html(html);
                    },
                    error: function(xhr, status, error) {

                    }
                });
            });
        });

        $('.job-bookmark').on('click', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                method: 'GET',
                url: '{{ route('job.bookmark', ':id') }}'.replace(":id", id),
                data: {},
                success: function(response) {
                    $('.job-bookmark').each(function() {
                        let elementId = $(this).data('id');

                        if (elementId == response.id) {
                            $(this).find('i').addClass('fas fa-bookmark');
                        }
                    });
                    notyf.success(response.message);
                },
                error: function(xhr, status, error) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        notyf.error(value[0]);
                    });
                },
            });
        });
    </script>
@endpush

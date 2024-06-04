@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Companies</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="index.html">Home</a></li>
                            <li>Companies</li>
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
                    <div class="content-page company_page">

                        <div class="row">
                            @forelse ($companies as $company)
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="card-grid-1 hover-up wow animate__animated animate__fadeIn">
                                        <div class="image-box"><a href="{{ route('companies.show', $company?->slug) }}"><img
                                                    src="{{ asset($company?->logo) }}" alt="joblist"></a></div>
                                        <div class="info-text mt-10">
                                            <h5 class="font-bold"><a
                                                    href="{{ route('companies.show', $company?->slug) }}">{{ $company?->name }}</a>
                                            </h5>
                                            <span
                                                class="card-location">{{ formatLocation($company->companyCountry->name, $company->companyState->name) }}</span>
                                            <div class="mt-30"><a class="btn btn-grey-big"
                                                    href="{{ route('companies.show', $company->slug) }}"><span>{{ $company->jobs_count }}</span><span>
                                                        Jobs
                                                        Open</span></a></div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-lg-12">
                                    <div class="alert alert-warning" role="alert">
                                        <h5>
                                            No companies found with the given criteria
                                        </h5>
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>

                    <div class="paginations mt-60">
                        <ul class="pager">
                            @if ($companies->hasPages())
                                {{ $companies->withQueryString()->links() }}
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


                            <form action="{{ route('companies.index') }}" method="GET">
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

                            <form action="{{ route('companies.index') }}" method="GET">
                                <div class="filter-block mb-20">
                                    <h5 class="medium-heading mb-15">Industry</h5>
                                    <div class="form-group">
                                        <ul class="list-checkbox">
                                            <li>
                                                <input @checked(request()?->industry == '') type="radio" name="industry"
                                                    value="" class="text-small org-active">All
                                            </li>
                                            @foreach ($industryTypes as $type)
                                                <li>
                                                    <label class="">
                                                        <input @checked($type->slug == request()?->industry) type="radio" name="industry"
                                                            value="{{ $type->slug }}"
                                                            class="text-small {{ request()?->industry == $type->slug ? 'industry-active' : '' }} ind-active">{{ $type->name }}
                                                    </label><span class="number-item">{{ $type->companies_count }}</span>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>

                                <div class="filter-block mb-20">
                                    <h5 class="medium-heading mb-15">Organization</h5>
                                    <div class="form-group">
                                        <ul class="list-checkbox">
                                            <li>
                                                <input @checked(request()?->organization == '') type="radio" name="organization"
                                                    value="" class="text-small org-active">All
                                            </li>
                                            @foreach ($organizationTypes as $type)
                                                <li>
                                                    <label class="">
                                                        <input @checked($type->slug == request()?->organization) type="radio"
                                                            name="organization" value="{{ $type->slug }}"
                                                            class="text-small {{ request()?->organization == $type->slug ? 'industry-active' : '' }} org-active">{{ $type->name }}
                                                    </label><span class="number-item">{{ $type->companies_count }}</span>
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
                })
            })
        })
    </script>
@endpush

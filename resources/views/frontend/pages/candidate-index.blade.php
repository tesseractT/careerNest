@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Candidates</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Candidates</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="content-page">

                <div class="row">
                    <div class="col-lg-3">
                        <div class="sidebar-shadow none-shadow mb-30">
                            <div class="sidebar-filters">
                                <form action="{{ route('candidates.index') }}" method="GET">
                                    <div class="filter-block mb-30">
                                        <div class="filter-block head-border mb-30">
                                            <h5>Advance Filter <a class="link-reset" href="#">Reset</a></h5>
                                        </div>
                                        <div class="filter-block mb-30">
                                            <div class="form-group select-style">
                                                <label class="font-sm">Skills</label>
                                                <select name="skills[]" multiple
                                                    class="form-control form-icons select-active">
                                                    <option value="">All</option>
                                                    @foreach ($skills as $skill)
                                                        <option @selected(request()->has('skills') ? in_array($skill->slug, request()->skills) : false) value="{{ $skill->slug }}">
                                                            {{ $skill->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="filter-block mb-20">
                                        <h5 class="medium-heading mb-15">Experiences</h5>
                                        <div class="form-group">
                                            <ul class="list-checkbox">
                                                <li>
                                                    <input @checked(request()?->experience == '') type="radio" name="experience"
                                                        value="" class="text-small org-active">All

                                                </li>
                                                @foreach ($experiences as $experience)
                                                    <li>
                                                        <input type="radio" name="experience" @checked(request()?->experience == $experience->id)
                                                            value="{{ $experience->id }}" <span
                                                            class="text-small ind-active">{{ $experience->name }}</span>
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
                    <div class="col-xl-9">
                        <div class="row">
                            @forelse ($candidates as $candidate)
                                <div class="col-lg-4 col-md-6">
                                    <div class="card-grid-2 hover-up">
                                        <div class="card-grid-2-image-left d-flex">
                                            <div class="card-grid-2-image-rd online"><a
                                                    href="{{ route('candidates.show', $candidate->slug) }}">
                                                    <figure><img alt="careernest" src="{{ asset($candidate->image) }}">
                                                    </figure>
                                                </a></div>
                                            <div class="card-profile pt-10">
                                                <a href="{{ route('candidates.show', $candidate->slug) }}">
                                                    <h5>{{ $candidate->full_name }}</h5>
                                                </a>
                                                <span class="font-xs color-text-mutted">{{ $candidate->title }}</span>
                                                @if ($candidate->status === 'available')
                                                    <p class="font-xs color-text-paragraph-2" style="color: #1ca774"><b
                                                            style="font-weight: 1000">Open
                                                            For
                                                            Work</b></p>
                                                @else
                                                    <p class="font-xs color-text-paragraph-2" style="color: tomato"><b
                                                            style="font-weight: 1000">Not
                                                            Available</b></p>
                                                @endif


                                            </div>
                                        </div>
                                        <div class="card-block-info">

                                            <div class="card-2-bottom card-2-bottom-candidate mt-30">
                                                <div class="text-start">
                                                    @foreach ($candidate->skill as $candidateSkill)
                                                        @if ($loop->index <= 3)
                                                            <a class="btn btn-tags-sm mb-10 mr-5"
                                                                href="jobs-grid.html">{{ $candidateSkill->skills->name }}</a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="employers-info align-items-center justify-content-center mt-15">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <span class="d-flex align-items-center"><i
                                                                class="fi-rr-marker mr-5 ml-0"></i>
                                                            <span
                                                                class="font-sm color-text-mutted">{{ $candidate->companyCountry->name }}
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class="col-3">
                                                        <span class="d-flex justify-content-end align-items-center">
                                                            <span class="font-sm">
                                                                <a href="{{ route('candidates.show', $candidate->slug) }}"
                                                                    style="color: #1ca774"
                                                                    class="link-reset d-flex align-items-center"
                                                                    target="_blank" rel="noopener noreferrer">
                                                                    <i class="fi-rr-link mr-5"></i>
                                                                    Resume
                                                                </a>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-warning">No candidate found</div>
                                </div>
                            @endforelse

                            <div class="col-12">
                                <div class="paginations">
                                    <ul class="pager">
                                        @if ($candidates->hasPages())
                                            {{ $candidates->withQueryString()->links() }}
                                        @endif
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

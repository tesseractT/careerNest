@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Plans & Prices</h1>
        </div>
        <div class="text-right">
            <a href="{{ route('admin.plans.create') }}" class="btn btn-primary mb-5">
                <i class="fas fa-plus"></i>
                Create New</a>
        </div>
        <div class="section-body">
            <div class="row">
                @foreach ($plans as $plan)
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="pricing">
                            @if ($plan->recommended)
                                <div class="pricing-title">
                                    Recommended
                                </div>
                            @endif

                            <div class="pricing-padding">
                                <div>
                                    <h4>
                                        {{ $plan->label }}
                                    </h4>
                                </div>
                                <div class="pricing-price">
                                    <div>${{ $plan->price }}</div>
                                </div>
                                <div class="pricing-details">
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">{{ $plan->job_limit }} Job Post Limit</div>
                                    </div>
                                    <div class="pricing-item">
                                        @if ($plan->featured_job_limit === 0)
                                            <div class="pricing-item-icon bg-danger text-white"><i class="fas fa-times"></i>
                                            </div>
                                        @else
                                            <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        @endif
                                        <div class="pricing-item-label">{{ $plan->featured_job_limit }} Featured Job
                                            Post Limit</div>
                                    </div>
                                    <div class="pricing-item">
                                        @if ($plan->highlight_job_limit === 0)
                                            <div class="pricing-item-icon bg-danger text-white"><i class="fas fa-times"></i>
                                            </div>
                                        @else
                                            <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        @endif
                                        <div class="pricing-item-label">{{ $plan->highlight_job_limit }} Highlighted Job
                                            Post</div>
                                    </div>
                                    <div class="pricing-item">
                                        @if ($plan->profile_verified === 0)
                                            <div class="pricing-item-icon bg-danger text-white"><i class="fas fa-times"></i>
                                            </div>
                                        @else
                                            <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        @endif
                                        <div class="pricing-item-label">Profile Verification</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pricing-cta" style="display: flex; justify-content: space-between; width: 100%">
                                <a href="{{ route('admin.plans.edit', $plan->id) }}"
                                    class="w-100 bg-primary text-light">Edit <i class="fas fa-pen"></i></a>
                                <a href="{{ route('admin.plans.destroy', $plan->id) }}"
                                    class="w-100 bg-danger text-light delete-item">Delete <i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
@endsection

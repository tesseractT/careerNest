@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Check Out</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="index.html">Home</a></li>
                            <li>Check Out</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-90">
        <div class="container">

            <div class="max-width-price">
                <div class="block-pricing mt-70">
                    <div class="row">
                        <div class="col-md-8 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                            <h5 class="">Choose Your Payment Method</h5>
                            <div class="row pt-40">
                                <div class="col-md-3">
                                    <a href="{{ route('company.paypal.payment') }}"><img class=""
                                            style="width: 200px;border-radius: 5px;border: 3px solid #1ca774; height: 100px; object-fit: contain;"
                                            src="{{ asset('default-uploads/paypal.png') }}" alt=""></a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('company.stripe.payment') }}"><img class=""
                                            style="width: 200px;border-radius: 5px;border: 3px solid #1ca774; height: 100px; object-fit: contain;"
                                            src="{{ asset('default-uploads/stripe.png') }}" alt=""></a>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                            <div class="box-pricing-item">
                                <h3>{{ $plan->label }}</h3>
                                <div class="box-info-price"><span
                                        class="text-price color-brand-2">${{ $plan->price }}</span></div>
                                <ul class="list-package-feature">
                                    <li>{{ $plan->job_limit }} Job Limit</li>
                                    <li>{{ $plan->featured_job_limit }} Featured Job Limit</li>
                                    <li>{{ $plan->highlight_job_limit }} Highlighted Job Limit</li>

                                    @if ($plan->profile_verified)
                                        <li>Verified Profile</li>
                                    @else
                                        <li><strike>Verified Profile</strike></li>
                                    @endif
                                </ul>
                                <div><a class="btn btn-border" href="{{ route('pricing.checkout', $plan->id) }}">Choose
                                        plan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

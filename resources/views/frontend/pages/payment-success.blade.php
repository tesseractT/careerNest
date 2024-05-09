@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Payment Successful</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-90">
        <div class="container">
            <div style="text-align: center; margin-bottom: 100px;">
                <div class="block-pricing mt-70">
                    <div class="row">
                        <div class="col-md-12 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                            <i class="fas fa-check-circle" style="font-size: 100px; color:green;"></i>
                            <h5 class="">Payment Successful</h5>
                            <div class="row pt-40">
                                <div class="col-md-12">
                                    <div class="alert alert-success" role="alert">
                                        <h4 class="alert-heading">Thank you for your payment!</h4>
                                        <br>
                                        <p>Your payment has been successfully processed. You will receive an email shortly
                                            with
                                            your payment details.</p>
                                        <hr>
                                        <p class="mb-0">If you have any questions, please feel free to contact us.</p>
                                        <br>
                                        <a href="{{ route('company.dashboard') }}"
                                            class="btn btn-default btn-shadow hover-up">Go to Dashboard</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('frontend.layouts.master')
@section('contents')
    <!-- Hero Section -->
    @include('frontend.home.sections.hero-section')

    <div class="mt-100"></div>

    <!-- Category Section -->
    @include('frontend.home.sections.category-section')


    <!-- Featured Jobs Section -->
    @include('frontend.home.sections.featured-jobs-section')


    <!-- Why Choose Us Section -->
    @include('frontend.home.sections.why-choose-us-section')

    <!-- Learn More Section -->
    @include('frontend.home.sections.learn-more-section')


    <!-- Counter Section -->
    {{-- @include('frontend.home.sections.counter-section') --}}


    <!-- Recruiters Section -->
    {{-- @include('frontend.home.sections.recruiters-section') --}}


    <!-- Pricing Plan Section -->
    @include('frontend.home.sections.pricing-plan-section')

    <!-- Jobs by Location Section -->
    {{-- @include('frontend.home.sections.jobs-by-location-section') --}}

    <!-- Testimonials Section -->
    {{-- @include('frontend.home.sections.testimonials-section') --}}

    <!-- News And Blog Section -->
    {{-- @include('frontend.home.sections.news-and-blog-section') --}}
@endsection

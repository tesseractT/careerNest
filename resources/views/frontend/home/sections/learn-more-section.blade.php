<section class="section-box overflow-visible mt-100 mb-100">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6 col-sm-12">
                <div class="content-job-inner"><span class="color-text-mutted text-32">{{ $learn?->title }}
                    </span>
                    <h2 class="text-52 wow animate__animated animate__fadeInUp">{{ $learn?->main_title }}</h2>
                    <div class="mt-40 pr-50 text-md-lh28 wow animate__animated animate__fadeInUp">
                        <p>{{ $learn?->sub_title }}</p>
                    </div>
                    <div class="mt-40">
                        <div class="wow animate__animated animate__fadeInUp"><a class="btn btn-default"
                                href="jobs-grid.html">Search Jobs</a>
                            @if ($learn?->url)
                                <a class="btn btn-link" href="{{ $learn?->url }}">Learn More</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12">
                <div class="box-image-job">
                    <figure class="wow animate__animated animate__fadeIn">
                        <img style="height: 540px; width: 540px;" alt="joblist" src="{{ $learn?->image }}">
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>

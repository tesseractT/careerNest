<section class="section-box subscription_box">
    <div class="container">
        <div class="box-newsletter">
            <div class="newsletter_textarea">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="text-md-newsletter">Subscribe to our newsletter</h2>
                    </div>
                    <div class="col-lg-6">
                        <div class="box-form-newsletter">
                            <form class="form-newsletter">
                                @csrf
                                <input class="input-newsletter" type="text" value=""
                                    placeholder="Enter your email here" name="email">
                                <button type="submit" class="btn btn-default font-heading">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer pt-165">
    <div class="container">
        <div class="row justify-content-between">
            <div class="footer-col-1 col-md-3 col-sm-12">
                @php
                    $footer = \App\Models\Footer::first();
                    $socialIcons = \App\Models\SocialIcon::all();
                @endphp
                <a class="footer_logo" href="{{ url('/') }}">
                    <img alt="joblist" src="{{ asset($footer?->logo) }}">
                </a>
                <div class="mt-20 mb-20 font-xs color-text-paragraph-2">{!! $footer?->details !!}</div>
                <div class="footer-social">
                    @foreach ($socialIcons as $icon)
                        <a class="icon-socials icon-facebook" href="{{ $icon->url }}"><i
                                class="{{ $icon->icon }}"></i></a>
                    @endforeach

                </div>
            </div>
            @php
                $footerOne = \Menu::getByName('Footer Menu One');
            @endphp
            <div class="footer-col-2 col-md-2 col-xs-6">
                <h6 class="mb-20">Resources</h6>
                <ul class="menu-footer">
                    @foreach ($footerOne as $menu)
                        <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            @php
                $footerTwo = \Menu::getByName('Footer Menu Two');
            @endphp
            <div class="footer-col-3 col-md-2 col-xs-6">
                <h6 class="mb-20">Community</h6>
                <ul class="menu-footer">
                    @foreach ($footerTwo as $menu)
                        <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            @php
                $footerThree = \Menu::getByName('Footer Menu Three');
            @endphp
            <div class="footer-col-4 col-md-2 col-xs-6">
                <h6 class="mb-20">Quick links</h6>
                <ul class="menu-footer">
                    @foreach ($footerThree as $menu)
                        <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            @php
                $footerFour = \Menu::getByName('Footer Menu Four');
            @endphp
            <div class="footer-col-5 col-md-2 col-xs-6">
                <h6 class="mb-20">More</h6>
                <ul class="menu-footer">
                    @foreach ($footerFour as $menu)
                        <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="footer-bottom mt-50">
            <div class="row">
                <div class="col-md-6"><span class="font-xs color-text-paragraph">Copyright &copy; {{ date('Y') }}
                        {{ $footer->copy_right }}</span></div>
            </div>
        </div>
    </div>
</footer>


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.form-newsletter').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    method: 'POST',
                    url: '{{ route('subscribe') }}',
                    data: formData,
                    beforeSend: function() {
                        $('.form-newsletter button').html('Subscribing...');
                        $('.form-newsletter button').attr('disabled', true);
                    },
                    success: function(response) {
                        $('.form-newsletter button').html('Subscribe');
                        $('.form-newsletter button').attr('disabled', false);
                        $('.form-newsletter')[0].reset();
                        notyf.success(response.message);
                    },

                    error: function(xhr, status, error) {
                        $('.form-newsletter button').html('Subscribe');
                        $('.form-newsletter button').attr('disabled', false);
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            notyf.error(value[0]);
                        });
                    }
                })
            })
        })
    </script>
@endpush

@extends('frontend.layouts.master')
@section('contents')
    <section class="pt-120 login-register">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-12 mx-auto">
                    <div class="login-register-cover">
                        <div class="text-center">
                            <h2 class="mb-5 text-brand-1">Login</h2>
                            <p class="font-sm text-muted mb-30">Please enter your login details</p>
                        </div>
                        <form class="login-register text-start mt-20" form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <div class="row">
                                <div class="col-xl-12">

                                    <!-- Email Address -->
                                    <div class="form-group">
                                        <label class="form-label" for="input-3">Email *</label>
                                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            id="input-3" type="text" required="" name="email"
                                            placeholder="stevenjob@gmail.com" value{{ old('email') }}>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">

                                    <!-- Password -->
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="input-4">Password *</label>
                                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                                        </div>
                                        <input class="form-control  {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                            id="input-4" type="password" required="" name="password"
                                            placeholder="************">
                                        <input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="form-check form-group form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="remember"
                                            style="margin-right: 10px">
                                        <label class="form-check-label" for="typeCandidate">Remember me</label>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <button class="btn btn-default hover-up w-100" type="submit" name="login">Login</button>
                            </div>
                            <div class="text-muted text-center">Don't have an account?
                                <a href="{{ route('register') }}">Register</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="mt-120"></div>
@endsection

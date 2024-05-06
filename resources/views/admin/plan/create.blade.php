@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Plans & Prices</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Plans & Prices</h4>


                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.plans.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="plans">Label</label>
                                        <input type="text" class="form-control {{ hasError($errors, 'label') }}"
                                            name="label" value="{{ old('label') }}">
                                        <x-input-error :messages="$errors->get('label')" class="mt-2" />

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="plans">Price</label>
                                        <input type="text" class="form-control {{ hasError($errors, 'price') }}"
                                            name="price" value="{{ old('price') }}">
                                        <x-input-error :messages="$errors->get('price')" class="mt-2" />

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="job_limit">Job Limit</label>
                                        <input type="text" class="form-control {{ hasError($errors, 'job_limit') }}"
                                            name="job_limit" value="{{ old('job_limit') }}">
                                        <x-input-error :messages="$errors->get('job_limit')" class="mt-2" />

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="featured_job_limit">Featured Job Limit</label>
                                        <input type="text"
                                            class="form-control {{ hasError($errors, 'featured_job_limit') }}"
                                            name="featured_job_limit" value="{{ old('featured_job_limit') }}">
                                        <x-input-error :messages="$errors->get('featured_job_limit')" class="mt-2" />

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="highlight_job_limit">Highlight Job Limit</label>
                                        <input type="text"
                                            class="form-control {{ hasError($errors, 'highlight_job_limit') }}"
                                            name="highlight_job_limit" value="{{ old('highlight_job_limit') }}">
                                        <x-input-error :messages="$errors->get('highlight_job_limit')" class="mt-2" />

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="recommended">Recommended</label>
                                        <select name="recommended"
                                            class="form-control {{ hasError($errors, 'recommended') }}">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('recommended')" class="mt-2" />

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="profile_verified">Profile Verified</label>
                                        <select name="profile_verified"
                                            class="form-control {{ hasError($errors, 'profile_verified') }}">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="frontend_show">Show in Frontend</label>
                                        <select name="frontend_show"
                                            class="form-control {{ hasError($errors, 'frontend_show') }}">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="show_at_home">Show in Home</label>
                                        <select name="show_at_home"
                                            class="form-control {{ hasError($errors, 'show_at_home') }}">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary">Create</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

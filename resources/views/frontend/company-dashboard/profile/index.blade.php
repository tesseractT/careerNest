@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Blog</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="index.html">Home</a></li>
                            <li>Blog</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="row">
                @include('frontend.company-dashboard.sidebar')
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Company Info</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Establishment Info</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">Account Settings</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="row">
                                <form action="">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Logo *</label>
                                            <input class="form-control" type="file" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Banner *</label>
                                            <input class="form-control" type="file" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Company Name *</label>
                                            <input class="form-control" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Company Bio *</label>
                                            <textarea class="form-control summernote"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Company Vision *</label>
                                            <textarea class="form-control summernote"></textarea>
                                        </div>
                                    </div>
                                    <div class="box-button mt-15">
                                        <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <form action="">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10">Industry Type *</label>
                                            <select class="form-control form-icons select-active">
                                                <option value="">Select Industry Type</option>
                                                <option value="">IT</option>
                                                <option value="">Banking</option>
                                                <option value="">Health</option>
                                                <option value="">Education</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10">Organization Type *</label>
                                            <select class="form-control form-icons select-active">
                                                <option value="">Select Industry Type</option>
                                                <option value="">IT</option>
                                                <option value="">Banking</option>
                                                <option value="">Health</option>
                                                <option value="">Education</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10">Team Size *</label>
                                            <select class="form-control form-icons select-active">
                                                <option value="">Select Industry Type</option>
                                                <option value="">IT</option>
                                                <option value="">Banking</option>
                                                <option value="">Health</option>
                                                <option value="">Education</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Establishment Date </label>
                                            <input class="form-control datepicker" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Website Link </label>
                                            <input class="form-control" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Email * </label>
                                            <input class="form-control" type="email" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Phone * </label>
                                            <input class="form-control" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10">Country * </label>
                                            <select class="form-control form-icons select-active">
                                                <option value="">Select Country</option>
                                                <option value="">Bangladesh</option>
                                                <option value="">India</option>
                                                <option value="">Pakistan</option>
                                                <option value="">Srilanka</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10">State </label>
                                            <select class="form-control form-icons select-active">
                                                <option value="">Select State</option>
                                                <option value="">Dhaka</option>
                                                <option value="">Chittagong</option>
                                                <option value="">Khulna</option>
                                                <option value="">Rajshahi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10">City </label>
                                            <select class="form-control form-icons select-active">
                                                <option value="">Select City</option>
                                                <option value="">Dhaka</option>
                                                <option value="">Chittagong</option>
                                                <option value="">Khulna</option>
                                                <option value="">Rajshahi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Address </label>
                                            <input class="form-control" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Map Link </label>
                                            <input class="form-control" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="box-button mt-15">
                                        <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">User Name * </label>
                                        <input class="form-control" type="text" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Email * </label>
                                        <input class="form-control" type="text" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-apply">Save</button>
                                </div>
                                <br>
                                <br>
                                <br>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Password * </label>
                                        <input class="form-control" type="text" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Confirm Password * </label>
                                        <input class="form-control" type="text" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-apply">Save</button>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

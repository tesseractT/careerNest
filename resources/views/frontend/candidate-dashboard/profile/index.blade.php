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
                @include('frontend.candidate-dashboard.sidebar')
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Basic</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Profile</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-experience-education" type="button" role="tab"
                                aria-controls="pills-experience-education" aria-selected="false">Experience &
                                Education</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">Account Settings</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">

                        {{-- Basic Section --}}
                        @include('frontend.candidate-dashboard.profile.sections.basic-section')

                        {{-- Profile Section --}}
                        @include('frontend.candidate-dashboard.profile.sections.profile-section')

                        {{-- Experience & Education Section --}}
                        @include('frontend.candidate-dashboard.profile.sections.experience-education-section')
                        {{-- <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">
                            <form action="{{ route('company.profile.account-info') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">User Name * </label>
                                            <input
                                                class="form-control
                                                {{ $errors->has('name') ? 'is-invalid' : '' }}
                                            "
                                                type="text" value="{{ auth()->user()->name }}" name="name">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Email * </label>
                                            <input
                                                class="form-control
                                            {{ $errors->has('email') ? 'is-invalid' : '' }}
                                            "
                                                type="text" value="{{ auth()->user()->email }}" name="email">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-apply">Save</button>
                                    </div>

                                </div>
                            </form>
                            <form action="{{ route('company.profile.password-update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Password * </label>
                                            <input
                                                class="form-control
                                            {{ $errors->has('password') ? 'is-invalid' : '' }}
                                            "
                                                type="password" value="" name="password">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Confirm Password * </label>
                                            <input
                                                class="form-control
                                            {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}
                                            "
                                                type="password" value="" name="password_confirmation">
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-apply">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Modal -->
    <div>
        <div class="modal fade" id="experienceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Experience</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="experienceForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Company * </label>
                                        <input class="form-control" type="text" value="" required name="company">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Department * </label>
                                        <input class="form-control" type="text" value="" required
                                            name="department">
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Designation * </label>
                                        <input class="form-control" type="text" value="" required
                                            name="designation">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Start Date * </label>
                                        <input class="form-control datepicker" required type="text" value=""
                                            name="start_date">

                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">End Date * </label>
                                        <input class="form-control datepicker" required type="text" value=""
                                            name="end_date">

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check form-group form-check-inline">
                                        <label class="font-check-label">Currently Employed</label>
                                        <input class="form-check-input" value="1" type="checkbox"
                                            style="margin-right:10px" value="" name="currently_working">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Responsibilities * </label>
                                        <textarea class="form-control" maxlength="500" name="responsibilities" id="" cols="30"
                                            rows="10"></textarea>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save
                                        Experience</button>
                                </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Education Modal -->
    <div>
        <div class="modal fade" id="educationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel2" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Education</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="educationForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Level * </label>
                                        <input class="form-control" type="text" value="" required
                                            name="level">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Degree * </label>
                                        <input class="form-control" type="text" value="" required
                                            name="degree">
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Year * </label>
                                        <input class="form-control yearpicker" type="text" value="" required
                                            name="year">

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Note * </label>
                                        <textarea class="form-control" maxlength="500" name="note" id="" cols="30" rows="30"></textarea>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save
                                        Education</button>
                                </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var editId = "";
        var editMode = false;

        // Fetch Experiences
        function fetchExperiences() {
            $.ajax({
                method: 'GET',
                url: "{{ route('candidate.experience.index') }}",
                success: function(response) {
                    $('.experience-tbody').html(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        }

        // Save Experience Form
        $('#experienceForm').on('submit', function(event) {
            event.preventDefault();
            const formData = $(this).serialize();

            if (editMode) {
                $.ajax({
                    method: 'PUT',
                    url: "{{ route('candidate.experience.update', ':id') }}".replace(':id',
                        editId),
                    data: formData,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        fetchExperiences();
                        $('#experienceForm').trigger('reset');
                        $('#experienceModal').modal('hide');
                        editId = "";
                        editMode = false;
                        hideLoader();
                        notyf.success(response.message);

                    },
                    error: function(xhr, status, error) {
                        const errors = xhr.responseJSON.errors;
                        if (errors) {
                            for (const key in errors) {

                                notyf.error(errors[key][0]);
                            }

                        }
                        hideLoader();
                    }
                })
            } else {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('candidate.experience.store') }}",
                    data: formData,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        fetchExperiences();
                        $('#experienceForm').trigger('reset');
                        $('#experienceModal').modal('hide');
                        hideLoader();
                        notyf.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        const errors = xhr.responseJSON.errors;
                        if (errors) {
                            for (const key in errors) {
                                notyf.error(errors[key][0]);
                            }
                        }
                        hideLoader();
                    }
                })
            }


        })

        // Edit Experience Form
        $('body').on('click', '.edit-experience', function(event) {
            $('#experienceForm').trigger('reset');
            let url = $(this).attr('href');

            $.ajax({
                method: 'GET',
                url: url,
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    editMode = true;
                    editId = response.id;
                    $.each(response, function(index, value) {
                        $(`input[name="${index}"]:text`).val(value);
                        if (index === 'currently_working' && value == 1) {
                            $(`input[name="${index}"]:checkbox`).prop('checked',
                                true);
                        }
                        if (index === 'responsibilities') {
                            $(`textarea[name="${index}"]`).val(value);
                        }
                    })
                    hideLoader();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    hideLoader();
                }
            })
        })

        // Delete Experience
        $('body').on('click', '.delete-experience', function(event) {
            event.preventDefault();
            let url = $(this).attr('href');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: 'DELETE',
                        url: url,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        beforeSend: function() {
                            showLoader();
                        },
                        success: function(response) {
                            notyf.success(response.message);
                            fetchExperiences();
                            hideLoader();
                            // window.location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr);
                            notyf.error(xhr.responseJSON.message);
                            hideLoader();
                        }
                    })
                }
            });
        })





        // Fetch Education
        function fetchEducation() {
            $.ajax({
                method: 'GET',
                url: "{{ route('candidate.education.index') }}",
                success: function(response) {
                    $('.education-tbody').html(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        }

        // Save Education Form
        $('#educationForm').on('submit', function(event) {
            event.preventDefault();
            const formData = $(this).serialize();

            if (editMode) {
                $.ajax({
                    method: 'PUT',
                    url: "{{ route('candidate.education.update', ':id') }}".replace(':id',
                        editId),
                    data: formData,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        fetchEducation();
                        $('#educationForm').trigger('reset');
                        $('#educationModal').modal('hide');
                        editId = "";
                        editMode = false;
                        hideLoader();
                        notyf.success(response.message);

                    },
                    error: function(xhr, status, error) {
                        const errors = xhr.responseJSON.errors;
                        if (errors) {
                            for (const key in errors) {

                                notyf.error(errors[key][0]);
                            }

                        }
                        hideLoader();
                    }
                })
            } else {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('candidate.education.store') }}",
                    data: formData,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        fetchEducation();
                        $('#educationForm').trigger('reset');
                        $('#educationModal').modal('hide');
                        hideLoader();
                        notyf.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        const errors = xhr.responseJSON.errors;
                        if (errors) {
                            for (const key in errors) {
                                notyf.error(errors[key][0]);
                            }
                        }
                        hideLoader();
                    }
                })
            }


        })

        // Edit Education Form
        $('body').on('click', '.edit-education', function(event) {
            $('#educationForm').trigger('reset');
            let url = $(this).attr('href');

            $.ajax({
                method: 'GET',
                url: url,
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    editMode = true;
                    editId = response.id;
                    $.each(response, function(index, value) {
                        $(`input[name="${index}"]:text`).val(value);
                        if (index === 'note') {
                            $(`textarea[name="${index}"]`).val(value);
                        }
                    })
                    hideLoader();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    hideLoader();
                }
            })
        })

        // Delete Education
        $('body').on('click', '.delete-education', function(event) {
            event.preventDefault();
            let url = $(this).attr('href');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: 'DELETE',
                        url: url,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        beforeSend: function() {
                            showLoader();
                        },
                        success: function(response) {
                            notyf.success(response.message);
                            fetchEducation();
                            hideLoader();
                            // window.location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr);
                            notyf.error(xhr.responseJSON.message);
                            hideLoader();
                        }
                    })
                }
            });
        })
    </script>
@endpush

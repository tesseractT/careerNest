@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1> Update Job : {{ $job->title }}</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card-body">
                    <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- Job Details --}}
                        <div class="card">

                            <div class="card-header">
                                Job Details
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="industry_type">Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control {{ hasError($errors, 'title') }}"
                                                name="title" value="{{ old('title', $job->title) }}">
                                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Company <span class="text-danger">*</span></label>
                                            <select name="company" id=""
                                                class="form-control select2 {{ hasError($errors, 'company') }}">
                                                <option value="">Select Company</option>
                                                @foreach ($companies as $company)
                                                    <option @selected($company->id === $job->company_id) value="{{ $company->id }}">
                                                        {{ $company->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('company')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Category <span class="text-danger">*</span></label>
                                            <select name="category" id=""
                                                class="form-control select2   {{ hasError($errors, 'category') }}">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option @selected($category->id === $job->job_category_id) value="{{ $category->id }}">
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Total Vacancies <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control {{ hasError($errors, 'vacancies') }}"
                                                name="vacancies" value="{{ old('vacancies', $job->vacancies) }}">
                                            <x-input-error :messages="$errors->get('vacancies')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Deadline <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control datepicker {{ hasError($errors, 'deadline') }}"
                                                name="deadline" value="{{ old('deadline', $job->deadline) }}">
                                            <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        {{-- Location --}}
                        <div class="card">

                            <div class="card-header">
                                Location
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Country</label>
                                            <select name="country" id=""
                                                class="form-control select2 country {{ hasError($errors, 'country') }}">
                                                <option value="">Select Country</option>
                                                @foreach ($countries as $country)
                                                    <option @selected($country->id === $job->country_id) value="{{ $country->id }}">
                                                        {{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">State</label>
                                            <select name="state" id=""
                                                class="form-control select2 state {{ hasError($errors, 'state') }}">
                                                <option value="">Select State</option>
                                                @foreach ($states as $state)
                                                    <option @selected($state->id === $job->state_id) value="{{ $state->id }}">
                                                        {{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">City</label>
                                            <select name="city" id=""
                                                class="form-control select2 city {{ hasError($errors, 'city') }}">
                                                <option value="">Select City</option>
                                                @foreach ($cities as $city)
                                                    <option @selected($city->id === $job->city_id) value="{{ $city->id }}">
                                                        {{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('city')" class="mt-2" />

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="industry_type">Address</label>
                                            <input type="text" class="form-control {{ hasError($errors, 'address') }}"
                                                name="address" value="{{ old('address', $job->address) }}">
                                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Salary Information --}}
                        <div class="card">

                            <div class="card-header">
                                Salaray Information
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input @checked($job->salary_mode === 'range')
                                                        onclick="salaryModeChange('salary_range')" type="radio"
                                                        id="salary_range" value="range"
                                                        class="{{ hasError($errors, 'salary_mode') }}"
                                                        name="salary_mode">
                                                    <label for="salary_range">Salary Range</label>
                                                    <x-input-error :messages="$errors->get('salary_mode')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input @checked($job->salary_mode === 'custom')
                                                        onclick="salaryModeChange('custom_salary')" type="radio"
                                                        id="custom_salary" value="custom"
                                                        class="{{ hasError($errors, 'salary_mode') }}"
                                                        name="salary_mode">
                                                    <label for="custom_salary">Custom Salary</label>
                                                    <x-input-error :messages="$errors->get('salary_mode')" class="mt-2" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12 salary_range_part">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="industry_type">Minimum Salary <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control {{ hasError($errors, 'min_salary') }}"
                                                        name="min_salary"
                                                        value="{{ old('min_salary', $job->min_salary) }}">
                                                    <x-input-error :messages="$errors->get('min_salary')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="industry_type">Maximum Salary <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control {{ hasError($errors, 'max_salary') }}"
                                                        name="max_salary"
                                                        value="{{ old('max_salary', $job->max_salary) }}">
                                                    <x-input-error :messages="$errors->get('max_salary')" class="mt-2" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 custom_salary_part d-none">
                                        <div class="form-group">
                                            <label for="industry_type">Custom Salary <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control {{ hasError($errors, 'custom_salary') }}"
                                                name="custom_salary"
                                                value="{{ old('custom_salary', $job->custom_salary) }}">
                                            <x-input-error :messages="$errors->get('custom_salary')" class="mt-2" />
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Salary Type <span class="text-danger">*</span> </label>
                                            <select name="salary_type" id=""
                                                class="form-control select2 {{ hasError($errors, 'salary_type') }}">
                                                <option value="">Select Salary Type</option>
                                                @foreach ($salaryTypes as $salaryType)
                                                    <option @selected($job->salary_type_id === $salaryType->id) value="{{ $salaryType->id }}">
                                                        {{ $salaryType->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('salary_type')" class="mt-2" />

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        {{-- Job Attributes --}}
                        <div class="card">


                            <div class="card-header">
                                Job Attributes
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Experience <span class="text-danger">*</span></label>
                                            <select name="experience" id=""
                                                class="form-control select2 {{ hasError($errors, 'experience') }}">
                                                <option value="">Select Experience</option>
                                                @foreach ($experiences as $experience)
                                                    <option @selected($experience->id === $job->job_experience_id) value="{{ $experience->id }}">
                                                        {{ $experience->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('experience')" class="mt-2" />

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Job Role <span class="text-danger">*</span></label>
                                            <select name="job_role" id=""
                                                class="form-control select2 {{ hasError($errors, 'job_role') }}">
                                                <option value="">Select Job Role</option>
                                                @foreach ($jobRoles as $jobRole)
                                                    <option @selected($jobRole->id === $job->job_role_id) value="{{ $jobRole->id }}">
                                                        {{ $jobRole->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('job_role')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Education <span class="text-danger">*</span></label>
                                            <select name="education" id=""
                                                class="form-control select2 {{ hasError($errors, 'education') }}">
                                                <option value="">Select Education</option>
                                                @foreach ($educations as $education)
                                                    <option @selected($education->id === $job->education_id) value="{{ $education->id }}">
                                                        {{ $education->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('education')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""> Job Type <span class="text-danger">*</span></label>
                                            <select name="job_type" id=""
                                                class="form-control select2 {{ hasError($errors, 'job_type') }}">
                                                <option value="">Select Job Type</option>
                                                @foreach ($jobTypes as $jobType)
                                                    <option @selected($jobType->id === $job->job_type_id) value="{{ $jobType->id }}">
                                                        {{ $jobType->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('job_type')" class="mt-2" />
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for=""> Tags <span class="text-danger">*</span></label>
                                            <select name="tags[]" id=""
                                                class="form-control select2 {{ hasError($errors, 'tags') }}" multiple>
                                                @php
                                                    $selectedTags = $job->tags()->pluck('tag_id')->toArray();
                                                @endphp
                                                <option value="">Select Tags</option>
                                                @foreach ($tags as $tag)
                                                    <option @selected(in_array($tag->id, $selectedTags)) value="{{ $tag->id }}">
                                                        {{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                                        </div>
                                    </div>
                                    @php
                                        $benefits = $job->benefits()->with('benefit')->get();
                                        $benefitNames = [];
                                        foreach ($benefits as $benefit) {
                                            $benefitNames[] = $benefit->benefit->name;
                                        }
                                        $benefitNameString = implode(',', $benefitNames);
                                    @endphp
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for=""> Benefits <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control inputtags {{ hasError($errors, 'benefits') }}"
                                                name="benefits" value="{{ old('benefits', $benefitNameString) }}">
                                            <x-input-error :messages="$errors->get('benefits')" class="mt-2" />


                                        </div>
                                    </div>
                                    @php
                                        $selectedSkills = $job->skills()->pluck('skill_id')->toArray();
                                    @endphp
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for=""> Skills <span class="text-danger">*</span></label>
                                            <select name="skills[]" id=""
                                                class="form-control select2 {{ hasError($errors, 'skills') }}" multiple>
                                                <option value="">Select Skills</option>
                                                @foreach ($skills as $skill)
                                                    <option @selected(in_array($skill->id, $selectedSkills)) value="{{ $skill->id }}">
                                                        {{ $skill->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        {{-- Application Options --}}
                        <div class="card">

                            <div class="card-header">
                                Application Options
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="industry_type">Receive Application <span
                                                    class="text-danger">*</span></label>

                                            <select name="receive_application" id=""
                                                class="form-control select2 {{ hasError($errors, 'receive_application') }}">
                                                <option value="">Select Receive Application</option>
                                                <option @selected($job->apply_on === 'email') value="email">Email</option>
                                                <option @selected($job->apply_on === 'website') value="website">On Career Nest
                                                </option>
                                                <option @selected($job->apply_on === 'custom_url') value="custom_url">Custom Url
                                                </option>
                                            </select>
                                            <x-input-error :messages="$errors->get('receive_application')" class="mt-2" />

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        {{-- Promotion --}}
                        <div class="card">

                            <div class="card-header">
                                Promotion
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input @checked($job->featured) type="checkbox" id="featured"
                                                        class="{{ hasError($errors, 'featured') }}" value="1"
                                                        name="featured" checked>
                                                    <label for="featured">Featured</label>
                                                    <x-input-error :messages="$errors->get('featured')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input @checked($job->highlight) type="checkbox" id="highlight"
                                                        class="{{ hasError($errors, 'highlight') }}" value="1"
                                                        name="highlight">
                                                    <label for="highlight">Highlight</label>
                                                    <x-input-error :messages="$errors->get('highlight')" class="mt-2" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        {{-- Description --}}
                        <div class="card">

                            <div class="card-header">
                                Description
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Description <span class="text-danger">*</span></label>
                                            <textarea name="description" id="editor" class="form-control {{ hasError($errors, 'description') }}"
                                                value="{{ old('description') }}">{!! $job->description !!}</textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </div>

                                    </div>
                                </div>
                                <br>

                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(".inputtags").tagsinput('items');

        function salaryModeChange(mode) {
            if (mode == 'salary_range') {
                $('.salary_range_part').removeClass('d-none');
                $('.custom_salary_part').addClass('d-none');
            } else if (mode == 'custom_salary') {
                $('.salary_range_part').addClass('d-none');
                $('.custom_salary_part').removeClass('d-none');
            }
        }


        $('.country').on('change', function() {
            let country_id = $(this).val();
            //Remove all previous cities
            $('.city').html('<option value="">Select City</option>');
            $.ajax({
                method: 'GET',
                url: '{{ route('get-states', ':id') }}'.replace(":id", country_id),
                data: {},
                success: function(response) {
                    let html = '';
                    $.each(response, function(index, value) {
                        html +=
                            `<option value="${value.id}">${value.name}</option>`;
                    });

                    $('.state').html(html);
                },
                error: function(xhr, status, error) {

                }
            })
        })

        // Get City
        $('.state').on('change', function() {
            let state_id = $(this).val();

            $.ajax({
                method: 'GET',
                url: '{{ route('get-cities', ':id') }}'.replace(":id", state_id),
                data: {},
                success: function(response) {
                    let html = '';
                    $.each(response, function(index, value) {
                        html +=
                            `<option value="${value.id}">${value.name}</option>`;
                    });

                    $('.city').html(html);
                },
                error: function(xhr, status, error) {

                }
            })
        })
    </script>
@endpush

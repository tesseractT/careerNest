@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Job Category</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Job Category</h4>


                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.job-categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="industry_type">Icon</label>
                                <div role="iconpicker" data-align="left" name="icon"
                                    class="{{ hasError($errors, 'icon') }}"></div>
                                <x-input-error :messages="$errors->get('icon')" class="mt-2" />

                            </div>
                            <div class="form-group">
                                <label for="industry_type">Name</label>
                                <input type="text" class="form-control {{ hasError($errors, 'name') }}" name="name"
                                    value="{{ old('name') }}">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />

                            </div>
                            <div class="form-group">
                                <label for="">Is Popular</label>
                                <select name="is_popular" class="form-control {{ hasError($errors, 'is_popular') }}">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <x-input-error :messages="$errors->get('is_popular')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for=""> Is Featured</label>
                                <select name="is_featured" class="form-control {{ hasError($errors, 'is_featured') }}">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <x-input-error :messages="$errors->get('is_featured')" class="mt-2" />
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

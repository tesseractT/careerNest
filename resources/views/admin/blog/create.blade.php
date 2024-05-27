@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Blogs</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Blogs</h4>


                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" class="form-control {{ hasError($errors, 'image') }}" name="image">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control {{ hasError($errors, 'title') }}" name="title"
                                    value="{{ old('title') }}">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control {{ hasError($errors, 'description') }}" id="editor" cols="30"
                                    rows="10">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" class="form-control {{ hasError($errors, 'status') }}">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
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

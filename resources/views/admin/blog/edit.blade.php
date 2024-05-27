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
                        <h4>Update Blogs</h4>


                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Image</label>
                                <x-image-preview :height="200" :width="300" :src="$blog->image" />
                                <input type="file" class="form-control {{ hasError($errors, 'image') }}" name="image">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control {{ hasError($errors, 'title') }}" name="title"
                                    value="{{ old('title', $blog->title) }}">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control {{ hasError($errors, 'description') }}" id="editor" cols="30"
                                    rows="10">{!! $blog->description !!}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" class="form-control {{ hasError($errors, 'status') }}">
                                    <option @selected($blog->status === 1) value="1">Active</option>
                                    <option @selected($blog->status === 0) value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Is Featured</label>
                                <select name="is_featured" class="form-control {{ hasError($errors, 'is_featured') }}">
                                    <option @selected($blog->is_featured === 1) value="1">Yes</option>
                                    <option @selected($blog->is_featured === 0) value="0">No</option>
                                </select>


                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

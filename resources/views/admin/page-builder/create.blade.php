@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>PAge Builder</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Page</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.page-builder.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Page Name</label>
                                <input type="text" class="form-control {{ hasError($errors, 'page_name') }}"
                                    name="page_name" value="{{ old('page_name') }}">
                                <x-input-error :messages="$errors->get('page_name')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Page Content</label>
                                <textarea name="page_content" class="form-control {{ hasError($errors, 'page_content') }}" id="editor" cols="30"
                                    rows="10">{{ old('page_content') }}</textarea>
                                <x-input-error :messages="$errors->get('page_content')" class="mt-2" />
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

@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Footer Section</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Footer Section</h4>


                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.footer.update', 1) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Logo</label>
                                        <x-image-preview :height="200" :width="300" :src="$footer?->logo" />
                                        <input type="file" class="form-control {{ hasError($errors, 'logo') }}"
                                            name="logo">
                                        <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="">Copyright</label>
                                <input type="text" class="form-control {{ hasError($errors, 'copy_right') }}"
                                    value="{{ $footer?->copy_right }}" name="copy_right">
                                <x-input-error :messages="$errors->get('copy_right')" class="mt-2" />

                            </div>

                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control {{ hasError($errors, 'description') }}" id="" cols="30"
                                    rows="10">{{ $footer?->details }}</textarea>
                                <x-input-error :messages="$errors->get('details')" class="mt-2" />


                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

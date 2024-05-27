@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Hero Section</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Hero Section</h4>


                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.hero.update', 1) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Image</label>
                                        <x-image-preview :height="200" :width="300" :src="$hero?->image" />
                                        <input type="file" class="form-control {{ hasError($errors, 'image') }}"
                                            name="image">
                                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Backgroud Image</label>
                                        <x-image-preview :height="200" :width="300" :src="$hero?->background_image" />
                                        <input type="file"
                                            class="form-control {{ hasError($errors, 'background_image') }}"
                                            name="background_image">
                                        <x-input-error :messages="$errors->get('background_image')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control {{ hasError($errors, 'title') }}" name="title"
                                    value="{{ old('title', $hero->title) }}">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />

                            </div>
                            <div class="form-group">
                                <label for="">Sub Title</label>
                                <input type="text" class="form-control {{ hasError($errors, 'subtitle') }}"
                                    name="subtitle" value="{{ old('subtitle', $hero->subtitle) }}">
                                <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
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

@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Salary Type</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Salary Type</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.salary-types.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="industry_type">Name</label>
                                <input type="text" class="form-control {{ hasError($errors, 'name') }}" name="name"
                                    value="{{ old('name') }}">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
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

@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Job Catergories</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Job Catergories</h4>
                        <div class="card-header-form">
                            <form action="{{ route('admin.job-categories.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="search"
                                        value="{{ request('search') }}">
                                    <div class="input-group-btn">
                                        <button type="submit" style="height: 40px" class="btn btn-primary"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <a href="{{ route('admin.job-categories.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Create New</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Icon</th>
                                    <th>Name</th>
                                    <th>Is Popular</th>
                                    <th>Is Featured</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td>
                                                <i style="font-size: 40px" class="{{ $category->icon }}"></i>
                                            </td>
                                            <td>{{ $category->name }}</td>

                                            <td>
                                                @if ($category->is_popular)
                                                    <span class="badge badge-success">Yes</span>
                                                @else
                                                    <span class="badge badge-danger">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($category->is_featured)
                                                    <span class="badge badge-success">Yes</span>
                                                @else
                                                    <span class="badge badge-danger">No</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('admin.job-categories.edit', $category->id) }}"
                                                    class="btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin.job-categories.destroy', $category->id) }}"
                                                    class="btn-sm btn btn-danger delete-item"><i
                                                        class="fas fa-trash-alt "></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No data available</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            @if ($categories->hasPages())
                                {{ $categories->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

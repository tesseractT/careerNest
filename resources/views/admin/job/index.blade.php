@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Job Posts</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Jobs</h4>
                        <div class="card-header-form">
                            <form action="{{ route('admin.jobs.index') }}" method="GET">
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
                        <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Create New</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Job</th>
                                    <th>Role/Category</th>
                                    <th>Salary</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                                <tbody>
                                    @forelse ($jobs as $job)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="mr-1">
                                                        <img style="width:40px; height:40px; object-fit:cover"
                                                            src="{{ asset($job->company->logo) }}" alt="">
                                                    </div>
                                                    <div>
                                                        <b>
                                                            {{ $job->title }}
                                                        </b>
                                                        <br>
                                                        <span class="text-muted">
                                                            {{ $job->company->name }} - {{ $job->jobType->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <b>
                                                        {{ $job->jobRole->name }}
                                                    </b>
                                                    <br>
                                                    <span> {{ $job->category->name }}</span>
                                                </div>
                                            </td>

                                            <td>
                                                @if ($job->salary_mode === 'range')
                                                    <b> {{ $job->min_salary }} -
                                                        {{ $job->max_salary }} {{ config('settings.site_currency') }}</b>
                                                    <br>
                                                    <span class="text-muted"> {{ $job->salaryType->name }}</span>
                                                @else
                                                    <b> {{ $job->custom_salary }}</b>
                                                    <br>
                                                    <span class="text-muted"> {{ $job->salaryType->name }}</span>
                                                @endif
                                            </td>
                                            <td>{{ formatDate($job->deadline) }}</td>
                                            <td>
                                                @if ($job->deadline < date('Y-m-d'))
                                                    <span class="badge badge-danger">Expired</span>
                                                @else
                                                    <span class="badge badge-success">Active</span>
                                                @endif
                                            <td>
                                                <a href="{{ route('admin.jobs.edit', $job->id) }}"
                                                    class="btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin.jobs.destroy', $job->id) }}"
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
                            @if ($jobs->hasPages())
                                {{ $jobs->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Jobs</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>My Job Posts</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="row">
                @include('frontend.company-dashboard.sidebar')
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">

                    <div class="card">
                        <div class="card-header">
                            <h4>All Jobs</h4>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="card-header-form">
                                        <form action="{{ route('company.jobs.index') }}" method="GET">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search"
                                                    name="search" value="{{ request('search') }}">
                                                <div class="input-group-btn">
                                                    <button type="submit" style="height: 50px" class="btn btn-apply"><i
                                                            class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <a href="{{ route('company.jobs.create') }}" class="btn btn-apply">
                                        <i class="fas fa-plus"></i>
                                        Create New</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 270px">Job</th>
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
                                                            {{ $job->max_salary }}
                                                            {{ config('settings.site_currency') }}</b>
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
                                                    @if ($job->status === 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif($job->deadline < date('Y-m-d'))
                                                        <span class="badge bg-danger">Expired</span>
                                                    @else
                                                        <span class="badge bg-success">Active</span>
                                                    @endif
                                                <td>
                                                    <a href="{{ route('company.jobs.edit', $job->id) }}"
                                                        class="btn-sm btn btn-apply mb-2"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('company.jobs.destroy', $job->id) }}"
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
        </div>
    </section>
@endsection

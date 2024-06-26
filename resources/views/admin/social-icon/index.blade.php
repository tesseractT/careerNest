@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Social Icons</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Social Icons</h4>
                        <div class="card-header-form">
                            <form action="{{ route('admin.social-icon.index') }}" method="GET">
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
                        <a href="{{ route('admin.social-icon.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Create New</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Icon</th>
                                    <th>Url</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                                <tbody>
                                    @forelse ($icons as $icon)
                                        <tr>
                                            <td>
                                                <i style="font-size:40px" class="{{ $icon->icon }}"></i>
                                            </td>
                                            <td>{{ $icon->url }}</td>

                                            <td>
                                                <a href="{{ route('admin.social-icon.edit', $icon->id) }}"
                                                    class="btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin.social-icon.destroy', $icon->id) }}"
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
                            @if ($icons->hasPages())
                                {{ $icons->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

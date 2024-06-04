@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Orders</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>My Orders</li>
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
                            <h4>All Orders</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Order</th>
                                        <th>Package Name</th>
                                        <th>Paid Amount</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>

                                        <th style="width: 10%">Action</th>
                                    </tr>
                                    <tbody>
                                        @forelse ($orders as $order)
                                            <tr>
                                                <td>
                                                    #{{ $order->order_id }}

                                                </td>


                                                <td>{{ $order->package_name }}</td>
                                                <td>{{ $order->amount }} {{ $order->paid_in_currency }}</td>
                                                <td>{{ $order->payment_provider }}</td>
                                                <td>
                                                    @if ($order->payment_status == 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif ($order->payment_status == 'completed')
                                                        <span class="badge bg-success">Completed</span>
                                                    @else
                                                        <span class="badge bg-danger">Failed</span>
                                                    @endif

                                                <td>
                                                    <a href="{{ route('company.orders.show', $order->id) }}"
                                                        class="btn btn-apply"><i class="fas fa-eye"></i></a>

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
                        <div class="paginations">
                            <ul class="pager">
                                @if ($orders->hasPages())
                                    {{ $orders->withQueryString()->links() }}
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

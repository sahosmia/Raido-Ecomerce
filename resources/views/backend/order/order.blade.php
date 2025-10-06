@extends('layouts.backend')

@section('order', 'active')

@section('page_title', 'Orders')

@section('content')
    <div class="page-header">
        <div>
            <h3>Order Management</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Orders</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-alert />

    <div class="card border border-primary">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Order List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Billing Address</th>
                            <th>Products</th>
                            <th>Amount & Coupon</th>
                            <th>Status & Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order_details as $key => $detail)
                            <tr>
                                <th>{{ $order_details->firstItem() + $key }}</th>
                                <td>{{ $detail->id }}</td>
                                <td class="text-left">
                                    @if ($detail->billing)
                                        <ul class="list-unstyled">
                                            <li><strong>Name:</strong> {{ $detail->billing->name }}</li>
                                            <li><strong>Email:</strong> {{ $detail->billing->email }}</li>
                                            <li><strong>Division:</strong> {{ $detail->billing->division_name }}</li>
                                            <li><strong>District:</strong> {{ $detail->billing->district_name }}</li>
                                            <li><strong>Address:</strong> {{ $detail->billing->address }}</li>
                                            <li><strong>Zip:</strong> {{ $detail->billing->zip_code }}</li>
                                            <li><strong>Phone:</strong> {{ $detail->billing->phone }}</li>
                                        </ul>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="text-left">
                                    <ul class="list-unstyled">
                                        @foreach ($detail->orders as $order)
                                            <li>{{ $order->product->name ?? 'N/A' }} x {{ $order->quantity }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="text-left">
                                    <ul class="list-unstyled">
                                        @if ($detail->coupon)
                                            <li><strong>Coupon:</strong> <span
                                                    class="badge badge-info">{{ $detail->coupon->code }}</span></li>
                                        @endif
                                        <li><strong>Total:</strong> {{ number_format($detail->total, 2) }}</li>
                                    </ul>
                                </td>
                                <td class="text-left">
                                    <ul class="list-unstyled">
                                        <li>
                                            <strong>Payment Status:</strong>
                                            @if ($detail->payment_status == 1)
                                                <span class="badge badge-danger">Pending</span>
                                            @else
                                                <span class="badge badge-success">Complete</span>
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Delivery Status:</strong>
                                            @if ($detail->delivery_status == 1)
                                                <span class="badge badge-danger">Pending</span>
                                            @elseif($detail->delivery_status == 2)
                                                <span class="badge badge-warning">Processing</span>
                                            @else
                                                <span class="badge badge-success">Complete</span>
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Payment Method:</strong>
                                            @if ($detail->payment_method == 1)
                                                <span class="badge badge-primary">Cash On Delivery</span>
                                            @else
                                                <span class="badge badge-success">Online Transaction</span>
                                            @endif
                                        </li>
                                        <li><strong>Created At:</strong> {{ $detail->created_at->diffForHumans() }}</li>
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-danger">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $order_details->links() }}
            </div>
        </div>
        <div class="card-footer bg-primary text-white">
            <h5 class="mb-0">Total Orders: {{ $order_details->total() }}</h5>
        </div>
    </div>
@endsection

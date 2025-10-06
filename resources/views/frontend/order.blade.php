@extends('layouts.frontend')

@section('content')
    <main class="main order">
        <div class="page-content pt-7 pb-10 mb-10">
            <div class="step-by pr-4 pl-4">
                <h3 class="title title-simple title-step"><a href="{{ route('front.cart.index') }}">1. Shopping Cart</a></h3>
                <h3 class="title title-simple title-step"><a href="{{ route('front.checkout.index') }}">2. Checkout</a>
                </h3>
                <h3 class="title title-simple title-step active"><a href="#">3. Order Complete</a></h3>
            </div>
            <div class="container mt-8">
                <div class="order-message mr-auto ml-auto">
                    <div class="icon-box d-inline-flex align-items-center">
                        <div class="icon-box-icon mb-0">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50"
                                enable-background="new 0 0 50 50" xml:space="preserve">
                                <g>
                                    <path fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="bevel"
                                        stroke-miterlimit="10"
                                        d="M33.3,3.9c-2.7-1.1-5.6-1.8-8.7-1.8c-12.3,0-22.4,10-22.4,22.4c0,12.3,10,22.4,22.4,22.4c12.3,0,22.4-10,22.4-22.4c0-0.7,0-1.4-0.1-2.1">
                                    </path>
                                    <polyline fill="none" stroke-width="4" stroke-linecap="round" stroke-linejoin="bevel"
                                        stroke-miterlimit="10" points="48,6.9 24.4,29.8 17.2,22.3 	"></polyline>
                                </g>
                            </svg>
                        </div>
                        <div class="icon-box-content text-left">
                            <h5 class="icon-box-title font-weight-bold lh-1 mb-1">Thank You!</h5>
                            <p class="lh-1 ls-m">Your order has been received</p>
                        </div>
                    </div>
                </div>

                <div class="order-results">
                    <div class="overview-item">
                        <span>Order number:</span>
                        <strong>{{ $order_details->id }}</strong>
                    </div>
                    <div class="overview-item">
                        <span>Status:</span>
                        <strong>Processing</strong>
                    </div>
                    <div class="overview-item">
                        <span>Date:</span>
                        <strong>{{ $order_details->created_at->format('d M, Y') }}</strong>
                    </div>
                    <div class="overview-item">
                        <span>Email:</span>
                        <strong>{{ $order_billing_details->email }}</strong>
                    </div>
                    <div class="overview-item">
                        <span>Total:</span>
                        <strong>${{ number_format($order_details->total, 2) }}</strong>
                    </div>
                    <div class="overview-item">
                        <span>Payment method:</span>
                        <strong>{{ $order_details->payment_method == 1 ? 'Cash On Delivery' : 'Online Transaction' }}</strong>
                    </div>
                </div>

                <h2 class="title title-simple text-left pt-4 font-weight-bold text-uppercase">Order Details</h2>
                <div class="order-details">
                    <table class="order-details-table">
                        <thead>
                            <tr class="summary-subtotal">
                                <td>
                                    <h3 class="summary-subtitle">Product</h3>
                                </td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                <tr>
                                    <td class="product-name">{{ $item->product->name }} <span> <i class="fas fa-times"></i>
                                            {{ $item->quantity }}</span></td>
                                    <td class="product-price">
                                        ${{ number_format($item->product->discounted_price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach

                            <tr class="summary-subtotal">
                                <td>
                                    <h4 class="summary-subtitle">Subtotal:</h4>
                                </td>
                                <td class="summary-subtotal-price">${{ number_format($subtotal, 2) }}</td>
                            </tr>
                            <tr class="summary-subtotal">
                                <td>
                                    <h4 class="summary-subtitle">Discount:</h4>
                                </td>
                                <td class="summary-subtotal-price">${{ number_format($discount, 2) }}</td>
                            </tr>
                            <tr class="summary-subtotal">
                                <td>
                                    <h4 class="summary-subtitle">Total:</h4>
                                </td>
                                <td>
                                    <p class="summary-total-price">${{ number_format($order_details->total, 2) }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h2 class="title title-simple text-left pt-10 mb-2">Billing Address</h2>
                <div class="address-info pb-8 mb-6">
                    <p class="address-detail pb-2">
                        <strong>Name:</strong> {{ $order_billing_details->name }}<br>
                        <strong>Email:</strong> {{ $order_billing_details->email }}<br>
                        <strong>Division:</strong> {{ $order_billing_details->division->name ?? 'N/A' }}<br>
                        <strong>District:</strong> {{ $order_billing_details->district->name ?? 'N/A' }}<br>
                        <strong>Address:</strong> {{ $order_billing_details->address }}<br>
                        <strong>Post Code:</strong> {{ $order_billing_details->zip_code }}<br>
                        <strong>Phone:</strong> {{ $order_billing_details->phone }}<br>
                    </p>
                </div>
                <a href="{{ route('front.shop') }}"
                    class="btn btn-icon-left btn-dark btn-back btn-rounded btn-md mb-4"><i
                        class="d-icon-arrow-left"></i> Back to List</a>
            </div>
        </div>
    </main>
@endsection
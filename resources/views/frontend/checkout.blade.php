@extends('layouts.frontend')

@section('page_title', 'Checkout')

@section('content')
    <main class="main checkout">
        <div class="page-content pt-7 pb-10 mb-10">
            <div class="step-by pr-4 pl-4">
                <h3 class="title title-simple title-step"><a href="{{ route('front.cart.index') }}">1. Shopping Cart</a></h3>
                <h3 class="title title-simple title-step active"><a href="{{ route('front.checkout.index') }}">2.
                        Checkout</a></h3>
                <h3 class="title title-simple title-step"><a href="#">3. Order Complete</a></h3>
            </div>
            <div class="container mt-7">
                <form action="{{ route('front.order.submit') }}" class="form" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7 mb-6 mb-lg-0 pr-lg-4">
                            <h3 class="title title-simple text-left text-uppercase">Billing Details</h3>
                            <input type="hidden" name="cupon" value="{{ session('coupon_form_cart') }}">

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Name *</label>
                                    <input type="text" class="form-control" name="name" required />
                                </div>
                            </div>

                            <label>Email Address *</label>
                            <input type="email" class="form-control" name="email" required />

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Division *</label>
                                    <select id="division_name" class="form-control" name="division" required>
                                        <option value="" selected>-- Select Division --</option>
                                        @foreach ($divisions as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>District *</label>
                                    <select id="district_name" class="form-control" name="district" required>
                                        <option value="" selected>-- Select Division First --</option>
                                    </select>
                                </div>
                            </div>

                            <label>Address *</label>
                            <input type="text" class="form-control" name="address"
                                placeholder="House number and street name" required />

                            <div class="row">
                                <div class="col-md-6">
                                    <label>ZIP Code *</label>
                                    <input type="text" class="form-control" name="zip" required />
                                </div>
                                <div class="col-md-6">
                                    <label>Phone *</label>
                                    <input type="text" class="form-control" name="phone" required />
                                </div>
                            </div>
                        </div>
                        <aside class="col-lg-5 sticky-sidebar-wrapper">
                            <div class="sticky-sidebar mt-1" data-sticky-options="{'bottom': 50}">
                                <div class="summary pt-5">
                                    <h3 class="title title-simple text-left text-uppercase">Your Order</h3>
                                    <table class="order-table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart_items as $item)
                                                <tr>
                                                    <td class="product-name">{{ $item->product->name }} <span
                                                            class="product-quantity">×&nbsp;{{ $item->quantity }}</span>
                                                    </td>
                                                    <td class="product-total text-body">
                                                        ${{ $item->product->discounted_price * $item->quantity }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr class="summary-subtotal">
                                                <td>
                                                    <h4 class="summary-subtitle">Subtotal</h4>
                                                </td>
                                                <td class="summary-subtotal-price pb-0 pt-0">${{ $total }}</td>
                                            </tr>
                                            <tr class="summary-subtotal">
                                                <td>
                                                    <h4 class="summary-subtitle">Discount</h4>
                                                </td>
                                                <td class="summary-subtotal-price pb-0 pt-0">${{ $discount_amount }}</td>
                                            </tr>
                                            <tr class="summary-total">
                                                <td class="pb-0">
                                                    <h4 class="summary-subtitle">Total</h4>
                                                </td>
                                                <td class="pt-0 pb-0">
                                                    <p class="summary-total-price ls-s text-primary">
                                                        ${{ $total - $discount_amount }}</p>
                                                    <input type="hidden" value="{{ $total - $discount_amount }}"
                                                        name="total">
                                                </td>
                                            </tr>
                                            <tr class="sumnary-shipping shipping-row-last">
                                                <td colspan="2">
                                                    <h4 class="summary-subtitle">Payment Method</h4>
                                                    <ul>
                                                        <li>
                                                            <div class="custom-radio">
                                                                <input type="radio" id="flat_rate" name="payment_method"
                                                                    class="custom-control-input" value="1" checked>
                                                                <label class="custom-control-label" for="flat_rate">Cash
                                                                    on Delivery</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-radio">
                                                                <input type="radio" id="free-shipping"
                                                                    name="payment_method" class="custom-control-input"
                                                                    value="2">
                                                                <label class="custom-control-label"
                                                                    for="free-shipping">Online Transaction</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-dark btn-rounded btn-order">Place
                                        Order</button>
                                </div>
                            </div>
                        </aside>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@section('exta_js')
    <script src="{{ asset('frontend/vendor/sticky/sticky.min.js') }}"></script>
@endsection








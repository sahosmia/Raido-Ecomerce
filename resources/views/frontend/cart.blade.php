@extends('layouts.frontend')

@section('page_title', 'Shopping Cart')

@section('content')
    <main class="main cart">
        <div class="step-by pr-4 pl-4">
            <h3 class="title title-simple title-step active"><a href="{{ route('front.cart.index') }}">1. Shopping Cart</a>
            </h3>
            <h3 class="title title-simple title-step"><a href="{{ route('front.checkout.index') }}">2. Checkout</a></h3>
            <h3 class="title title-simple title-step"><a href="#">3. Order Complete</a></h3>
        </div>
        <div class="container mt-7 mb-2">
            <div class="row">
                @if (count($cart_items) > 0)
                    <div class="col-lg-8 col-md-12 pr-lg-4">
                        <form action="{{ route('front.cart.update') }}" method="post">
                            @csrf
                            <table class="shop-table cart-table cart-wrap">
                                <thead>
                                    <tr>
                                        <th><span>Product</span></th>
                                        <th></th>
                                        <th><span>Price</span></th>
                                        <th><span>Quantity</span></th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart_items as $item)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <figure>
                                                    <a href="{{ route('front.product.view', $item->product->id) }}">
                                                        <img src="{{ asset('upload/product/' . $item->product->img) }}"
                                                            width="100" height="100" alt="product">
                                                    </a>
                                                </figure>
                                            </td>
                                            <td class="product-name">
                                                <div class="product-name-section">
                                                    <a
                                                        href="{{ route('front.product.view', $item->product->id) }}">{{ $item->product->name }}</a>
                                                    @if ($item->quantity > $item->product->quantity)
                                                        <span class="tip tip-hot">Stock Out</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                <span class="amount">${{ $item->product->discounted_price }}</span>
                                            </td>
                                            <td class="quantity cart-plus-minus">
                                                <input type="number" value="{{ $item->quantity }}"
                                                    name="quantity[{{ $item->id }}]" class="product_quantity" />
                                            </td>
                                            <td class="product-price">
                                                <span
                                                    class="amount">${{ $item->product->discounted_price * $item->quantity }}</span>
                                            </td>
                                            <td class="product-close">
                                                <form action="{{ route('front.cart.delete', $item) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="product-remove"
                                                        title="Remove this product"
                                                        style="background:none; border:none; padding:0; cursor:pointer;">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="cart-actions mb-6 pt-4">
                                <a href="{{ route('front.shop') }}"
                                    class="btn btn-dark btn-md btn-rounded btn-icon-left mr-4 mb-4"><i
                                        class="d-icon-arrow-left"></i>Continue Shopping</a>
                                <button type="submit"
                                    class="btn btn-outline btn-dark btn-md btn-rounded update_cart btn-disabled">Update
                                    Cart</button>
                            </div>
                        </form>

                        <div class="cart-coupon-box mb-8">
                            <h4 class="title coupon-title text-uppercase ls-m">Coupon Discount</h4>
                            <form action="{{ route('front.cart.coupon.apply') }}" method="POST">
                                @csrf
                                <input type="text" name="coupon_code"
                                    class="input-text form-control text-grey ls-m mb-4" id="coupon_code"
                                    value="{{ old('coupon_code', $coupon ?? '') }}"
                                    placeholder="Enter coupon code here...">
                                <button type="submit" class="btn btn-md btn-dark btn-rounded btn-outline">Apply
                                    Coupon</button>
                            </form>
                        </div>
                        <x-alert />
                    </div>

                    <aside class="col-lg-4 sticky-sidebar-wrapper">
                        <div class="sticky-sidebar" data-sticky-options="{'bottom': 20}">
                            <div class="summary mb-4">
                                <h3 class="summary-title text-left">Cart Totals</h3>
                                <table class="shipping">
                                    <tr>
                                        <td>
                                            <h4 class="summary-subtitle">Subtotal</h4>
                                        </td>
                                        <td>
                                            <p class="summary-subtotal-price">${{ $total }}</p>
                                        </td>
                                    </tr>
                                    <tr class="summary-subtotal">
                                        <td>
                                            <h4 class="summary-subtitle">Discount</h4>
                                        </td>
                                        <td>
                                            <p class="summary-subtotal-price">${{ $discount_amount }}</p>
                                        </td>
                                    </tr>
                                </table>
                                <table class="total">
                                    <tr class="summary-subtotal">
                                        <td>
                                            <h4 class="summary-subtitle">Total</h4>
                                        </td>
                                        <td>
                                            <p class="summary-total-price ls-s">${{ $total - $discount_amount }}</p>
                                        </td>
                                    </tr>
                                </table>
                                @if ($status)
                                    <a href="{{ route('front.checkout.index') }}"
                                        class="btn btn-dark btn-rounded btn-checkout purcess_btn">Proceed to
                                        checkout</a>
                                @else
                                    <div class="alert alert-danger">Please check your item stock.</div>
                                @endif
                            </div>
                        </div>
                    </aside>
                @else
                    <div class="col-12 text-center">
                        <h2 class="mt-4">Your cart is empty.</h2>
                        <a href="{{ route('front.shop') }}" class="btn btn-dark btn-md btn-rounded mt-4">Return to
                            Shop</a>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection






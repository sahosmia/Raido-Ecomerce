@extends('layouts.frontend')
@section('exta_css')
<style>
.cart-wrap .quantitya {
    position: relative;
}
.cart-wrap .quantitya .qtybutton {
    top: 50%;
    left: 0px;
    transform: translateY(-51%);
    -webkit-transform: translateY(-51%);
    -moz-transform: translateY(-51%);
}

.cart-wrap .quantitya .qtybutton.inc {
    right: 27px;
    left: auto;
}
.quantitya input {
    width: 106px;
    padding: 419px -2px;
    text-align: center;
    height: 35px;
    position: relative;
    background: #ccc;
    border: none;
    top: -1px;
}

.quantitya .qtybutton {
    position: absolute;
    top: 0;
    left: 0;
    height: 35px;
    width: 35px;
    text-align: center;
    line-height: 35px;
    font-size: 18px;
    cursor: pointer;
    color: #333;
    background:#ddd;
}

.quantitya .qtybutton:hover {
    background: #2266cc;
    color: #fff;
}
.cart-wrap .quantitya .qtybutton.inc {
    left: 72px;
}

</style>

@endsection
@section('content')

<div class="step-by pr-4 pl-4">
    <h3 class="title title-simple title-step active"><a href="{{ route('cart') }}">1. Shopping Cart</a></h3>
    <h3 class="title title-simple title-step"><a href="{{ route('checkout') }}">2. Checkout</a></h3>
    <h3 class="title title-simple title-step"><a href="order.html">3. Order Complete</a></h3>
</div>
<div class="container mt-7 mb-2">
    <div class="row">
        <div class="col-lg-8 col-md-12 pr-lg-4">
            <form action="{{ route('update_cart') }}" method="post">
                <table class="shop-table cart-table cart-wrap">
                    <thead>
                        <tr>
                            <th><span>Product</span></th>
                            <th></th>
                            <th><span>Price</span></th>
                            <th><span>quantitya</span></th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>


                        @csrf
                        @php
                        use App\Models\Product;
                            $total = 0;
                            $status = true;
                        @endphp
                        @forelse ($cart_items as $item)
                        @php
                        if (Product::find($item->product)->discount) {
                            $price = Product::find($item->product)->price-Product::find($item->product)->discount*Product::find($item->product)->price/100;

                        }
                        else {
                            $price = Product::find($item->product)->price;
                        }

                            $total +=  $price*$item->quantity;
                        @endphp

                        <tr>
                            <td class="product-thumbnail">
                                <figure>
                                    <a href="product-simple.html">
                                        <img src="{{ asset('upload/product') }}/{{ Product::find($item->product)->img }}" width="100" height="100"
                                            alt="product">
                                    </a>
                                </figure>
                            </td>
                            <td class="product-name">
                                <div class="product-name-section">
                                    <a href="{{ url('front/product') }}/{{ $item->product }}">{{ Product::find($item->product)->name }}</a>
                                    @if ($item->quantity > Product::find($item->product)->quantity)
                                        <span class="tip tip-hot">stok out</span>
                                        @php
                                            $status = false;
                                        @endphp
                                        @endif
                                    </div>
                            </td>
                            <td class="product-subtotal">
                                <span class="amount">${{ $price }}</span>
                            </td>
                            <td class="quantitya cart-plus-minus">
                            <input type="number" value="{{ $item->quantity }}" name="quantity[{{ $item->id }}]" class="product_quantity"/>
                        </td>
                            <td class="product-price">
                                <span class="amount">${{ $price*$item->quantity }}</span>
                            </td>
                            <td class="product-close">
                                <a href="{{ url('front/cart/delete/product_id') }}/{{ $item->product }}" class="product-remove" title="Remove this product">
                                    <i class="fas fa-times"></i>
                                </a>
                            </td>
                        </tr>

                        @empty
                        you have no cart item
                        @endforelse
                </table>
                <div class="cart-actions mb-6 pt-4">
                    <a href="{{ url('front/category/subcategory') }}/{{ 'all' }}/{{ 'all' }}" class="btn btn-dark btn-md btn-rounded btn-icon-left mr-4 mb-4"><i class="d-icon-arrow-left"></i>Continue Shopping</a>
                    <button type="submit" class="btn btn-outline btn-dark btn-md btn-rounded update_cart btn-disabled">Update Cart</button>
                </div>
            </form>

            <div class="cart-coupon-box mb-8">
                <h4 class="title coupon-title text-uppercase ls-m">Coupon Discount</h4>
                <input type="text" name="coupon_code"
                    class="input-text form-control text-grey ls-m mb-4" id="coupon_code" value="{{ $coupon }}"
                    placeholder="Enter coupon code here...">
                <a id="coupon_code_btn" class="btn btn-md btn-dark btn-rounded btn-outline">Apply
                    Coupon</a>
            </div>
            @if(session()->has('error'))
                <span style="color: red">
                    {{ session()->get('error') }}
                </span>
            @endif
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
                                <p class="summary-subtotal-price">${{ $discount*$total/100 }}</p>
                            </td>
                        </tr>

                    </table>

                    <table class="total">
                        <tr class="summary-subtotal">
                            <td>
                                <h4 class="summary-subtitle">Total</h4>
                            </td>
                            <td>
                                <p class="summary-total-price ls-s">${{ $total-$discount*$total/100 }}</p>
                            </td>
                        </tr>
                    </table>
                    @if ($status == true)
                    <a href="{{ route('checkout') }}" class="btn btn-dark btn-rounded btn-checkout purcess_btn">Proceed to checkout</a>
                    @else
                        <span style="color: red">Pleace Chak your item sotok</span>
                    @endif
                </div>
            </div>
        </aside>
    </div>
</div>
@php
    session(['coupon_form_cart' => $coupon ]);
@endphp


@endsection
@section('exta_js')
<script>
        $(".cart-plus-minus").append(
        '<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>'
    );
    $(".qtybutton").on("click", function () {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() == "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }

        $button.parent().find("input").val(newVal);
    });
</script>



<script>
    $(document).ready(function(){
        $('#coupon_code_btn').click(function(){
            var link = "{{ url('front/cart') }}/" + $('#coupon_code').val();
            window.location.href = link;
        });

        $('.qtybutton').click(function(){
            $('.purcess_btn').fadeOut(500);
            $('.update_cart').removeClass('btn-disabled');
        });

        $('.product_quantity').change(function(){
            $('.purcess_btn').fadeOut(500);
            $('.update_cart').removeClass('btn-disabled');
        });
    });
</script>

@endsection






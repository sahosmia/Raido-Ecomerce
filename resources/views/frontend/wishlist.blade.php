@extends('layouts.frontend')
@section('exta_css')
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/photoswipe/photoswipe.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/photoswipe/default-skin/default-skin.min.css') }}">

@endsection
@section('content')
@include('include.frontend.page_header',[
    "name" => 'Wish list'
])
			<!-- End PageHeader -->

<div class="page-content pt-10 pb-10 mb-2">
    <div class="container">
         @if(session()->has('success_with_btn'))
        <div class="alert alert-success alert-simple alert-btn">
            <a href="{{ route('cart') }}" class="btn btn-success btn-md btn-rounded">view Cart</a>
            {{ session()->get('success_with_btn') }}
            <button type="button" class="btn btn-link btn-close">
                <i class="d-icon-times"></i>
            </button>
        </div>
        @endif

         @if(session()->has('error'))
        <div class="alert alert-light alert-warning alert-icon alert-inline mb-4">
            <i class="fas fa-exclamation-triangle"></i>
            <h4 class="alert-title">Out of Stock!</h4>
            {{ session()->get('error') }}
            <button type="button" class="btn btn-link btn-close">
                <i class="d-icon-times"></i>
            </button>
        </div>
        @endif
        <table class="shop-table wishlist-table mt-2 mb-4">
            <thead>
                <tr>
                    <th class="product-name"><span>Product</span></th>
                    <th></th>
                    <th class="product-price"><span>Price</span></th>
                    <th class="product-stock-status"><span>Stock status</span></th>
                    <th class="product-add-to-cart"></th>
                    <th class="product-remove"></th>
                </tr>
            </thead>
            <tbody class="wishlist-items-wrapper">
            @php
                use App\Models\Product;
            @endphp
                @foreach ($wishlists as $item)
                @php
                     if (Product::find($item->product_id)->discount) {
                        $price = Product::find($item->product_id)->price-Product::find($item->product_id)->discount*Product::find($item->product_id)->price/100;

                    }
                    else {
                        $price = Product::find($item->product_id)->price;
                    }


                @endphp
                <tr>
                    <td class="product-thumbnail">
                        <a href="product-simple.html">
                            <figure>
                                <img src="{{ asset('upload/product') }}/{{ Product::find($item->product_id)->img }}" width="100" height="100"
                                    alt="product">
                            </figure>
                        </a>
                    </td>
                    <td class="product-name">
                        <a href="{{ url('front/product') }}/{{ $item->product_id }}">{{ Product::find($item->product_id)->name }}</a>
                    </td>
                    <td class="product-price">
                        <span class="amount">${{ $price }}</span>
                    </td>

                    <td class="product-stock-status">
                        @if (Product::find($item->product_id)->quantity == 0)
                        <span class="wishlist-out-stock">Out Stock</span>
                        @else
                        <span class="wishlist-in-stock">In Stock</span>
                        @endif
                    </td>
                    <td class="product-add-to-cart">
                        <a href="{{ url('front/cart/product') }}/{{ $item->product_id }}" class="btn-product btn-primary"><span>Add to Cart</span></a>
                    </td>
                    <td class="product-remove">
                        <div>
                            <a href="{{ url('front/wishlist/delete/product_id') }}/{{ $item->id }}" class="remove" title="Remove this product"><i class="fas fa-times"></i></a>
                        </div>
                    </td>
                </tr>
                 @endforeach

            </tbody>
        </table>


    </div>
</div>

@endsection
@section('exta_js')
	<script src="{{ asset('frontend/vendor/sticky/sticky.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/photoswipe/photoswipe.min.js') }}"></script>
    <script src="{{ asset('frontend/photoswipe/photoswipe-ui-default.min.js') }}"></script>
    <script src="{{ asset('frontend/jquery.plugin/jquery.plugin.min.js') }}"></script>
    <script src="{{ asset('frontend/jquery.countdown/jquery.countdown.min.js') }}"></script>

@endsection






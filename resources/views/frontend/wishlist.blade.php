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
                @foreach ($wishlists as $item)


                <tr>
                    <td class="product-thumbnail">
                        <a href="product-simple.html">
                            <figure>
                                <img src="{{ asset('upload/product') }}/{{ App\Models\Product::find($item->product_id)->img }}" width="100" height="100"
                                    alt="product">
                            </figure>
                        </a>
                    </td>
                    <td class="product-name">
                        <a href="product-simple.html">{{ App\Models\Product::find($item->product_id)->name }}</a>
                    </td>
                    <td class="product-price">
                        <span class="amount">${{ App\Models\Product::find($item->product_id)->price }}</span>
                    </td>
                    <td class="product-stock-status">
                        @if (App\Models\Product::find($item->product_id)->quantity == 0)
                        <span class="wishlist-out-stock">Out Stock</span>
                        @else
                        <span class="wishlist-in-stock">In Stock</span>
                        @endif
                    </td>
                    <td class="product-add-to-cart">
                        <a href="product.html" class="btn-product btn-primary"><span>Add to Cart</span></a>
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






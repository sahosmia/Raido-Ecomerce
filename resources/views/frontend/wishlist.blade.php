@extends('layouts.frontend')

@section('page_title', 'Wishlist')

@section('content')
    @include('include.frontend.page_header', [
        'name' => 'Wishlist',
    ])
    <!-- End PageHeader -->

    <div class="page-content pt-10 pb-10 mb-2">
        <div class="container">
            <x-alert />

            @if (session()->has('success_with_btn'))
                <div class="alert alert-success alert-simple alert-btn">
                    <a href="{{ route('front.cart.index') }}" class="btn btn-success btn-md btn-rounded">View Cart</a>
                    {{ session()->get('success_with_btn') }}
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
                        <th class="product-stock-status"><span>Stock Status</span></th>
                        <th class="product-add-to-cart"></th>
                        <th class="product-remove"></th>
                    </tr>
                </thead>
                <tbody class="wishlist-items-wrapper">
                    @forelse ($wishlists as $item)
                        <tr>
                            <td class="product-thumbnail">
                                <a href="{{ route('front.product.view', $item->product->id) }}">
                                    <figure>
                                        <img src="{{ asset('upload/product/' . $item->product->img) }}" width="100"
                                            height="100" alt="product">
                                    </figure>
                                </a>
                            </td>
                            <td class="product-name">
                                <a
                                    href="{{ route('front.product.view', $item->product->id) }}">{{ $item->product->name }}</a>
                            </td>
                            <td class="product-price">
                                <span class="amount">${{ $item->product->discounted_price }}</span>
                            </td>
                            <td class="product-stock-status">
                                @if ($item->product->quantity > 0)
                                    <span class="wishlist-in-stock">In Stock</span>
                                @else
                                    <span class="wishlist-out-stock">Out of Stock</span>
                                @endif
                            </td>
                            <td class="product-add-to-cart">
                                <form action="{{ route('front.cart.add', $item->product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-product btn-primary"><span>Add to
                                            Cart</span></button>
                                </form>
                            </td>
                            <td class="product-remove">
                                <form action="{{ route('front.wishlist.delete', $item) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove" title="Remove this product"
                                        style="background:none; border:none; padding:0; cursor:pointer; font-size: 1.5rem; color: #999;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <h4 class="mt-4">Your wishlist is empty.</h4>
                                <a href="{{ route('front.shop') }}" class="btn btn-primary">Go to Shop</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('exta_js')
    <script src="{{ asset('frontend/vendor/sticky/sticky.min.js') }}"></script>
@endsection
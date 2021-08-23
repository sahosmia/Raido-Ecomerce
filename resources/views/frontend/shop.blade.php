@extends('layouts.frontend')
@section('exta_css')
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/nouislider/nouislider.min.css') }}">

@endsection
@section('content')
@include('include.frontend.page_header')
			<!-- End PageHeader -->

<div class="container">
    <div class="row main-content-wrap gutter-lg">
        <aside
            class="col-lg-3 sidebar sidebar-fixed sidebar-toggle-remain shop-sidebar sticky-sidebar-wrapper">
            <div class="sidebar-overlay"></div>
            <a class="sidebar-close" href="#"><i class="d-icon-times"></i></a>
            <div class="sidebar-content">
                <div class="sticky-sidebar" data-sticky-options="{'top': 10}">

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">All Categories</h3>
                        <ul class="widget-body filter-items search-ul">


                            @foreach ($categories as $item)
                            <li>
                                <a class="mb-2" href="#">{{ $item->name }}</a>
                                <ul style="display: block">
                                    @foreach ($subcategories->where('category', $item->id) as $subcategory)
                                    <li><a href="#">{{ $subcategory->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach


                                {{-- <li>
                                <a href="#">Electronics</a>
                                <ul style="display: block">
                                    <li><a href="#">Computer</a></li>
                                    <li><a href="#">Gaming & Accessosries</a></li>
                                </ul>
                            </li> --}}

                        </ul>
                    </div>


                </div>
            </div>
        </aside>
        <div class="col-lg-9 main-content">
            <nav class="toolbox sticky-toolbox sticky-content fix-top">
            </nav>
            <div class="row cols-2 cols-sm-3 product-wrapper">
                <div class="product-wrap">
                    <div class="product">
                        <figure class="product-media">
                            <a href="product.html">
                                <img src="images/shop/1.jpg" alt="product" width="280" height="315">
                            </a>
                            <div class="product-label-group">
                                <label class="product-label label-new">new</label>
                                <label class="product-label label-sale">12% OFF</label>
                            </div>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-cart" data-toggle="modal"
                                    data-target="#addCartModal" title="Add to cart"><i class="d-icon-bag"></i></a>
                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i
                                        class="d-icon-heart"></i></a>
                            </div>
                            <div class="product-action">
                                <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
                                    View</a>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="product-cat">
                                <a href="shop-grid-3col.html">Bags & Backpacks</a>
                            </div>
                            <h3 class="product-name">
                                <a href="product.html">Women's Fashion Handbag</a>
                            </h3>
                            <div class="product-price">
                                <ins class="new-price">$53.99</ins><del class="old-price">$67.99</del>
                            </div>
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width:60%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <a href="product.html" class="rating-reviews">( 16 reviews )</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-wrap">
                    <div class="product">
                        <figure class="product-media">
                            <a href="product.html">
                                <img src="images/shop/2.jpg" alt="product" width="280" height="315">
                            </a>
                            <div class="product-label-group">
                                <label class="product-label label-sale">25% OFF</label>
                            </div>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-cart" data-toggle="modal"
                                    data-target="#addCartModal" title="Add to cart"><i class="d-icon-bag"></i></a>
                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i
                                        class="d-icon-heart"></i></a>
                            </div>
                            <div class="product-action">
                                <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
                                    View</a>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="product-cat">
                                <a href="shop-grid-3col.html">Bags & Backpacks</a>
                            </div>
                            <h3 class="product-name">
                                <a href="product.html">Mackintosh Poket Backpack</a>
                            </h3>
                            <div class="product-price">
                                <ins class="new-price">$125.99</ins><del class="old-price">$160.99</del>
                            </div>
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width:60%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <a href="product.html" class="rating-reviews">( 8 reviews )</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-wrap">
                    <div class="product">
                        <figure class="product-media">
                            <a href="product.html">
                                <img src="images/shop/3.jpg" alt="product" width="280" height="315">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-cart" data-toggle="modal"
                                    data-target="#addCartModal" title="Add to cart"><i class="d-icon-bag"></i></a>
                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i
                                        class="d-icon-heart"></i></a>
                            </div>
                            <div class="product-action">
                                <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
                                    View</a>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="product-cat">
                                <a href="shop-grid-3col.html">Shoes</a>
                            </div>
                            <h3 class="product-name">
                                <a href="product.html">Converse Blue Trainaing Shoes</a>
                            </h3>
                            <div class="product-price">
                                <span class="price">$111.00</span>
                            </div>
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width:40%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <a href="product.html" class="rating-reviews">( 4 reviews )</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-wrap">
                    <div class="product">
                        <figure class="product-media">
                            <a href="product.html">
                                <img src="images/shop/4.jpg" alt="product" width="280" height="315">
                            </a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-cart" data-toggle="modal"
                                    data-target="#addCartModal" title="Add to cart"><i class="d-icon-bag"></i></a>
                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i
                                        class="d-icon-heart"></i></a>
                            </div>
                            <div class="product-action">
                                <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
                                    View</a>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="product-cat">
                                <a href="shop-grid-3col.html">Clothing</a>
                            </div>
                            <h3 class="product-name">
                                <a href="product.html">Fashionable Orginal Trucker</a>
                            </h3>
                            <div class="product-price">
                                <span class="price">$78.64</span>
                            </div>
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width:40%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <a href="product.html" class="rating-reviews">( 2 reviews )</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-wrap">
                    <div class="product">
                        <figure class="product-media">
                            <a href="product.html">
                                <img src="images/shop/5.jpg" alt="product" width="280" height="315">
                            </a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-cart" data-toggle="modal"
                                    data-target="#addCartModal" title="Add to cart"><i class="d-icon-bag"></i></a>
                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i
                                        class="d-icon-heart"></i></a>
                            </div>
                            <div class="product-action">
                                <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
                                    View</a>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="product-cat">
                                <a href="shop-grid-3col.html">Watches</a>
                            </div>
                            <h3 class="product-name">
                                <a href="product.html">Fashion Man Watch</a>
                            </h3>
                            <div class="product-price">
                                <span class="price">$314.41</span>
                            </div>
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width:20%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <a href="product.html" class="rating-reviews">( 14 reviews )</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-wrap">
                    <div class="product">
                        <figure class="product-media">
                            <a href="product.html">
                                <img src="images/shop/6.jpg" alt="product" width="280" height="315">
                            </a>
                            <div class="product-label-group">
                                <label class="product-label label-sale">20% off</label>
                            </div>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-cart" data-toggle="modal"
                                    data-target="#addCartModal" title="Add to cart"><i class="d-icon-bag"></i></a>
                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i
                                        class="d-icon-heart"></i></a>
                            </div>
                            <div class="product-action">
                                <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
                                    View</a>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="product-cat">
                                <a href="shop-grid-3col.html">Clothing</a>
                            </div>
                            <h3 class="product-name">
                                <a href="product.html">Men Beautiful Clothing</a>
                            </h3>
                            <div class="product-price">
                                <ins class="new-price">$93.42</ins><del class="old-price">$127.72</del>
                            </div>
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width:100%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <a href="product.html" class="rating-reviews">( 36 reviews )</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


@endsection
@section('exta_js')
	<script src="{{ asset('frontend/vendor/sticky/sticky.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/nouislider/nouislider.min.js') }}"></script>

@endsection






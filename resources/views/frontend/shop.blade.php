@extends('layouts.frontend')
@section('exta_css')
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/nouislider/nouislider.min.css') }}">

@endsection
@section('content')
@include('include.frontend.page_header', ['name' => 'shop'])
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
                                <a class="mb-2" href="{{ url('front/category/subcategory') }}/{{ $item->id }}/{{ 'null' }}">{{ $item->name }}</a>
                                <ul style="display: {{ $show_status == "with_subcategory" && $category_id == $item->id ? "block" : "" }}">
                                    @foreach ($subcategories->where('category', $item->id) as $subcategory)
                                    <li><a href="{{ url('front/category/subcategory') }}/{{ $item->id }}/{{ $subcategory->id }}">{{ $subcategory->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <div class="col-lg-9 main-content">
            <nav class="toolbox sticky-toolbox sticky-content fix-top">
            </nav>
            <div class="row cols-2 cols-sm-3 product-wrapper">
                @forelse ($products as $item)
                 <div class="product product-classic">
                    <figure class="product-media">
                        <a href="product.html">
                        <img src="{{ asset('upload/product')}}/{{ $item->img }}" alt="product" width="280" height="315"/>
                        </a>
                        <div class="product-label-group">
                            @if ($item->created_at->diffInDays() <= 7)
                            <label class="product-label label-new">new</label>
                            @endif

                            @if ($item->discount != 0)
                            <label class="product-label label-sale">{{ $item->discount }}% Off</label>
                            @endif
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="product-cat">
                        <a href="shop-grid-3col.html">{{ App\Models\Category::find($item->category)->name }}</a>
                        </div>
                        <h3 class="product-name"><a href="{{ url('front/product') }}/{{ $item->id }}">{{ $item->name }}</a></h3>
                        <div class="product-price">
                        @if ($item->discount != 0)
                        <ins class="new-price">${{ $item->price - ($item->price*$item->discount/100) }}</ins>
                        <del class="old-price">${{ $item->price }}</del>
                        @else
                        <ins class="new-price">${{ $item->price }}</ins>
                        @endif
                        </div>
                        <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: 100%"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <a href="product.html" class="rating-reviews">( 6 reviews )</a>
                        </div>
                        <div class="product-action">
                        <a href="#" class="btn-product btn-cart" data-toggle="modal" data-target="#addCartModal" title="Add to cart"><i class="d-icon-bag"></i><span>Add to cart</span></a>
                        <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i class="d-icon-heart"></i></a>
                        <a href="#" class="btn-product-icon btn-quickview" title="Quick View"><i class="d-icon-search"></i></a>
                        </div>
                    </div>
                    </div>
                    @empty
                    <h1>Any Product Not Aviable </h1>
                @endforelse

            </div>

        </div>
    </div>
</div>


@endsection
@section('exta_js')
	<script src="{{ asset('frontend/vendor/sticky/sticky.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/nouislider/nouislider.min.js') }}"></script>

@endsection






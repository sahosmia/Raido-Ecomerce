@extends('layouts.frontend')

@section('page_title', 'Shop')

@section('content')
    @include('include.frontend.page_header', ['name' => 'shop'])
    <!-- End PageHeader -->

    <div class="container">
        <div class="row main-content-wrap gutter-lg">
            <aside class="col-lg-3 sidebar sidebar-fixed sidebar-toggle-remain shop-sidebar sticky-sidebar-wrapper">
                <div class="sidebar-overlay"></div>
                <a class="sidebar-close" href="#"><i class="d-icon-times"></i></a>
                <div class="sidebar-content">
                    <div class="sticky-sidebar" data-sticky-options="{'top': 10}">
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">All Categories</h3>
                            <ul class="widget-body filter-items search-ul">
                                @foreach ($categories as $item)
                                    <li>
                                        <a class="mb-2"
                                            href="{{ url('front/category/subcategory') }}/{{ $item->id }}/{{ 'null' }}">{{ $item->name }}</a>
                                        <ul
                                            class="{{ $show_status == 'with_subcategory' && $category_id == $item->id ? 'show' : '' }}">
                                            @foreach ($subcategories->where('category', $item->id) as $subcategory)
                                                <li><a
                                                        href="{{ url('front/category/subcategory') }}/{{ $item->id }}/{{ $subcategory->id }}">{{ $subcategory->name }}</a>
                                                </li>
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
                    @include('include.frontend.product_item', [
                        'items' => $products,
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('exta_js')
    <script src="{{ asset('frontend/vendor/sticky/sticky.min.js') }}"></script>
@endsection
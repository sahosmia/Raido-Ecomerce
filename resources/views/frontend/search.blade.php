@extends('layouts.frontend')

@section('page_title', 'Search Results')

@section('content')
    <main class="main">
        <div class="page-header">
            <div class="container">
                <h1 class="page-title">Search Results for "{{ request('query') }}"</h1>
            </div>
        </div>
        <nav class="breadcrumb-nav mb-10 pb-1">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ route('front.index') }}"><i class="d-icon-home"></i></a></li>
                    <li>Search Results</li>
                </ul>
            </div>
        </nav>
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-wrapper">
                            <div class="row cols-2 cols-sm-3 cols-md-4 cols-xl-5">
                                @forelse ($products as $item)
                                    <div class="product-wrap">
                                        @include('include.frontend.product_item', [
                                            'items' => [$item],
                                        ])
                                    </div>
                                @empty
                                    <div class="col-12 text-center">
                                        <h3 class="text-muted">No products found for your search.</h3>
                                        <p>Try a different keyword or browse our categories.</p>
                                        <a href="{{ route('front.shop') }}" class="btn btn-primary">Go to Shop</a>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
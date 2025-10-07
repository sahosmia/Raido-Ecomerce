@extends('layouts.backend')

@section('product', 'active')

@section('page_title', 'Product Details')

@section('content')
    <div class="page-header">
        <div>
            <h3>Product Details</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products.index') }}">Products</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-alert />

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="slider-for">
                                <div class="slick-slide-item">
                                    <img src="{{ asset('upload/product/' . $item->img) }}" class="img-fluid rounded"
                                        alt="Featured Image">
                                </div>
                                @foreach ($product_photos as $photo)
                                    <div class="slick-slide-item">
                                        <img src="{{ asset('upload/product_photo/' . $photo->img) }}"
                                            class="img-fluid rounded" alt="Product Image">
                                    </div>
                                @endforeach
                            </div>
                            <div class="slider-nav mt-4">
                                <div class="slick-slide-item">
                                    <img src="{{ asset('upload/product/' . $item->img) }}" class="img-fluid rounded"
                                        alt="Featured Image Thumbnail">
                                </div>
                                @foreach ($product_photos as $photo)
                                    <div class="slick-slide-item">
                                        <img src="{{ asset('upload/product_photo/' . $photo->img) }}"
                                            class="img-fluid rounded" alt="Product Image Thumbnail">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between mb-2">
                                <p class="text-muted mb-0">
                                    {{ $item->category->name ?? 'N/A' }} >
                                    {{ $item->subcategory->name ?? 'N/A' }}
                                </p>
                                <span class="d-flex align-items-center">
                                    @if ($item->quantity == 0)
                                        <span class="badge bg-danger-bright text-danger">Out of Stock</span>
                                    @else
                                        <span class="badge bg-success-bright text-success">In Stock
                                            ({{ $item->quantity }})</span>
                                    @endif
                                </span>
                            </div>
                            <h2>{{ $item->name }}</h2>
                            <div class="font-size-30 mb-2">
                                @if ($item->discount)
                                    <strong>${{ $item->price - ($item->price * $item->discount) / 100 }}</strong>
                                    <small class="mr-2">
                                        <del>${{ $item->price }}</del>
                                    </small>
                                    <small class="text-danger">{{ $item->discount }}% Off</small>
                                @else
                                    <strong>${{ $item->price }}</strong>
                                @endif
                            </div>
                            <hr>
                            <h4 class="mb-3">Description</h4>
                            <p>{{ $item->des }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('exta_js')
    <script>
        $(document).ready(function() {
            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.slider-nav'
            });
            $('.slider-nav').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: true,
                centerMode: true,
                focusOnSelect: true
            });
        });
    </script>
@endsection

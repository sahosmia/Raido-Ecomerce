@extends('layouts.frontend')
@section('exta_css')
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/photoswipe/photoswipe.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/photoswipe/default-skin/default-skin.min.css') }}">

@endsection
@section('content')
<main class="main mt-8 single-product">
<div class="page-content mb-10 pb-6">
    <div class="container">
        <div class="product product-single row mb-8">
            <div class="col-md-6">
                <div class="product-gallery pg-vertical">
                    <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1">
                        <figure class="product-image">
                            <img src="{{ asset('upload/product') }}/{{ $product->img }}"
                                data-zoom-image="images/product/product-3-1-800x900.jpg"
                                alt="Women's Brown Leather Backpacks" width="800" height="900">
                        </figure>
                        @foreach ($product_photos as $photo)
                        <figure class="product-image">
                            <img src="{{ asset('upload/product_photo') }}/{{ $photo->img }}"
                                data-zoom-image="images/product/product-3-2-800x900.jpg"
                                alt="Women's Brown Leather Backpacks" width="800" height="900">
                        </figure>
                        @endforeach
                    </div>
                    <div class="product-thumbs-wrap">
                        <div class="product-thumbs">
                            <div class="product-thumb active">
                                <img src="{{ asset('upload/product') }}/{{ $product->img }}" alt="product thumbnail" width="109"
                                    height="122">
                            </div>
                            @foreach ($product_photos as $photo)
                            <div class="product-thumb">
                                <img src="{{ asset('upload/product_photo') }}/{{ $photo->img }}" alt="product thumbnail" width="109"
                                    height="122">
                            </div>
                            @endforeach
                        </div>
                        <button class="thumb-up disabled"><i class="fas fa-chevron-left"></i></button>
                        <button class="thumb-down disabled"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-details">
                    <div class="product-navigation">
                        <ul class="breadcrumb breadcrumb-lg">
                            <li><a href="demo1.html"><i class="d-icon-home"></i></a></li>
                            <li><a href="#" class="active">Products</a></li>
                            <li>{{ $product->name }}</li>
                        </ul>
                    </div>

                    <h1 class="product-name">{{ $product->name }}</h1>

                    <div class="product-price">
                        @if ($product->discount != 0)
                        <ins class="new-price">${{ $product->price - ($product->price*$product->discount/100) }}</ins><del class="old-price">${{ $product->price }}</del>
                        @else
                        <ins class="new-price">${{ $product->price }}</ins>
                        @endif
                    </div>





                    <div class="ratings-container">
                        <div class="ratings-full">
                            @php
                            if ($reviews_count != 0) {


                            $rating_total = 0;
                                foreach ($reviews as $item) {
                                $rating = $item->rating;
                                $rating_total += $rating;
                                }
                                $rating_point = $rating_total/$reviews_count;
                                $rating_persent = 100*$rating_point/5;
                                }
                            @endphp
                            <span class="ratings" style="width:{{ $reviews_count == 0 ? 0 : $rating_persent }}%"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <a href="#product-tab-reviews" class="link-to-tab rating-reviews">( {{ $reviews_count }} reviews )</a>
                    </div>
                    <p class="product-short-desc">{{ $product->des }}</p>

                    <hr class="product-divider">

                    <div class="product-form product-qty">
                        <form action="{{ route('front.cart.add_multiple') }}" method="POST">
                            @csrf
                        <div class="product-form-group">
                            <div class="input-group mr-2">
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <button type="button" class="quantity-minus d-icon-minus"></button>
                                <input class="quantity form-control" type="number" name="quantity" min="1" max="1000000">
                                <button type="button" class="quantity-plus d-icon-plus"></button>
                            </div>
                            <button type="submit" class="btn-product btn-cart-c text-normal ls-normal font-weight-semi-bold"><i
                                    class="d-icon-bag"></i>Add to
                                Cart</button>
                            </div>
                        </form>
                    </div>

                    <hr class="product-divider mb-3">
                    {{ url()->full }}

                    <div class="product-footer">
                        <div class="social-links mr-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full }}" class="social-link social-facebook fab fa-facebook-f"></a>
                            <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                            <a href="#" class="social-link social-pinterest fab fa-pinterest-p"></a>
                        </div>
                        <span class="divider d-lg-show"></span>
                        <div class="product-action">
                            <a href="{{ route('front.wishlist.add', $product->id) }}" class=" btn-wishlist mr-6"><i class="d-icon-heart"></i>Add to
                                wishlist</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab tab-nav-simple tab-nav-center product-tabs mb-4">
            <ul class="nav nav-tabs justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#product-tab-description">Description</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#product-tab-reviews">Reviews ({{ $reviews_count }})</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active in" id="product-tab-description">
                    <div class="row mt-6">
                        <div class="col-md-6">
                            <h5 class="description-title mb-4 font-weight-semi-bold ls-m">Features</h5>
                            <p class="mb-2">
                                Praesent id enim sit amet.Tdio vulputate eleifend in in tortor.
                                ellus massa. siti iMassa ristique sit amet condim vel, facilisis
                                quimequistiqutiqu amet condim Dilisis Facilisis quis sapien. Praesent id
                                enim sit amet.
                            </p>
                            <ul class="mb-8">
                                <li>Praesent id enim sit amet.Tdio vulputate</li>
                                <li>Eleifend in in tortor. ellus massa.Dristique sitii</li>
                                <li>Massa ristique sit amet condim vel</li>
                                <li>Dilisis Facilisis quis sapien. Praesent id enim sit amet</li>
                            </ul>
                            <h5 class="description-title mb-3 font-weight-semi-bold ls-m">Specifications
                            </h5>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th class="font-weight-semi-bold text-dark pl-0">Material</th>
                                        <td class="pl-4">Praesent id enim sit amet.Tdio</td>
                                    </tr>
                                    <tr>
                                        <th class="font-weight-semi-bold text-dark pl-0">Claimed Size</th>
                                        <td class="pl-4">Praesent id enim sit</td>
                                    </tr>
                                    <tr>
                                        <th class="font-weight-semi-bold text-dark pl-0">Recommended Use
                                        </th>
                                        <td class="pl-4">Praesent id enim sit amet.Tdio vulputate eleifend
                                            in in tortor. ellus massa. siti</td>
                                    </tr>
                                    <tr>
                                        <th class="font-weight-semi-bold text-dark border-no pl-0">
                                            Manufacturer</th>
                                        <td class="border-no pl-4">Praesent id enim</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 pl-md-6 pt-4 pt-md-0">
                            <h5 class="description-title font-weight-semi-bold ls-m mb-5">Video Description
                            </h5>
                            <figure class="p-relative d-inline-block mb-3">
                                <img src="images/product/product.jpg" width="559" height="370" alt="Product" />
                                <a class="btn-play btn-iframe" href="video/memory-of-a-woman.mp4">
                                    <i class="d-icon-play-solid"></i>
                                </a>
                            </figure>
                            <div class="icon-box-wrap d-flex flex-wrap">
                                <div class="icon-box icon-box-side icon-border pt-2 pb-2 mb-4 mr-10">
                                    <div class="icon-box-icon">
                                        <i class="d-icon-lock"></i>
                                    </div>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title lh-1 pt-1 ls-s text-normal">2 year
                                            warranty</h4>
                                        <p>Guarantee with no doubt</p>
                                    </div>
                                </div>
                                <div class="divider d-xl-show mr-10"></div>
                                <div class="icon-box icon-box-side icon-border pt-2 pb-2 mb-4">
                                    <div class="icon-box-icon">
                                        <i class="d-icon-truck"></i>
                                    </div>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title lh-1 pt-1 ls-s text-normal">Free shipping
                                        </h4>
                                        <p>On orders over $50.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane " id="product-tab-reviews">
                    <div class="comments mb-8 pt-2 pb-2 border-no">
                        <ul>
                            @foreach ($reviews as $item)


                            <li>
                                <div class="comment">
                                    <figure class="comment-media">
                                        <a href="#">
                                            <img src="{{ asset('upload/users') }}/{{App\Models\User::find($item->user)->img }}" alt="avatar">
                                        </a>
                                    </figure>
                                    <div class="comment-body">
                                        <div class="comment-rating ratings-container mb-0">
                                            <div class="ratings-full">

                                                <span class="ratings" style="width:{{ 100*$item->rating/5 }}%"></span>
                                                <span class="tooltiptext tooltip-top">{{ $item->rating }}.00</span>
                                            </div>
                                        </div>
                                        <div class="comment-user">
                                            <span class="comment-date text-body">{{ $item->created_at->format('M d, Y ') }}at{{ $item->created_at->format(' h:i A') }}</span>
                                            <h4><a href="#">{{App\Models\User::find($item->user)->name }}</a></h4>
                                        </div>

                                        <div class="comment-content">
                                            <p>{{ $item->comment }}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    <!-- End Comments -->
                    <form action="{{ route('front.review.add') }}" method="post">
                        @csrf
                        <div class="reply">
                            <div class="title-wrapper text-left">
                                <h3 class="title title-simple text-left text-normal">Add a Review</h3>
                            </div>

                            <input type="hidden" value="{{ $product->id }}" name="product">

                            <div class="rating-form">
                                <label for="rating" class="text-dark">Your rating * </label>
                                <select name="rating" id="rating" class="form-control">
                                    <option value="">Rate…</option>
                                    <option value="5">Perfect</option>
                                    <option value="4">Good</option>
                                    <option value="3">Average</option>
                                    <option value="2">Not that bad</option>
                                    <option value="1">Very poor</option>
                                </select>
                            </div>
                            <textarea name="comment" id="reply-message" cols="30" rows="6" class="form-control mb-4" placeholder="Comment *"></textarea>
                        </div>

                        @auth
                        <button type="submit" class="btn btn-prim ary btn-rounded">Submit<i class="d-icon-arrow-right"></i></button>
                        @else
                        <a class="btn btn-shadow btn-disabled">Submit<i class="d-icon-arrow-right"></i></a>
                        <p>You cann't add any review, at first need your authentication*</p>
                        @endauth
                    </form>
                </div>
                    <!-- End Reply -->
            </div>
        </div>


        <section class="pt-3 mt-10">
            <h2 class="title justify-content-center">Related Products</h2>

            <div class="owl-carousel owl-theme owl-nav-full row cols-2 cols-md-3 cols-lg-4" data-owl-options="{
                    'items': 5,
                    'nav': false,
                    'loop': false,
                    'dots': true,
                    'margin': 20,
                    'responsive': {
                        '0': {
                            'items': 2
                        },
                        '768': {
                            'items': 3
                        },
                        '992': {
                            'items': 4,
                            'dots': false,
                            'nav': true
                        }
                    }
                }">
                @include('include.frontend.product_item', [
                    'items' => $other_products,
                ])
            </div>

        </section>
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






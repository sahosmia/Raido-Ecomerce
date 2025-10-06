@extends('layouts.frontend')

@section('page_title', $product->name)

@section('content')
    <main class="main mt-8 single-product">
        <div class="page-content mb-10 pb-6">
            <div class="container">
                <div class="product product-single row mb-8">
                    <div class="col-md-6">
                        <div class="product-gallery pg-vertical">
                            <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1">
                                <figure class="product-image">
                                    <img src="{{ asset('upload/product/' . $product->img) }}"
                                        data-zoom-image="{{ asset('upload/product/' . $product->img) }}"
                                        alt="{{ $product->name }}" width="800" height="900">
                                </figure>
                                @foreach ($product_photos as $photo)
                                    <figure class="product-image">
                                        <img src="{{ asset('upload/product_photo/' . $photo->img) }}"
                                            data-zoom-image="{{ asset('upload/product_photo/' . $photo->img) }}"
                                            alt="{{ $product->name }}" width="800" height="900">
                                    </figure>
                                @endforeach
                            </div>
                            <div class="product-thumbs-wrap">
                                <div class="product-thumbs">
                                    <div class="product-thumb active">
                                        <img src="{{ asset('upload/product/' . $product->img) }}" alt="product thumbnail"
                                            width="109" height="122">
                                    </div>
                                    @foreach ($product_photos as $photo)
                                        <div class="product-thumb">
                                            <img src="{{ asset('upload/product_photo/' . $photo->img) }}"
                                                alt="product thumbnail" width="109" height="122">
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
                                    <li><a href="{{ route('front.index') }}"><i class="d-icon-home"></i></a></li>
                                    <li><a href="{{ route('front.shop') }}" class="active">Products</a></li>
                                    <li>{{ $product->name }}</li>
                                </ul>
                            </div>

                            <h1 class="product-name">{{ $product->name }}</h1>

                            <div class="product-price">
                                @if ($product->discounted_price < $product->price)
                                    <ins class="new-price">${{ $product->discounted_price }}</ins>
                                    <del class="old-price">${{ $product->price }}</del>
                                @else
                                    <ins class="new-price">${{ $product->price }}</ins>
                                @endif
                            </div>

                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width:{{ $rating_percent ?? 0 }}%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <a href="#product-tab-reviews" class="link-to-tab rating-reviews">(
                                    {{ $reviews_count }} reviews )</a>
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
                                            <input class="quantity form-control" type="number" name="quantity" min="1"
                                                max="1000000" value="1">
                                            <button type="button" class="quantity-plus d-icon-plus"></button>
                                        </div>
                                        <button type="submit"
                                            class="btn-product btn-cart-c text-normal ls-normal font-weight-semi-bold"><i
                                                class="d-icon-bag"></i>Add to Cart</button>
                                    </div>
                                </form>
                            </div>

                            <hr class="product-divider mb-3">

                            <div class="product-footer">
                                <div class="social-links mr-4">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}"
                                        target="_blank" class="social-link social-facebook fab fa-facebook-f"></a>
                                    <a href="https://twitter.com/intent/tweet?url={{ url()->full() }}" target="_blank"
                                        class="social-link social-twitter fab fa-twitter"></a>
                                    <a href="https://pinterest.com/pin/create/button/?url={{ url()->full() }}"
                                        target="_blank" class="social-link social-pinterest fab fa-pinterest-p"></a>
                                </div>
                                <span class="divider d-lg-show"></span>
                                <div class="product-action">
                                    <a href="{{ route('front.wishlist.add', $product->id) }}"
                                        class="btn-wishlist mr-6"><i class="d-icon-heart"></i>Add to wishlist</a>
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
                                <div class="col-12">
                                    <h5 class="description-title mb-4 font-weight-semi-bold ls-m">Product Description
                                    </h5>
                                    <p class="mb-2">{{ $product->des }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="product-tab-reviews">
                            <div class="comments mb-8 pt-2 pb-2 border-no">
                                <ul>
                                    @forelse ($reviews as $review)
                                        <li>
                                            <div class="comment">
                                                <figure class="comment-media">
                                                    <a href="#">
                                                        <img src="{{ asset('upload/users/' . ($review->user->img ?? 'default.png')) }}"
                                                            alt="avatar">
                                                    </a>
                                                </figure>
                                                <div class="comment-body">
                                                    <div class="comment-rating ratings-container mb-0">
                                                        <div class="ratings-full">
                                                            <span class="ratings"
                                                                style="width:{{ $review->rating * 20 }}%"></span>
                                                            <span
                                                                class="tooltiptext tooltip-top">{{ $review->rating }}.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="comment-user">
                                                        <span
                                                            class="comment-date text-body">{{ $review->created_at->format('M d, Y \a\t h:i A') }}</span>
                                                        <h4><a href="#">{{ $review->user->name ?? 'Anonymous' }}</a>
                                                        </h4>
                                                    </div>
                                                    <div class="comment-content">
                                                        <p>{{ $review->comment }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li>
                                            <p>No reviews yet. Be the first to write one!</p>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                            <!-- End Comments -->
                            <div class="reply">
                                <div class="title-wrapper text-left">
                                    <h3 class="title title-simple text-left text-normal">Add a Review</h3>
                                    <p>Your email address will not be published. Required fields are marked *</p>
                                </div>
                                <x-alert />
                                <form action="{{ route('front.review.add') }}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="product">
                                    <div class="rating-form">
                                        <label for="rating" class="text-dark">Your rating * </label>
                                        <select name="rating" id="rating"
                                            class="form-control @error('rating') is-invalid @enderror" required>
                                            <option value="">Rate…</option>
                                            <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>Perfect
                                            </option>
                                            <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>Good</option>
                                            <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>Average
                                            </option>
                                            <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>Not that bad
                                            </option>
                                            <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>Very poor
                                            </option>
                                        </select>
                                        @error('rating')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <textarea name="comment" id="reply-message" cols="30" rows="6"
                                        class="form-control mb-4 @error('comment') is-invalid @enderror"
                                        placeholder="Comment *" required>{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror

                                    @auth
                                        <button type="submit" class="btn btn-primary btn-rounded">Submit<i
                                                class="d-icon-arrow-right"></i></button>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary btn-rounded">Login to
                                            Review<i class="d-icon-arrow-right"></i></a>
                                        <p class="mt-2">You must be logged in to post a review.</p>
                                    @endauth
                                </form>
                            </div>
                            <!-- End Reply -->
                        </div>
                    </div>
                </div>

                @if ($other_products->count() > 0)
                    <section class="pt-3 mt-10">
                        <h2 class="title justify-content-center">Related Products</h2>
                        <div class="owl-carousel owl-theme owl-nav-full row cols-2 cols-md-3 cols-lg-4"
                            data-owl-options="{
                                'items': 5,
                                'nav': false,
                                'loop': false,
                                'dots': true,
                                'margin': 20,
                                'responsive': {
                                    '0': { 'items': 2 },
                                    '768': { 'items': 3 },
                                    '992': { 'items': 4, 'dots': false, 'nav': true }
                                }
                            }">
                            @include('include.frontend.product_item', [
                                'items' => $other_products,
                            ])
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </main>
@endsection
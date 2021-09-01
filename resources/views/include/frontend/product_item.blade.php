@foreach ($items as $item)
    <div class="product product-classic">
        <figure class="product-media">
            <a href="{{ url('front/product') }}/{{ $item->id }}"><img src="{{ asset('upload/product')}}/{{ $item->img }}" alt="product" width="280" height="315"/></a>
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
                <a href="{{ url('front/category/subcategory') }}/{{ $item->category }}/{{ 'null' }}">{{ App\Models\Category::find($item->category)->name }}</a>
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
                    @php
                        $reviews_count = App\Models\Review::where('product', $item->id)->count();
                        $reviews = App\Models\Review::where('product', $item->id)->get();
                        if ($reviews_count != 0) {
                            $rating_total = 0;
                            foreach ($reviews as $review) {
                                $rating = $review->rating;
                                $rating_total += $rating;
                            }
                            $rating_point = $rating_total/$reviews_count;
                            $rating_persent = 100*$rating_point/5;
                        }
                        @endphp
                    <span class="ratings" style="width: {{ $reviews_count == 0 ? 0 : $rating_persent }}%"></span>
                    <span class="tooltiptext tooltip-top"></span>
                </div>
                <a class="rating-reviews">( {{  $reviews_count }} reviews )</a>
            </div>
            <div class="product-action">
                <a href="{{ url('front/cart/product') }}/{{ $item->id }}" class="btn-cart" ><i class="d-icon-bag"></i><span>Add to cart</span></a>
                <a href="{{ url('front/wishlist/product_id') }}/{{ $item->id }}" class="btn-product-icon " title="Add to wishlist"><i class="d-icon-heart"></i></a>
            </div>
        </div>
    </div>
@endforeach

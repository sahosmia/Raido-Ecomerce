<h1 class="d-none">Riode - Responsive eCommerce HTML Template</h1>

  <header class="header header-border">
    <div class="header-top">
        <div class="container">
        <div class="header-left">
            <p class="welcome-msg">
            Welcome to Riode store message or remove it!
            </p>
        </div>
        <div class="header-right">
            <a href="{{ route('front.contact') }}" class="contact d-lg-show"><i class="d-icon-map"></i>Contact</a>
            @if (Route::has('login'))
                @auth
                <div class="dropdown ml-5">
                        <a class="login-link" href="{{ route('front.profile.index') }}" ><i class="d-icon-user"></i>{{ Auth::user()->name }}</a>
                        <ul class="dropdown-box">
                            <li>
                                <a href="{{ route('front.profile.index') }}">View Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('front.wishlist.index') }}">Wishlist</a>
                            </li>
                            <li>
                                <a href="{{ route('front.cart.index') }}">Cart</a>
                            </li>
                            @if (Auth::user()->role != 1)
                            <li>
                                <a href="{{ route('home') }}">Site Dashboard</a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ route('logout') }}" data-sidebar-target="#settings" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">Sign Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </div>
                @else
                    <a class="login-link" href="{{ route('login') }}" data-toggle="login-modal"><i class="d-icon-user"></i>Sign in</a>
                    @if (Route::has('register'))
                        <span class="delimiter">/</span>
                        <a class="register-link ml-0" href="{{ route('register') }}" data-toggle="login-modal">Register</a>
                    @endif
                @endauth
            @endif
            <!-- End of Login -->
        </div>
        </div>
    </div>
    <!-- End HeaderTop -->
    <div class="header-middle sticky-header fix-top sticky-content">
        <div class="container">
            <div class="header-left">
                <a href="#" class="mobile-menu-toggle"><i class="d-icon-bars2"></i></a>
                <a href="{{ route('front.index') }}" class="logo"><img src="{{ asset('frontend/images/logo.png')}}" alt="logo" width="153" height="44" /></a>
                <!-- End Logo -->

                <div class="header-search hs-simple">
                    <form action="{{ route('front.search') }}" method="GET" class="input-wrapper">
                        <input type="text" class="form-control" name="search" value="{{ old('search') }}" placeholder="Search..." />
                        <button class="btn btn-search" ><i class="d-icon-search"></i></button>
                    </form>
                </div>
                <!-- End Header Search -->
            </div>
            <div class="header-right">
                <a href="tel:#" class="icon-box icon-box-side">
                    <div class="icon-box-icon mr-0 mr-lg-2">
                        <i class="d-icon-phone"></i>
                    </div>
                    <div class="icon-box-content d-lg-show">
                        <h4 class="icon-box-title">Call Us Now:</h4>
                        <p>0(800) 123-456</p>
                    </div>
                </a>
                <span class="divider"></span>
                <a href="{{ route('front.wishlist.index') }}" class="wishlist"><i class="d-icon-heart"></i></a>
                <span class="divider"></span>
                <div class="dropdown cart-dropdown type2 cart-offcanvas mr-0 mr-lg-2">
                    <a href="#" class="cart-toggle label-block link">
                        <div class="cart-label d-lg-show">
                            @php
                            use App\Models\Cart;
                            use App\Models\Product;
                            $total_header = 0;
                                $cart_item_header = Cart::where('cookie', Cookie::get('cart'))->get();
                                $cart_item_count_header = Cart::where('cookie', Cookie::get('cart'))->count();
                                foreach ($cart_item_header as $item) {
                                    $total_header +=  Product::find($item->product)->price*$item->quantity;
                                }
                            @endphp
                            <span class="cart-name">Shopping Cart: </span>
                            <span class="cart-price">${{ Auth::check() == false ? '0.00' : $total_header }}</span>
                        </div>
                        @auth
                         @if(App\Models\Cart::where('cookie', Cookie::get('cart'))->exists())
                        <i class="d-icon-bag"><span class="cart-count">{{ $cart_item_count_header  }}</span></i>
                        @endif
                        @endauth
                    </a>

                    <div class="cart-overlay"></div>
                    <!-- End Cart Toggle -->

                    <div class="dropdown-box">
                        <div class="cart-header">
                            <h4 class="cart-title">Shopping Cart</h4>
                            <a href="#" class="btn btn-dark btn-link btn-icon-right btn-close">close<i class="d-icon-arrow-right"></i><span class="sr-only">Cart</span></a>
                        </div>
                    @auth

                        @forelse ($cart_item_header as $item)
                        <div class="products scrollable">
                            <div class="product product-cart">
                                <figure class="product-media">
                                <a href="{{ route('front.product.view_single', ['id' => $item->product]) }}">
                                    <img src="{{ asset('upload/product') }}/{{ Product::find($item->product)->img }}" alt="product" width="80" height="88"/>
                                </a>
                                <a href="{{ route('front.cart.delete', ['id' => $item->product]) }}" class="btn btn-link btn-close"><i class="fas fa-times"></i><span class="sr-only">Close</span></a>
                                </figure>
                                <div class="product-detail">
                                    <a href="{{ route('front.product.view_single', ['id' => $item->product]) }}" class="product-name">{{ Product::find($item->product)->name }}</a>
                                    <div class="price-box">
                                        <span class="product-quantity">{{ $item->quantity }}</span>
                                        <span class="product-price">${{ Product::find($item->product)->price }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Cart Product -->
                        </div>
                        <!-- End of Products  -->
                        @empty
                         <div class="products scrollable">
                            <div class="product product-cart">
                                <div class="alert alert-primary alert-simple alert-btn">
                                    <a href="{{ route('front.category.subcategory', ['category' => 'all', 'subcategory' => 'all']) }}" class="btn btn-primary btn-md btn-rounded">Continue Shoping</a>
                                    You have no cart item
                                </div>
                            </div>
                        </div>
                        @endforelse


                        @if(App\Models\Cart::where('cookie', Cookie::get('cart'))->exists())
                        <div class="cart-total">
                            <label>Subtotal:</label>
                            <span class="price">${{ $total_header }}</span>
                        </div>
                        <!-- End of Cart Total -->

                        <div class="cart-action">
                            <a href="{{ route('front.cart.index') }}" class="btn btn-dark btn-link">View Cart</a>
                            <a href="{{ route('front.checkout.index') }}" class="btn btn-dark"><span>Go To Checkout</span></a>
                        </div>
                        @endif
                        <!-- End of Cart Action -->
                    @else
                    <div class="products scrollable">
                        <div class="product product-cart">
                            <div class="alert alert-primary alert-simple alert-btn">
                                <a href="{{ route('login') }}" class="btn btn-primary btn-md btn-rounded">login</a>
                                Login First
                            </div>
                        </div>
                    </div>
                    @endauth
                    </div>
                    <!-- End Dropdown Box -->
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom d-lg-show">
        <div class="container">
        <div class="header-left">
            <nav class="main-nav">
            <ul class="menu">
                <li class="active">
                    <a href="{{ route('front.index') }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('front.category.subcategory', ['category' => 'all', 'subcategory' => 'all']) }}">Products</a>
                </li>
                <li>
                <a href="#">Category</a>
                <ul>
                    @foreach (App\Models\Category::all() as $item)
                    <li><a href="{{ route('front.category.subcategory', ['category' => $item->id, 'subcategory' => 'null']) }}">{{ $item->name }}</a></li>
                    @endforeach
                </ul>
                </li>
                <li>
                    <a href="{{ route('front.about') }}">About US</a>
                </li>

            </ul>
            </nav>
        </div>
        <div class="header-right">
            <a href="#"><i class="d-icon-card"></i>Special Offers</a>
        </div>
        </div>
    </div>
  </header>
    <!-- End Header -->

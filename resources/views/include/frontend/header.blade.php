<h1 class="d-none">Riode - Responsive eCommerce HTML Template</h1>

  <header class="header">
    <div class="header-top">
        <div class="container">
        <div class="header-left">
            <p class="welcome-msg">
            Welcome to Riode store message or remove it!
            </p>
        </div>
        <div class="header-right">
            <a href="{{ route('front_contact_us') }}" class="contact d-lg-show"><i class="d-icon-map"></i>Contact</a>
            <a href="#" class="help d-lg-show"><i class="d-icon-info"></i> Need Help</a>

            @if (Route::has('login'))
                @auth

                <div class="dropdown ml-5">
                        <a class="login-link" href="{{ route('front_profile') }}" ><i class="d-icon-user"></i>{{ Auth::user()->name }}</a>
                        <ul class="dropdown-box">
                            <li>
                                <a href="{{ route('front_profile') }}">View Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('front_dashboard') }}">Dashboard</a>
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
            <a href="{{ route('front') }}" class="logo"><img src="{{ asset('frontend/images/logo.png')}}" alt="logo" width="153" height="44" /></a>
            <!-- End Logo -->

            <div class="header-search hs-simple">
                <form action="#" class="input-wrapper">
                    <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search..." />
                    <button class="btn btn-search" type="submit"><i class="d-icon-search"></i></button>
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
            <a href="{{ route('wishlist') }}" class="wishlist"><i class="d-icon-heart"></i></a>
            <span class="divider"></span>
            <div class="dropdown cart-dropdown type2 cart-offcanvas mr-0 mr-lg-2">
                <a href="#" class="cart-toggle label-block link">
                    <div class="cart-label d-lg-show">

                        <span class="cart-name">Shopping Cart:
                        @php
                        use App\Models\Cart;
                        use App\Models\Product;
                        $total_header = 0;
                            $cart_item_header = Cart::where('cookie', Cookie::get('cart'))->get();
                            foreach ($cart_item_header as $item) {
                                $total_header +=  Product::find($item->product)->price*$item->quantity;
                            }
                        @endphp
                        </span>
                        <span class="cart-price">${{ Auth::check() == false ? '0.00' : $total_header }}</span>
                    </div>
                    <i class="d-icon-bag"><span class="cart-count">2</span></i>
                </a>
            <div class="cart-overlay"></div>
            <!-- End Cart Toggle -->
            <div class="dropdown-box">
                <div class="cart-header">
                    <h4 class="cart-title">Shopping Cart</h4>
                    <a href="#" class="btn btn-dark btn-link btn-icon-right btn-close">close<i class="d-icon-arrow-right"></i><span class="sr-only">Cart</span></a>
                </div>
                <div class="products scrollable">
                <div class="product product-cart">
                    <figure class="product-media">
                    <a href="product.html">
                        <img src="{{ asset('frontend/images/cart/product-1.jpg')}}" alt="product" width="80" height="88"/>
                    </a>
                    <button class="btn btn-link btn-close"><i class="fas fa-times"></i><span class="sr-only">Close</span></button>
                    </figure>
                    <div class="product-detail">
                    <a href="product.html" class="product-name">Riode White Trends</a>
                    <div class="price-box">
                        <span class="product-quantity">1</span>
                        <span class="product-price">$21.00</span>
                    </div>
                    </div>
                </div>
                <!-- End of Cart Product -->
                <div class="product product-cart">
                    <figure class="product-media">
                        <a href="product.html">
                            <img
                            src="{{ asset('frontend/images/cart/product-2.jpg')}}"
                            alt="product"
                            width="80"
                            height="88"
                            />
                        </a>
                        <button class="btn btn-link btn-close">
                            <i class="fas fa-times"></i
                            ><span class="sr-only">Close</span>
                        </button>
                    </figure>
                    <div class="product-detail">
                    <a href="product.html" class="product-name"
                        >Dark Blue Women’s Leomora Hat</a
                    >
                    <div class="price-box">
                        <span class="product-quantity">1</span>
                        <span class="product-price">$118.00</span>
                    </div>
                    </div>
                </div>
                <!-- End of Cart Product -->
                </div>
                <!-- End of Products  -->
                <div class="cart-total">
                <label>Subtotal:</label>
                <span class="price">$139.00</span>
                </div>
                <!-- End of Cart Total -->
                <div class="cart-action">
                <a href="cart.html" class="btn btn-dark btn-link"
                    >View Cart</a
                >
                <a href="checkout.html" class="btn btn-dark"
                    ><span>Go To Checkout</span></a
                >
                </div>
                <!-- End of Cart Action -->
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
                <a href="{{ route('front') }}">Home</a>
                </li>
                <li>
                <a href="product.html">Products</a>
                <div class="megamenu">
                    <div class="row">
                    <div class="col-6 col-sm-4 col-md-3 col-lg-4">
                        <h4 class="menu-title">Product Pages</h4>
                        <ul>
                        <li>
                            <a href="product-sticky-cart.html">Add Cart Sticky<span class="tip tip-hot">Hot</span></a>
                        </li>
                        <li>
                            <a href="product-tabinside.html">Tab Inside</a>
                        </li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-4 col-md-3 col-lg-4">
                        <h4 class="menu-title">Product Layouts</h4>
                        <ul>
                        <li>
                            <a href="product-grid.html"
                            >Grid Images<span class="tip tip-new"
                                >New</span
                            ></a
                            >
                        </li>
                        <li><a href="product-masonry.html">Masonry</a></li>



                        </ul>
                    </div>
                    <div
                        class="
                        col-6 col-sm-4 col-md-3 col-lg-4
                        menu-banner menu-banner2
                        banner banner-fixed
                        "
                    >
                        <figure>
                        <img
                            src="{{ asset('frontend/images/menu/banner-2.jpg')}}"
                            alt="Menu banner"
                            width="221"
                            height="330"
                        />
                        </figure>
                        <div class="banner-content x-50 text-center">
                        <h3 class="banner-title text-white text-uppercase">
                            Sunglasses
                        </h3>
                        <h4
                            class="
                            banner-subtitle
                            font-weight-bold
                            text-white
                            mb-0
                            "
                        >
                            $23.00 - $120.00
                        </h4>
                        </div>
                    </div>
                    <!-- End MegaMenu -->
                    </div>
                </div>
                </li>
                <li>
                <a href="#">Pages</a>
                <ul>
                    <li><a href="about-us.html">About</a></li>
                    <li><a href="contact-us.html">Contact Us</a></li>

                </ul>
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

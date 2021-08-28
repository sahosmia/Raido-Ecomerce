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
                        <a class="login-link" href="{{ url('/home') }}" ><i class="d-icon-user"></i>{{ Auth::user()->name }}</a>
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
              <a href="#" class="mobile-menu-toggle">
                <i class="d-icon-bars2"></i>
              </a>
              <a href="{{ route('front') }}" class="logo">
                <img src="{{ asset('frontend/images/logo.png')}}" alt="logo" width="153" height="44" />
              </a>
              <!-- End Logo -->

              <div class="header-search hs-simple">
                <form action="#" class="input-wrapper">
                  <input
                    type="text"
                    class="form-control"
                    name="search"
                    autocomplete="off"
                    placeholder="Search..."
                    required
                  />
                  <button class="btn btn-search" type="submit">
                    <i class="d-icon-search"></i>
                  </button>
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
              <a href="wishlist.html" class="wishlist">
                <i class="d-icon-heart"></i>
              </a>
              <span class="divider"></span>
              <div
                class="dropdown cart-dropdown type2 cart-offcanvas mr-0 mr-lg-2"
              >
                <a href="#" class="cart-toggle label-block link">
                  <div class="cart-label d-lg-show">
                    <span class="cart-name">Shopping Cart:</span>
                    <span class="cart-price">$0.00</span>
                  </div>
                  <i class="d-icon-bag"><span class="cart-count">2</span></i>
                </a>
                <div class="cart-overlay"></div>
                <!-- End Cart Toggle -->
                <div class="dropdown-box">
                  <div class="cart-header">
                    <h4 class="cart-title">Shopping Cart</h4>
                    <a
                      href="#"
                      class="btn btn-dark btn-link btn-icon-right btn-close"
                      >close<i class="d-icon-arrow-right"></i
                      ><span class="sr-only">Cart</span></a
                    >
                  </div>
                  <div class="products scrollable">
                    <div class="product product-cart">
                      <figure class="product-media">
                        <a href="product.html">
                          <img
                            src="{{ asset('frontend/images/cart/product-1.jpg')}}"
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
                          >Riode White Trends</a
                        >
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
                    <a href="demo1.html">Home</a>
                  </li>
                  <li>
                    <a href="shop.html">Categories</a>
                    <div class="megamenu">
                      <div class="row">
                        <div class="col-6 col-sm-4 col-md-3 col-lg-4">
                          <h4 class="menu-title">Variations 1</h4>
                          <ul>
                            <li>
                              <a href="shop-banner-sidebar.html"
                                >Banner With Sidebar</a
                              >
                            </li>
                            <li>
                              <a href="shop-boxed-banner.html">Boxed Banner</a>
                            </li>
                            <li>
                              <a href="shop-infinite-scroll.html"
                                >Infinite Ajaxscroll</a
                              >
                            </li>
                            <li>
                              <a href="shop-horizontal-filter.html"
                                >Horizontal Filter</a
                              >
                            </li>
                            <li>
                              <a href="shop-navigation-filter.html"
                                >Navigation Filter<span class="tip tip-hot"
                                  >Hot</span
                                ></a
                              >
                            </li>

                            <li>
                              <a href="shop-off-canvas.html"
                                >Off-Canvas Filter</a
                              >
                            </li>
                            <li>
                              <a href="shop-right-sidebar.html"
                                >Right Toggle Sidebar</a
                              >
                            </li>
                          </ul>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 col-lg-4">
                          <h4 class="menu-title">Variations 2</h4>
                          <ul>
                            <li>
                              <a href="shop-grid-3cols.html"
                                >3 Columns Mode<span class="tip tip-new"
                                  >New</span
                                ></a
                              >
                            </li>
                            <li>
                              <a href="shop-grid-4cols.html">4 Columns Mode</a>
                            </li>
                            <li>
                              <a href="shop-grid-5cols.html">5 Columns Mode</a>
                            </li>
                            <li>
                              <a href="shop-grid-6cols.html">6 Columns Mode</a>
                            </li>
                            <li>
                              <a href="shop-grid-7cols.html">7 Columns Mode</a>
                            </li>
                            <li>
                              <a href="shop-grid-8cols.html">8 Columns Mode</a>
                            </li>
                            <li><a href="shop-list.html">List Mode</a></li>
                          </ul>
                        </div>
                        <div
                          class="
                            col-6 col-sm-4 col-md-3 col-lg-4
                            menu-banner menu-banner1
                            banner banner-fixed
                          "
                        >
                          <figure>
                            <img
                              src="{{ asset('frontend/images/menu/banner-1.jpg')}}"
                              alt="Menu banner"
                              width="221"
                              height="330"
                            />
                          </figure>
                          <div class="banner-content y-50">
                            <h4
                              class="
                                banner-subtitle
                                font-weight-bold
                                text-primary
                                ls-m
                              "
                            >
                              Sale.
                            </h4>
                            <h3 class="banner-title font-weight-bold">
                              <span class="text-uppercase">Up to</span>70% Off
                            </h3>
                            <a
                              href="shop.html"
                              class="btn btn-link btn-underline"
                              >shop now<i class="d-icon-arrow-right"></i
                            ></a>
                          </div>
                        </div>
                        <!-- End Megamenu -->
                      </div>
                    </div>
                  </li>
                  <li>
                    <a href="product.html">Products</a>
                    <div class="megamenu">
                      <div class="row">
                        <div class="col-6 col-sm-4 col-md-3 col-lg-4">
                          <h4 class="menu-title">Product Pages</h4>
                          <ul>
                            <li>
                              <a href="product-simple.html">Simple Product</a>
                            </li>
                            <li><a href="product.html">Variable Product</a></li>
                            <li>
                              <a href="product-sale.html">Sale Product</a>
                            </li>
                            <li>
                              <a href="product-featured.html"
                                >Featured &amp; On Sale</a
                              >
                            </li>

                            <li>
                              <a href="product-left-sidebar.html"
                                >With Left Sidebar</a
                              >
                            </li>
                            <li>
                              <a href="product-right-sidebar.html"
                                >With Right Sidebar</a
                              >
                            </li>
                            <li>
                              <a href="product-sticky-cart.html"
                                >Add Cart Sticky<span class="tip tip-hot"
                                  >Hot</span
                                ></a
                              >
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
                            <li>
                              <a href="product-gallery.html">Gallery Type</a>
                            </li>
                            <li>
                              <a href="product-full.html">Full Width Layout</a>
                            </li>
                            <li>
                              <a href="product-sticky.html">Sticky Info</a>
                            </li>
                            <li>
                              <a href="product-sticky-both.html"
                                >Left &amp; Right Sticky</a
                              >
                            </li>
                            <li>
                              <a href="product-horizontal.html"
                                >Horizontal Thumb</a
                              >
                            </li>

                            <li><a href="#">Build Your Own</a></li>
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
                      <li><a href="account.html">My Account</a></li>
                      <li><a href="wishlist.html">Wishlist</a></li>
                      <li><a href="faq.html">FAQs</a></li>
                      <li><a href="error-404.html">Error 404</a></li>
                      <li><a href="coming-soon.html">Coming Soon</a></li>
                    </ul>
                  </li>
                  <li class="d-xl-show">
                    <a href="#">Elements</a>
                    <ul>
                      <li><a href="element-products.html">Products</a></li>
                      <li><a href="element-typography.html">Typography</a></li>
                      <li><a href="element-titles.html">Titles</a></li>
                      <li>
                        <a href="element-categories.html">Product Category</a>
                      </li>
                      <li><a href="element-buttons.html">Buttons</a></li>
                      <li><a href="element-accordions.html">Accordions</a></li>
                      <li>
                        <a href="element-alerts.html"
                          >Alert &amp; Notification</a
                        >
                      </li>
                      <li><a href="element-tabs.html">Tabs</a></li>
                      <li>
                        <a href="element-testimonials.html">Testimonials</a>
                      </li>
                      <li><a href="element-blog-posts.html">Blog Posts</a></li>
                      <li><a href="element-instagrams.html">Instagrams</a></li>
                      <li><a href="element-cta.html">Call to Action</a></li>
                      <li><a href="element-icon-boxes.html">Icon Boxes</a></li>
                      <li><a href="element-icons.html">Icons</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="blog-classic.html">Blog</a>
                    <ul>
                      <li><a href="blog-classic.html">Classic</a></li>
                      <li><a href="blog-listing.html">Listing</a></li>
                      <li>
                        <a href="#">Grid</a>
                        <ul>
                          <li>
                            <a href="blog-grid-2col.html">Grid 2 columns</a>
                          </li>
                          <li>
                            <a href="blog-grid-3col.html">Grid 3 columns</a>
                          </li>
                          <li>
                            <a href="blog-grid-4col.html">Grid 4 columns</a>
                          </li>
                          <li>
                            <a href="blog-grid-sidebar.html">Grid sidebar</a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="#">Masonry</a>
                        <ul>
                          <li>
                            <a href="blog-masonry-2col.html"
                              >Masonry 2 columns</a
                            >
                          </li>
                          <li>
                            <a href="blog-masonry-3col.html"
                              >Masonry 3 columns</a
                            >
                          </li>
                          <li>
                            <a href="blog-masonry-4col.html"
                              >Masonry 4 columns</a
                            >
                          </li>
                          <li>
                            <a href="blog-masonry-sidebar.html"
                              >Masonry sidebar</a
                            >
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="#">Mask</a>
                        <ul>
                          <li>
                            <a href="blog-mask-grid.html">Blog mask grid</a>
                          </li>
                          <li>
                            <a href="blog-mask-masonry.html"
                              >Blog mask masonry</a
                            >
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="post-single.html">Single Post</a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="about-us.html">About Us</a>
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

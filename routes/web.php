<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Contact_informationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\BlankController;

// Frontend Routes
Route::name('front.')->group(function () {
    // Frontend pages
    Route::get('/', [FrontendController::class, 'index'])->name('index');
    Route::get('about', [FrontendController::class, 'about'])->name('about');
    Route::get('shop', [FrontendController::class, 'shop'])->name('shop');
    Route::get('search', [FrontendController::class, 'search'])->name('search');
    Route::get('contact-us', [FrontendController::class, 'contact_us'])->name('contact');
    Route::get('categories/{category}/subcategories/{subcategory}', [FrontendController::class, 'allproduct'])->name('category.subcategory');
    Route::get('products/{product}', [FrontendController::class, 'product_view_single'])->name('product.view');

    // Wishlist Routes
    Route::prefix('wishlist')->name('wishlist.')->middleware('auth')->group(function () {
        Route::get('/', [WishlistController::class, 'wishlist'])->name('index');
        Route::post('add/{product}', [WishlistController::class, 'wishlistadd'])->name('add');
        Route::delete('delete/{wishlist}', [WishlistController::class, 'wishlistdelete'])->name('delete');
    });

    // Cart Routes
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'cart'])->name('index');
        Route::post('add/{product}', [CartController::class, 'cartadd'])->name('add');
        Route::post('add-multiple', [CartController::class, 'cartaddmultiple'])->name('add_multiple');
        Route::delete('delete/{cart}', [CartController::class, 'cartdelete'])->name('delete');
        Route::post('update', [CartController::class, 'update_cart'])->name('update');
        Route::post('coupon', [CartController::class, 'applyCoupon'])->name('coupon.apply');
    });

    // Checkout Routes
    Route::prefix('checkout')->name('checkout.')->middleware('auth')->group(function () {
        Route::get('/', [CheckoutController::class, 'checkout'])->name('index');
        Route::post('get-district-name', [CheckoutController::class, 'getdistrictname'])->name('get_district_name');
    });

    // Order Routes
    Route::prefix('order')->name('order.')->middleware('auth')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::post('/', [OrderController::class, 'order_submit'])->name('submit');
    });

    // Profile Routes
    Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {
        Route::get('/', [ProfileController::class, 'front_profile'])->name('index');
        Route::put('update', [ProfileController::class, 'profile_update'])->name('update');

        Route::prefix('users')->name('users.')->group(function () {
            Route::get('create', [ProfileController::class, 'adduser'])->name('create');
            Route::post('/', [ProfileController::class, 'adduserinsert'])->name('store');
        });
    });

    // Review Routes
    Route::post('reviews', [ReviewController::class, 'review_add'])->name('review.store');
});

// Message Routes
Route::prefix('messages')->name('messages.')->group(function () {
    Route::post('/', [MessageController::class, 'message_add'])->name('store');
    Route::middleware('auth')->group(function () {
        Route::get('{message}', [MessageController::class, 'message_view'])->name('show');
        Route::delete('{message}', [MessageController::class, 'message_delete'])->name('destroy');
    });
});

// Home
Auth::routes();
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('profile', [ProfileController::class, 'index'])->name('profile');

// Blank Page
Route::get('blank', [BlankController::class, 'index'])->name('blank');
Route::get('blank-form', [BlankController::class, 'blank_form'])->name('blank_form');
Route::post('blank-form-submit', [BlankController::class, 'blank_form_submit'])->name('blank_form_submit');

// SSLCOMMERZ Routes
Route::prefix('sslcommerz')->name('sslcommerz.')->group(function () {
    Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout'])->name('example1');
    Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout'])->name('example2');
    Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
    Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax'])->name('pay_via_ajax');
    Route::post('/success', [SslCommerzPaymentController::class, 'success'])->name('success');
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail'])->name('fail');
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel'])->name('cancel');
    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn'])->name('ipn');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Category Routes
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('trashed', [CategoryController::class, 'trashed'])->name('trashed');
        Route::post('{category}/restore', [CategoryController::class, 'restore'])->name('restore')->withTrashed();
        Route::delete('{category}/force-delete', [CategoryController::class, 'forceDelete'])->name('forceDelete')->withTrashed();
        Route::post('get-subcategories', [CategoryController::class, 'getSubcategories'])->name('getSubcategories');
    });
    Route::resource('categories', CategoryController::class);

    // Product Routes
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('trashed', [ProductController::class, 'trashed'])->name('trashed');
        Route::post('{product}/restore', [ProductController::class, 'restore'])->name('restore')->withTrashed();
        Route::delete('{product}/force-delete', [ProductController::class, 'forceDelete'])->name('forceDelete')->withTrashed();

        // Product Photos Routes
        Route::get('{product}/photos', [ProductController::class, 'view_product_photo'])->name('photos.index');
        Route::get('{product}/photos/create', [ProductController::class, 'addproductphoto'])->name('photos.create');
        Route::post('{product}/photos', [ProductController::class, 'addproductphotoinsert'])->name('photos.store');
        Route::delete('photos/{photo}', [ProductController::class, 'delete_product_photo'])->name('photos.destroy');
    });
    Route::resource('products', ProductController::class);

    // Brand Routes
    Route::prefix('brands')->name('brands.')->group(function () {
        Route::get('trashed', [BrandController::class, 'trashed'])->name('trashed');
        Route::post('{brand}/restore', [BrandController::class, 'restore'])->name('restore')->withTrashed();
        Route::delete('{brand}/force-delete', [BrandController::class, 'forceDelete'])->name('forceDelete')->withTrashed();
    });
    Route::resource('brands', BrandController::class);

    // SubCategory Routes
    Route::prefix('subcategories')->name('subcategories.')->group(function () {
        Route::get('trashed', [SubcategoryController::class, 'trashed'])->name('trashed');
        Route::post('{subcategory}/restore', [SubcategoryController::class, 'restore'])->name('restore')->withTrashed();
        Route::delete('{subcategory}/force-delete', [SubcategoryController::class, 'forceDelete'])->name('forceDelete')->withTrashed();
    });
    Route::resource('subcategories', SubcategoryController::class);

    // Coupon Routes
    Route::prefix('coupons')->name('coupons.')->group(function () {
        Route::get('trashed', [CuponController::class, 'trashed'])->name('trashed');
        Route::post('{coupon}/restore', [CuponController::class, 'restore'])->name('restore')->withTrashed();
        Route::delete('{coupon}/force-delete', [CuponController::class, 'forceDelete'])->name('forceDelete')->withTrashed();
    });
    Route::resource('coupons', CuponController::class);

    // Testimonial Routes
    Route::prefix('testimonials')->name('testimonials.')->group(function () {
        Route::get('trashed', [TestimonialController::class, 'trashed'])->name('trashed');
        Route::post('{testimonial}/restore', [TestimonialController::class, 'restore'])->name('restore')->withTrashed();
        Route::delete('{testimonial}/force-delete', [TestimonialController::class, 'forceDelete'])->name('forceDelete')->withTrashed();
    });
    Route::resource('testimonials', TestimonialController::class);

    // Team Routes
    Route::prefix('teams')->name('teams.')->group(function () {
        Route::get('trashed', [TeamController::class, 'trashed'])->name('trashed');
        Route::post('{team}/restore', [TeamController::class, 'restore'])->name('restore')->withTrashed();
        Route::delete('{team}/force-delete', [TeamController::class, 'forceDelete'])->name('forceDelete')->withTrashed();
    });
    Route::resource('teams', TeamController::class);
});
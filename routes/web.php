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
    // Frontend page
    Route::get('/', [FrontendController::class, 'index'])->name('index');
    Route::get('about', [FrontendController::class, 'about'])->name('about');
    Route::get('search', [FrontendController::class, 'search'])->name('search');
    Route::get('contact-us', [FrontendController::class, 'contact_us'])->name('contact_us');
    Route::get('category/subcategory/{category}/{subcategory}', [FrontendController::class, 'allproduct'])->name('category.subcategory');
    Route::get('product/{id}', [FrontendController::class, 'product_view_single'])->name('product.view_single');

    // Wishlist Routes
    Route::prefix('wishlist')->name('wishlist.')->group(function () {
        Route::get('/', [WishlistController::class, 'wishlist'])->name('index');
        Route::get('add/{id}', [WishlistController::class, 'wishlistadd'])->name('add');
        Route::get('delete/{id}', [WishlistController::class, 'wishlistdelete'])->name('delete');
    });

    // Cart Routes
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'cart'])->name('index');
        Route::get('{coupon}', [CartController::class, 'cart'])->name('coupon');
        Route::get('add/{id}', [CartController::class, 'cartadd'])->name('add');
        Route::post('add-multiple', [CartController::class, 'cartaddmultiple'])->name('add_multiple');
        Route::get('delete/{id}', [CartController::class, 'cartdelete'])->name('delete');
        Route::post('update', [CartController::class, 'update_cart'])->name('update');
    });

    // Checkout Routes
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'checkout'])->name('index');
        Route::get('add/{id}', [CheckoutController::class, 'checkoutadd'])->name('add');
        Route::get('delete/{id}', [CheckoutController::class, 'checkoutdelete'])->name('delete');
        Route::post('get-district-name', [CheckoutController::class, 'getdistrictname'])->name('get_district_name');
    });

    // Order Routes
    Route::prefix('order')->name('order.')->group(function () {
        Route::post('submit', [OrderController::class, 'order_submit'])->name('submit');
        Route::get('/', [OrderController::class, 'index'])->name('index');
    });

    // Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'front_profile'])->name('index');
        Route::post('update', [ProfileController::class, 'profile_update'])->name('update');
        Route::get('add-user', [ProfileController::class, 'adduser'])->name('add_user');
        Route::post('add-user-insert', [ProfileController::class, 'adduserinsert'])->name('add_user_insert');
    });

    // Review Routes
    Route::post('review/add', [ReviewController::class, 'review_add'])->name('review.add');
});

// Message Routes
Route::prefix('message')->name('message.')->group(function () {
    Route::post('add', [MessageController::class, 'message_add'])->name('add');
    Route::get('delete/{id}', [MessageController::class, 'message_delete'])->name('delete');
    Route::get('view/{id}', [MessageController::class, 'message_view'])->name('view');
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
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('categories/trashed', [CategoryController::class, 'trashed'])->name('categories.trashed');
    Route::post('categories/restore/{category}', [CategoryController::class, 'restore'])->name('categories.restore')->withTrashed();
    Route::delete('categories/force-delete/{category}', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete')->withTrashed();
    Route::post('categories/get-subcategories', [CategoryController::class, 'getSubcategories'])->name('categories.getSubcategories');
    Route::resource('categories', CategoryController::class);

    // Product Routes
    Route::middleware('auth')->group(function () {
        Route::get('products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');
        Route::post('products/restore/{product}', [ProductController::class, 'restore'])->name('products.restore')->withTrashed();
        Route::delete('products/force-delete/{product}', [ProductController::class, 'forceDelete'])->name('products.forceDelete')->withTrashed();
        Route::resource('products', ProductController::class);
    });

    // Product Photos Routes
    Route::get('products/{product}/photos', [ProductController::class, 'view_product_photo'])->name('products.photos.index');
    Route::get('products/{product}/photos/create', [ProductController::class, 'addproductphoto'])->name('products.photos.create');
    Route::post('products/{product}/photos', [ProductController::class, 'addproductphotoinsert'])->name('products.photos.store');
    Route::delete('products/photos/{photo}', [ProductController::class, 'delete_product_photo'])->name('products.photos.destroy');

    // Brand Routes
    Route::get('brands/trashed', [BrandController::class, 'trashed'])->name('brands.trashed');
    Route::post('brands/restore/{id}', [BrandController::class, 'restore'])->name('brands.restore');
    Route::delete('brands/force-delete/{id}', [BrandController::class, 'forceDelete'])->name('brands.forceDelete');
    Route::resource('brands', BrandController::class);

    // SubCategory Routes
    Route::get('subcategories/trashed', [SubcategoryController::class, 'trashed'])->name('subcategories.trashed');
    Route::post('subcategories/restore/{id}', [SubcategoryController::class, 'restore'])->name('subcategories.restore');
    Route::delete('subcategories/force-delete/{id}', [SubcategoryController::class, 'forceDelete'])->name('subcategories.forceDelete');
    Route::resource('subcategories', SubcategoryController::class);

    // Cupon Routes
    Route::get('cupons/trashed', [CuponController::class, 'trashed'])->name('cupons.trashed');
    Route::post('cupons/restore/{id}', [CuponController::class, 'restore'])->name('cupons.restore');
    Route::delete('cupons/force-delete/{id}', [CuponController::class, 'forceDelete'])->name('cupons.forceDelete');
    Route::resource('cupons', CuponController::class);

    // Testimonial Routes
    Route::get('testimonials/trashed', [TestimonialController::class, 'trashed'])->name('testimonials.trashed');
    Route::post('testimonials/restore/{id}', [TestimonialController::class, 'restore'])->name('testimonials.restore');
    Route::delete('testimonials/force-delete/{id}', [TestimonialController::class, 'forceDelete'])->name('testimonials.forceDelete');
    Route::resource('testimonials', TestimonialController::class);

    // Team Routes
    Route::get('teams/trashed', [TeamController::class, 'trashed'])->name('teams.trashed');
    Route::post('teams/restore/{id}', [TeamController::class, 'restore'])->name('teams.restore');
    Route::delete('teams/force-delete/{id}', [TeamController::class, 'forceDelete'])->name('teams.forceDelete');
    Route::resource('teams', TeamController::class);
});
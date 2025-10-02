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

// Frontend page
Route::get('/', [FrontendController::class, 'index'])->name('front');
Route::get('about', [FrontendController::class, 'about'])->name('about');
Route::get('front_search', [FrontendController::class, 'search']);
Route::get('front/contact_us', [FrontendController::class, 'contact_us'])->name('front_contact_us');
Route::get('front/category/subcategory/{category}/{subcategory}', [FrontendController::class, 'allproduct']);
Route::get('front/product/{id}', [FrontendController::class, 'product_view_single']);

// Wishlist Controller page
Route::get('front/wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
Route::get('front/wishlist/product_id/{id}', [WishlistController::class, 'wishlistadd']);
Route::get('front/wishlist/delete/product_id/{id}', [WishlistController::class, 'wishlistdelete']);

// Cart Controller page
Route::get('front/cart', [CartController::class, 'cart'])->name('cart');
Route::get('front/cart/{coupon}', [CartController::class, 'cart']);
Route::get('front/cart/product/{id}', [CartController::class, 'cartadd']);
Route::post('front/cart/product/multiple/add', [CartController::class, 'cartaddmultiple'])->name('cartaddmultiple');
Route::get('front/cart/delete/product_id/{id}', [CartController::class, 'cartdelete']);
Route::post('front/cart/update', [CartController::class, 'update_cart'])->name('update_cart');

// checkout Controller page
Route::get('front/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('front/checkout/product_id/{id}', [CheckoutController::class, 'checkoutadd']);
Route::get('front/checkout/delete/product_id/{id}', [CheckoutController::class, 'checkoutdelete']);
Route::post('/front/getdistrictname', [CheckoutController::class, 'getdistrictname']);

// order Controller page
Route::post('/front/order_submit', [OrderController::class, 'order_submit'])->name('order_submit');
Route::get('/front/order', [OrderController::class, 'index'])->name('order');
Route::get('/order', [OrderController::class, 'order_backend'])->name('order_backend');

// ProfileController
Route::get('front/profile', [ProfileController::class, 'front_profile'])->name('front_profile');
Route::post('profile.update', [ProfileController::class, 'profile_update'])->name('profile_update');
Route::get('profile/adduser', [ProfileController::class, 'adduser'])->name('adduser');
Route::post('profile/adduserinsert', [ProfileController::class, 'adduserinsert'])->name('adduserinsert');

// Home
Auth::routes();
Route::get('home', [HomeController::class, 'index'])->name('home');

// black page
Route::get('blank', [BlankController::class, 'index'])->name('blank');
Route::get('blank_form', [BlankController::class, 'blank_form'])->name('blank_form');
Route::post('blank_form_submit', [BlankController::class, 'blank_form_submit'])->name('blank_form_submit');


// Review
Route::post('front.review_add', [ReviewController::class, 'review_add'])->name('review_add');






// Message
Route::post('message.add', [MessageController::class, 'message_add'])->name('message_add');
Route::get('message/delete/{id}', [MessageController::class, 'message_delete']);
Route::get('message/view/{id}', [MessageController::class, 'message_view']);
































// profail page
Route::get('profile', [ProfileController::class, 'index'])->name('profile');



// Testimonial


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('categories/trashed', [CategoryController::class, 'trashed'])->name('categories.trashed');
    Route::post('categories/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/force-delete/{id}', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
    Route::resource('categories', CategoryController::class);

    // Product Routes
    Route::get('products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');
    Route::post('products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('products/force-delete/{id}', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
    Route::post('products/get-subcategories', [ProductController::class, 'getSubcategories'])->name('products.getSubcategories');
    Route::resource('products', ProductController::class);

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




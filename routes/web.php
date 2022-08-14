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

// Category page
Route::get('category/recyclebin', [CategoryController::class, 'recyclebin'])->name('recyclebin_category');
Route::post('category/form_action', [CategoryController::class, 'form_action'])->name('category_form_action');
Route::get('category/soft_delete/{id}', [CategoryController::class, 'soft_delete']);
Route::get('category/p_delete/{id}', [CategoryController::class, 'p_delete']);
Route::get('category/restore/{id}', [CategoryController::class, 'restore']);
Route::get('category/action/{id}', [CategoryController::class, 'action']);
Route::get('category_soft_delete_all', [CategoryController::class, 'soft_delete_all'])->name('category_soft_delete_all');
Route::get('category_p_delete_all', [CategoryController::class, 'p_delete_all'])->name('category_p_delete_all');
Route::get('category_restore_all', [CategoryController::class, 'restore_all'])->name('category_restore_all');

// SubCategory page
Route::get('subcategory', [SubcategoryController::class, 'index'])->name('subcategory');
Route::get('subcategory/addsubcategory', [SubcategoryController::class, 'addsubcategory'])->name('addsubcategory');
Route::post('subcategory/addsubcategoryinsert', [SubcategoryController::class, 'addsubcategoryinsert'])->name('addsubcategoryinsert');
Route::get('subcategory/recyclebin', [SubcategoryController::class, 'recyclebin'])->name('recyclebin_subcategory');
Route::post('subcategory/update', [SubcategoryController::class, 'update'])->name('subcategory_update');
Route::post('subcategory/form_action', [SubcategoryController::class, 'form_action'])->name('subcategory_form_action');
Route::get('subcategory/view/{id}', [SubcategoryController::class, 'view_subcategory']);
Route::get('subcategory/update/{id}', [SubcategoryController::class, 'update_subcategory']);
Route::get('subcategory/soft_delete/{id}', [SubcategoryController::class, 'soft_delete']);
Route::get('subcategory/p_delete/{id}', [SubcategoryController::class, 'p_delete']);
Route::get('subcategory/restore/{id}', [SubcategoryController::class, 'restore']);
Route::get('subcategory/action/{id}', [SubcategoryController::class, 'action']);
Route::get('subcategory_soft_delete_all', [SubcategoryController::class, 'soft_delete_all'])->name('subcategory_soft_delete_all');
Route::get('subcategory_p_delete_all', [SubcategoryController::class, 'p_delete_all'])->name('subcategory_p_delete_all');
Route::get('subcategory_restore_all', [SubcategoryController::class, 'restore_all'])->name('subcategory_restore_all');

// Product
Route::get('product', [ProductController::class, 'index'])->name('product');
Route::get('product/addproduct', [ProductController::class, 'addproduct'])->name('addproduct');
Route::post('product/addproductinsert', [ProductController::class, 'addproductinsert'])->name('addproductinsert');
Route::get('product/recyclebin', [ProductController::class, 'recyclebin'])->name('recyclebin_product');
Route::post('product/update', [ProductController::class, 'update'])->name('product_update');
Route::post('addproduct/getsubcategory', [ProductController::class, 'getsubcategory']);
Route::post('product/form_action', [ProductController::class, 'form_action'])->name('product_form_action');
Route::get('product/view/{id}', [ProductController::class, 'view_product']);
Route::get('product/update/{id}', [ProductController::class, 'update_product']);
Route::post('product/img_update', [ProductController::class, 'img_update'])->name('product_img_update');
Route::get('product/soft_delete/{id}', [ProductController::class, 'soft_delete']);
Route::get('product/p_delete/{id}', [ProductController::class, 'p_delete']);
Route::get('product/restore/{id}', [ProductController::class, 'restore']);
Route::get('product/action/{id}', [ProductController::class, 'action']);
Route::get('product_soft_delete_all', [ProductController::class, 'soft_delete_all'])->name('product_soft_delete_all');
Route::get('product_p_delete_all', [ProductController::class, 'p_delete_all'])->name('product_p_delete_all');
Route::get('product_restore_all', [ProductController::class, 'restore_all'])->name('product_restore_all');

Route::get('product/product_photo/view/{id}', [ProductController::class, 'view_product_photo']);
Route::get('product/product_photo/action/{id}', [ProductController::class, 'action_product_photo']);
Route::get('product/product_photo/delete/{id}', [ProductController::class, 'delete_product_photo']);
Route::get('product_photo_delete_all', [ProductController::class, 'product_photo_delete_all'])->name('product_photo_delete_all');
Route::get('product/addproductphoto/{id}', [ProductController::class, 'addproductphoto']);
Route::post('product/addproductphotoinsert', [ProductController::class, 'addproductphotoinsert'])->name('addproductphotoinsert');

// Review
Route::post('front.review_add', [ReviewController::class, 'review_add'])->name('review_add');

// Cupon Controller
Route::get('cupon', [CuponController::class, 'index'])->name('cupon');
Route::get('cupon/addcupon', [CuponController::class, 'addcupon'])->name('addcupon');
Route::post('cupon/addcuponinsert', [CuponController::class, 'addcuponinsert'])->name('addcuponinsert');
Route::get('cupon/recyclebin', [CuponController::class, 'recyclebin'])->name('recyclebin_cupon');
Route::post('cupon/update', [CuponController::class, 'update'])->name('cupon_update');
Route::post('cupon/form_action', [CuponController::class, 'form_action'])->name('cupon_form_action');
Route::get('cupon/view/{id}', [CuponController::class, 'view_cupon']);
Route::get('cupon/update/{id}', [CuponController::class, 'update_cupon']);
Route::get('cupon/soft_delete/{id}', [CuponController::class, 'soft_delete']);
Route::get('cupon/p_delete/{id}', [CuponController::class, 'p_delete']);
Route::get('cupon/restore/{id}', [CuponController::class, 'restore']);
Route::get('cupon/action/{id}', [CuponController::class, 'action']);
Route::get('cupon_soft_delete_all', [CuponController::class, 'soft_delete_all'])->name('cupon_soft_delete_all');
Route::get('cupon_p_delete_all', [CuponController::class, 'p_delete_all'])->name('cupon_p_delete_all');
Route::get('cupon_restore_all', [CuponController::class, 'restore_all'])->name('cupon_restore_all');

// Brand
Route::get('brand', [BrandController::class, 'index'])->name('brand');
Route::get('brand/addbrand', [BrandController::class, 'addbrand'])->name('addbrand');
Route::post('brand/addbrandinsert', [BrandController::class, 'addbrandinsert'])->name('addbrandinsert');
Route::get('brand/recyclebin', [BrandController::class, 'recyclebin'])->name('recyclebin_brand');
Route::post('brand/update', [BrandController::class, 'update'])->name('brand_update');
Route::post('brand/form_action', [BrandController::class, 'form_action'])->name('brand_form_action');
Route::get('brand/view/{id}', [BrandController::class, 'view_brand']);
Route::get('brand/update/{id}', [BrandController::class, 'update_brand']);
Route::post('brand/img_update', [BrandController::class, 'img_update'])->name('brand_img_update');
Route::get('brand/soft_delete/{id}', [BrandController::class, 'soft_delete']);
Route::get('brand/p_delete/{id}', [BrandController::class, 'p_delete']);
Route::get('brand/restore/{id}', [BrandController::class, 'restore']);
Route::get('brand/action/{id}', [BrandController::class, 'action']);
Route::get('brand_soft_delete_all', [BrandController::class, 'soft_delete_all'])->name('brand_soft_delete_all');
Route::get('brand_p_delete_all', [BrandController::class, 'p_delete_all'])->name('brand_p_delete_all');
Route::get('brand_restore_all', [BrandController::class, 'restore_all'])->name('brand_restore_all');




// Message
Route::post('message.add', [MessageController::class, 'message_add'])->name('message_add');
Route::get('message/delete/{id}', [MessageController::class, 'message_delete']);
Route::get('message/view/{id}', [MessageController::class, 'message_view']);


// Testimonial
Route::get('testimonial', [TestimonialController::class, 'index'])->name('testimonial');


Route::get('testimonial/addtestimonial', [TestimonialController::class, 'addtestimonial'])->name('addtestimonial');
Route::post('testimonial/addtestimonialinsert', [TestimonialController::class, 'addtestimonialinsert'])->name('addtestimonialinsert');
Route::get('testimonial/recyclebin', [TestimonialController::class, 'recyclebin'])->name('recyclebin_testimonial');
Route::post('testimonial/update', [TestimonialController::class, 'update'])->name('testimonial_update');
Route::post('testimonial/form_action', [TestimonialController::class, 'form_action'])->name('testimonial_form_action');
Route::get('testimonial/view/{id}', [TestimonialController::class, 'view_testimonial']);
Route::get('testimonial/update/{id}', [TestimonialController::class, 'update_testimonial']);
Route::post('testimonial/img_update', [TestimonialController::class, 'img_update'])->name('testimonial_img_update');
Route::get('testimonial/soft_delete/{id}', [TestimonialController::class, 'soft_delete']);
Route::get('testimonial/p_delete/{id}', [TestimonialController::class, 'p_delete']);
Route::get('testimonial/restore/{id}', [TestimonialController::class, 'restore']);
Route::get('testimonial/action/{id}', [TestimonialController::class, 'action']);
Route::get('testimonial_soft_delete_all', [TestimonialController::class, 'soft_delete_all'])->name('testimonial_soft_delete_all');
Route::get('testimonial_p_delete_all', [TestimonialController::class, 'p_delete_all'])->name('testimonial_p_delete_all');
Route::get('testimonial_restore_all', [TestimonialController::class, 'restore_all'])->name('testimonial_restore_all');

























// Team
Route::get('team', [BrandController::class, 'index'])->name('team');

Route::get('team/addteam', [TeamController::class, 'addteam'])->name('addteam');
Route::post('team/addteaminsert', [TeamController::class, 'addteaminsert'])->name('addteaminsert');
Route::get('team/recyclebin', [TeamController::class, 'recyclebin'])->name('recyclebin_team');
Route::post('team/update', [TeamController::class, 'update'])->name('team_update');
Route::post('team/form_action', [TeamController::class, 'form_action'])->name('team_form_action');
Route::get('team/view/{id}', [TeamController::class, 'view_team']);
Route::get('team/update/{id}', [TeamController::class, 'update_team']);
Route::get('team/soft_delete/{id}', [TeamController::class, 'soft_delete']);
Route::get('team/p_delete/{id}', [TeamController::class, 'p_delete']);
Route::get('team/restore/{id}', [TeamController::class, 'restore']);
Route::get('team/action/{id}', [TeamController::class, 'action']);
Route::get('team_soft_delete_all', [TeamController::class, 'soft_delete_all'])->name('team_soft_delete_all');
Route::get('team_p_delete_all', [TeamController::class, 'p_delete_all'])->name('team_p_delete_all');
Route::get('team_restore_all', [TeamController::class, 'restore_all'])->name('team_restore_all');





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


    Route::resource('categories', CategoryController::class);

    Route::get('category/recyclebin', [CategoryController::class, 'recyclebin'])->name('recyclebin_category');
    Route::post('category/form_action', [CategoryController::class, 'form_action'])->name('category_form_action');
    Route::get('category/soft_delete/{id}', [CategoryController::class, 'soft_delete']);
    Route::get('category/p_delete/{id}', [CategoryController::class, 'p_delete']);
    Route::get('category/restore/{id}', [CategoryController::class, 'restore']);
    Route::get('category/action/{id}', [CategoryController::class, 'action']);
    Route::get('category_soft_delete_all', [CategoryController::class, 'soft_delete_all'])->name('category_soft_delete_all');
    Route::get('category_p_delete_all', [CategoryController::class, 'p_delete_all'])->name('category_p_delete_all');
    Route::get('category_restore_all', [CategoryController::class, 'restore_all'])->name('category_restore_all');

});




<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\Contact_informationController;

use App\Http\Controllers\BlankController;


// Frontend page
Route::get('/', [FrontendController::class, 'index'])->name('front');

// Home
Route::get('home', [HomeController::class, 'index'])->name('home');


// black page

Route::get('blank', [BlankController::class, 'index'])->name('blank');
Route::get('blank_form', [BlankController::class, 'blank_form'])->name('blank_form');
Route::post('blank_form_submit', [BlankController::class, 'blank_form_submit'])->name('blank_form_submit');







// Category page
Route::get('category', [CategoryController::class, 'index'])->name('category');
Route::get('category/addcategory', [CategoryController::class, 'addcategory'])->name('addcategory');
Route::get('category/recyclebin', [CategoryController::class, 'recyclebin'])->name('recyclebin_category');
Route::post('category/img_update', [CategoryController::class, 'img_update'])->name('category_img_update');
Route::post('category/update', [CategoryController::class, 'update'])->name('category_update');

// category delete and restore
Route::get('category/action/{id}', [CategoryController::class, 'action']);
Route::get('category/restore/{id}', [CategoryController::class, 'restore']);
Route::get('category/p_delete/{id}', [CategoryController::class, 'p_delete']);
Route::get('category/view/{id}', [CategoryController::class, 'view_category']);
Route::get('category/update/{id}', [CategoryController::class, 'update_category']);
Route::get('category/soft_delete/{id}', [CategoryController::class, 'soft_delete']);
Route::get('category_p_delete_all', [CategoryController::class, 'p_delete_all'])->name('category_p_delete_all');
Route::get('category_soft_delete_all', [CategoryController::class, 'soft_delete_all'])->name('category_soft_delete_all');
Route::post('category/form_action', [CategoryController::class, 'form_action'])->name('category_form_action');
Route::post('category/addcategoryinsert', [CategoryController::class, 'addcategoryinsert'])->name('addcategoryinsert');










// profail page
Route::get('profile', [ProfileController::class, 'index'])->name('profile');

// Product
Route::get('product', [ProductController::class, 'index'])->name('product');

// SubCategory page
Route::get('subcategory', [SubcategoryController::class, 'index'])->name('subcategory');


// Cupon Controller
Route::get('cupon', [CuponController::class, 'index'])->name('cupon');

// Cupon Controller
Route::get('order', [OrderController::class, 'index'])->name('order');

// Testimonial
Route::get('testimonial', [TestimonialController::class, 'index'])->name('tesimonial');

// Brand
Route::get('brand', [BrandController::class, 'index'])->name('brand');

// Message
Route::get('message', [MessageController::class, 'index'])->name('message');

// Riview
Route::get('review', [ReviewController::class, 'index'])->name('review');

// Setting
Route::get('setting', [SettingController::class, 'index'])->name('setting');

// Store
Route::get('store', [StoreController::class, 'index'])->name('store');

// Team
Route::get('team', [TeamController::class, 'index'])->name('team');

// Contact_information
Route::get('contact_information', [Contact_informationController::class, 'index'])->name('contact_information');

// Route::get('shop_page', [FrontendController::class, 'shop_page'])->name('shop_page');
// Route::get('shop_category/{category_id}', [FrontendController::class, 'shop_category']);
// Route::get('product/details/{product_id}', [FrontendController::class, 'product_details']);
// Route::get('serch', [FrontendController::class, 'serch'])->name('serch');



// // Add to Cart
// Route::get('cart', [AddtocartController::class, 'cart_view'])->name('cart_view');
// Route::get('add_to_cart_delete/{id}', [AddtocartController::class, 'add_to_cart_delete']);
// Route::get('cart/{cupon_code}', [AddtocartController::class, 'cart_view'])->name('cart_view');
// Route::post('cart.update', [AddtocartController::class, 'cart_update'])->name('cart_update');
// Route::post('add_to_cart', [AddtocartController::class, 'add_to_cart']);

// Cupon Controller
Route::get('cupon/cupon_add_page', [CuponController::class, 'cupon_add_page'])->name('cupon_add_page');
Route::post('cupon.insert', [CuponController::class, 'insert'])->name('cupon_insert');

// checkout page
Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('checkout.insert', [CheckoutController::class, 'checkout_insert']);
Route::post('getcitylist', [CheckoutController::class, 'getcitylist']);

// profail page
Route::get('profile/update', [ProfileController::class, 'profile_update']);
Route::post('profile/update.name', [ProfileController::class, 'update_name']);
Route::post('profile/update.email', [ProfileController::class, 'update_email']);
Route::post('profile/update.password', [ProfileController::class, 'update_password']);
Route::post('profile/update.profile_img', [ProfileController::class, 'update_profile_img']);

// category page
Route::get('category/add', [categoryController::class, 'add']);
Route::get('category/delete_all', [categoryController::class, 'delete_all']);
Route::get('category/trashed_item', [categoryController::class, 'trashed_item']);
Route::get('category/update_view/{category_id}', [categoryController::class, 'update_view']);
Route::get('category/restore/{restore_category_id}', [categoryController::class, 'restore']);
Route::get('category/soft_delete/{subcategory_id}',  [categoryController::class, 'soft_delete']);
Route::get('category/permanent_delete/{subcategory_id}', [categoryController::class, 'permanent_delete']);
Route::post('category.insert', [categoryController::class, 'insert']);
Route::post('category.update', [categoryController::class, 'update_action']);
Route::post('category/mark_delete', [categoryController::class, 'mark_delete']);

// Sub category
Route::get('subcategory/add', [SubcategoryController::class, 'add']);
Route::get('subcategory/trashed_item', [SubcategoryController::class, 'trashed_item']);
Route::get('subcategory/delete/{subcategory_id}',  [SubcategoryController::class, 'delete']);
Route::get('subcategory/update_view/{subcategory_id}', [SubcategoryController::class, 'update_view']);
Route::get('subcategory/restore/{restore_subcategory_id}', [SubcategoryController::class, 'restore']);
Route::get('subcategory/permanent_delete/{subcategory_id}', [SubcategoryController::class, 'permanent_delete']);
Route::post('subcategory.insert', [SubcategoryController::class, 'insert']);
Route::post('subcategory.update', [SubcategoryController::class, 'update']);

// Product
Route::get('product', [ProductController::class, 'index'])->name('product');
Route::get('product/add', [ProductController::class, 'add']);
Route::post('product.add_action', [ProductController::class, 'add_action']);


// Testimonial
Route::get('testimonial/add', [TestimonialController::class, 'add']);
Route::post('testimonial.add_action', [TestimonialController::class, 'insert']);

// home page
Auth::routes();
Route::get('home/invoice/{order_id}', [HomeController::class, 'pdf_download']);


// SSLCOMMERZ Start
Route::get('/online/payment', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

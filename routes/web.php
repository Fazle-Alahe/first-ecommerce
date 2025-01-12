<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PassResetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpecialOfferController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;
use App\Models\Inventory;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[FrontendController::class, 'welcome'])->name('index');


Route::get('/dashboard',[HomeController::class, 'dashboard'] )->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/product/details/{slug}',[FrontendController::class, 'product_details'])->name('product.details');
Route::get('/category/products/{id}', [FrontendController::class, 'category_products'])->name('category.product');
Route::get('/all/products/',[FrontendController::class, 'all_products'])->name('all.products');
Route::post('/getSize',[FrontendController::class, 'getSize']);
Route::post('/getQuantity',[FrontendController::class, 'getQuantity']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Banner
Route::get('/banner', [BannerController::class, 'banner'])->name('banner');
Route::post('/banner/store/', [BannerController::class, 'banner_store'])->name('banner.store');
Route::get('/banner/delete/{id}', [BannerController::class, 'banner_delete'])->name('banner.delete');

// logo
Route::get('/logo', [LogoController::class, 'logo'])->name('logo');
Route::post('/logo/store/', [LogoController::class, 'logo_store'])->name('logo.store');

// Offer
Route::get('/offer', [OfferController::class, 'offer'])->name('offer');
Route::post('/offer1/store', [OfferController::class, 'offer1_store'])->name('offer1.store');
Route::post('/offer2/store', [OfferController::class, 'offer2_store'])->name('offer2.store');

Route::get('/festival/offer/', [OfferController::class, 'festival_offer'])->name('festival.offer');
Route::post('/festival/offer/store/', [OfferController::class, 'festival_offer_store'])->name('festival.offer.store');

// Special Offer
Route::get('/special/offer/', [SpecialOfferController::class, 'special_offer'])->name('special.offer');
Route::post('/special/offer/store/', [SpecialOfferController::class, 'special_offer_store'])->name('special.offer.store');
Route::post('/special/offer2/store/', [SpecialOfferController::class, 'special_offer2_store'])->name('special.offer2.store');

// Subscriber
Route::get('subscriber', [HomeController::class,'subscriber'])->name('subscriber');
Route::post('/subscriber/store/', [HomeController::class,'subscriber_store'])->name('subscriber.store');

//user
Route::get('/user/update', [UserController::class, 'user_update'])->name('user.update');
Route::post('/user/info/update', [UserController::class, 'user_info_update'])->name('user.info.update');
Route::post('/user/password/update', [UserController::class, 'user_password_update'])->name('user.password.update');
Route::post('/user/photo/update', [UserController::class, 'user_photo_update'])->name('user.photo.update');

//user
Route::post('/add/user', [HomeController::class, 'add_user'])->name('add.user');
Route::get('/user/list', [HomeController::class, 'user_list'])->name('user.list');
Route::get('/user/delete/{user_id}', [HomeController::class, 'user_delete'])->name('user.delete');

//category
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');
Route::get('/category/soft/delete/{category_id}', [CategoryController::class, 'category_soft_delete'])->name('category.soft.delete');
Route::get('/category/trash', [CategoryController::class, 'category_trash'])->name('category.trash');
Route::get('/category/restore/{category_id}', [CategoryController::class, 'category_restore'])->name('category.restore');
Route::get('/category/permanent/delete/{category_id}', [CategoryController::class, 'category_permanent_delete'])->name('category.permanent.delete');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('/category/update/{category_id}', [CategoryController::class, 'category_update'])->name('category.update');
Route::post('/checked/delete/', [CategoryController::class, 'checked_delete'])->name('checked.delete');
Route::post('/checked/restore/', [CategoryController::class, 'checked_restore'])->name('checked.restore');

//Subcategory
Route::get('/subcategory', [SubCategoryController::class, 'subcategory'])->name('subcategory');
Route::post('/subcategory/store', [SubCategoryController::class, 'subcategory_store'])->name('subcategory.store');
Route::get('/subcategory/edit/{id}', [SubCategoryController::class, 'subcategory_edit'])->name('subcategory.edit');
Route::post('/subcategory/update/{id}', [SubCategoryController::class, 'subcategory_update'])->name('subcategory.update');
Route::get('/subcategory/delete/{id}', [SubCategoryController::class, 'subcategory_delete'])->name('subcategory.delete');

// Product
Route::get('/add/product/', [ProductController::class, 'add_product'])->name('add.product');
Route::post('/getsubcategory',[ProductController::class, 'getsubcategory']);
Route::post('/product/store/', [ProductController::class, 'product_store'])->name('product.store');
Route::get('/product/list/', [ProductController::class, 'product_list'])->name('product.list');
Route::post('/getstatus',[ProductController::class, 'getstatus']);
Route::get('/product/edit/{id}', [ProductController::class, 'product_edit'])->name('product.edit');
Route::post('/product/update/{id}', [ProductController::class, 'product_update'])->name('product.update');
Route::get('/product/delete/{id}', [ProductController::class, 'product_delete'])->name('product.delete');

// Brand
Route::get('/brand', [BrandController::class, 'brand'])->name('brand');
Route::post('/brand/store', [BrandController::class, 'brand_store'])->name('brand.store');
Route::get('/brand/edit/{id}', [BrandController::class, 'brand_edit'])->name('brand.edit');
Route::post('/brand/update/{id}', [BrandController::class, 'brand_update'])->name('brand.update');
Route::get('/brand/delete/{id}', [BrandController::class, 'brand_delete'])->name('brand.delete');

// Variation
Route::get('/variation', [VariationController::class, 'variation'])->name('variation');
Route::post('/color/store', [VariationController::class, 'color_store'])->name('color.store');
Route::get('/color/delete/{id}', [VariationController::class, 'color_delete'])->name('color.delete');
Route::post('/size/store', [VariationController::class, 'size_store'])->name('size.store');
Route::get('/size/delete/{id}', [VariationController::class, 'size_delete'])->name('size.delete');

// Inventory
Route::get('/inventory/{id}', [InventoryController::class, 'inventory'])->name('inventory');
Route::post('/inventory/store/{id}', [InventoryController::class, 'inventory_store'])->name('inventory.store');
Route::get('/inventory/delete/{id}', [InventoryController::class, 'inventory_delete'])->name('inventory.delete');

// Customer
Route::get('/customer/login/', [CustomerAuthController::class, 'customer_login'])->name('customer.login');
Route::get('/customer/register/', [CustomerAuthController::class, 'customer_register'])->name('customer.register');
Route::post('/customer/store/', [CustomerAuthController::class, 'customer_store'])->name('customer.store');
Route::post('/customer/logged/', [CustomerAuthController::class, 'customer_logged'])->name('customer.logged');
Route::get('/customer/profile/', [CustomerController::class, 'customer_profile'])->name('customer.profile');
Route::get('/customer/logout/', [CustomerController::class, 'customer_logout'])->name('customer.logout');
Route::post('/customer/profile/update/', [CustomerController::class, 'customer_profile_update'])->name('customer.profile.update');
Route::get('/customer/my/orders/', [CustomerController::class, 'my_orders'])->name('my.orders');
Route::get('/download/invoice/{id}', [CustomerController::class, 'download_invoice'])->name('download.invoice');
Route::get('/customer/email/verify/{token}', [CustomerController::class, 'customer_email_verify'])->name('customer.email.verify');
Route::get('/resend/verification/link/', [CustomerController::class, 'resend_verification_link'])->name('resend.verification.link');
Route::post('/verification/link/sent/', [CustomerController::class, 'verification_link_sent'])->name('verification.link.sent');

// Cart
Route::post('/add/cart/', [CartController::class, 'add_cart'])->name('add.cart');
Route::get('/cart/remove/{id}', [CartController::class, 'cart_remove'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'cart'])->middleware('customer')->name('cart');
Route::post('/cart/update/', [CartController::class, 'cart_update'])->name('cart.update');

// Coupon
Route::get('/coupon', [CouponController::class, 'coupon'])->name('coupon');
Route::post('/add/coupon/', [CouponController::class, 'add_coupon'])->name('add.coupon');
Route::get('/coupon/status/{id}', [CouponController::class, 'coupon_status'])->name('coupon.status');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/getCity', [CheckoutController::class, 'getCity'])->name('getCity');
Route::post('/order/store/', [CheckoutController::class, 'order_store'])->name('order.store');
Route::get('/order/success/', [CheckoutController::class, 'order_success'])->name('order.success');

// Orders
Route::get('/orders', [OrderController::class, 'orders'])->name('orders');
Route::post('/order/status/update/{id}', [OrderController::class, 'order_status_update'])->name('order.status.update');
Route::get('/cancel/order/{id}', [OrderController::class, 'cancel_order'])->name('cancel.order');
Route::post('/order/cancel/req/{id}', [OrderController::class, 'order_cancel_req'])->name('order.cancel.req');
Route::get('/order/cancel/list', [OrderController::class, 'order_cancel_list'])->name('order.cancel.list');
Route::get('/cancel/details/{id}', [OrderController::class, 'cancel_details'])->name('cancel.details');
Route::get('/cancel/accept/{id}', [OrderController::class, 'cancel_accept'])->name('cancel.accept');
Route::get('/order/return/{id}', [OrderController::class, 'order_return'])->name('order.return');
Route::get('/order/returns/list', [OrderController::class, 'order_returns_list'])->name('order.returns.list');
Route::post('/order/return/store/{id}', [OrderController::class, 'order_return_store'])->name('order.return.store');
Route::get('/returns/details/{id}', [OrderController::class, 'returns_details'])->name('returns.details');
Route::get('/returns/accept/{id}', [OrderController::class, 'returns_accept'])->name('returns.accept');
Route::get('/order/cancel/admin/{id}', [OrderController::class, 'order_cancel_admin'])->name('order.cancel.admin');
Route::post('/order/cancel/store/admin/{id}', [OrderController::class, 'order_cancel_store_admin'])->name('order.cancel.store.admin');



// SSLCOMMERZ Start
Route::get('/pay', [SslCommerzPaymentController::class, 'index'])->name('sslpay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

// Stripe
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe')->name('stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});


// review
Route::post('/review/store/{id}', [FrontendController::class, 'review_storees'])->name('review.store');

// Role Manager
Route::get('/role/manager/', [RoleController::class, 'role_manager'])->name('role.manager');
Route::post('/permission/store/', [RoleController::class, 'permission_store'])->name('permission.store');
Route::post('/role/store/', [RoleController::class, 'role_store'])->name('role.store');
Route::get('/role/delete/{id}', [RoleController::class, 'role_delete'])->name('role.delete');
Route::get('/role/edit/{id}', [RoleController::class, 'role_edit'])->name('role.edit');
Route::post('/role/update/{id}', [RoleController::class, 'role_update'])->name('role.update');
Route::post('/role/assign/', [RoleController::class, 'role_assign'])->name('role.asign');
Route::get('/role/remove/{id}', [RoleController::class, 'role_remove'])->name('role.remove');

// Password reset
Route::get('/password/reset/', [PassResetController::class, 'password_reset'])->name('password.reset');
Route::post('/pass/reset/req/', [PassResetController::class, 'pass_reset_req'])->name('pass.reset.req');
Route::get('/pass/reset/form/{token}', [PassResetController::class, 'pass_reset_form'])->name('pass.reset.form');
Route::post('/pass/reset/confirm/{token}', [PassResetController::class, 'pass_reset_confirm'])->name('pass.reset.confirm');
<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariationController;
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

Route::get('festival/offer/', [OfferController::class, 'festival_offer'])->name('festival.offer');
Route::post('festival/offer/store/', [OfferController::class, 'festival_offer_store'])->name('festival.offer.store');

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
<?php

use App\DataTables\ProductImageGalleryDataTable;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\SlidersController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\VariantItemController;
use App\Models\GeneralSetting;
use App\Models\VariantItem;
use Illuminate\Support\Facades\Route;

// Admin user dashboard route
Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');

//Admin user profile route
Route::get('profile',[ProfileController::class,'index'])->name('profile');

//Admin user update profile route
Route::post('profile/update',[ProfileController::class,'updateProfile'])->name('profile.update');

//Admin user update password route
Route::post('profile/update/password',[ProfileController::class,'updatePassword'])->name('password.update');


//Slider Route
Route::resource('slider',SlidersController::class);

//Category Route
Route::put('category/change-status',[CategoryController::class,'changeStatus'])->name('category.change-status');
Route::resource('category',CategoryController::class);


//Subcategory Route
Route::put('subcategory/change-status',[SubcategoryController::class,'changeStatus'])->name('subcategory.change-status');
Route::resource('subcategory',SubcategoryController::class);

//Childcategory Route
Route::get('childcategory/get-subcategory',[ChildCategoryController::class,'getSubcategory'])->name('childcategory.getSubcategory');
Route::get('childcategory/get-childcategory',[ChildCategoryController::class,'getChildcategory'])->name('childcategory.getChildcategory');
Route::put('childcategory/change-status',[ChildcategoryController::class,'changeStatus'])->name('childcategory.change-status');
Route::resource('childcategory',ChildCategoryController::class);


//Brand Route
Route::put('brand/change-status',[BrandController::class,'changeStatus'])->name('brand.change-status');
Route::resource('brand',BrandController::class);


//VendorProfile Route
Route::resource('vendor',AdminVendorProfileController::class);


//Product Route
Route::put('product/change-status',[ProductController::class,'changeStatus'])->name('product.change-status');
Route::get('get-subcategory',[ProductController::class,'getSubcategory'])->name('product.getSubcategory');
Route::get('get-childcategory',[ProductController::class,'getChildcategory'])->name('product.getChildcategory');
Route::put('change-status',[ProductController::class,'changeStatus'])->name('product.change-status');
Route::resource('product',ProductController::class);


//Product Image Gallery
Route::resource('gallery',ProductImageGalleryController::class);



//Product Variant Route
Route::put('variant/change-status',[ProductVariantController::class,'changeStatus'])->name('variant.change-status');
Route::resource('variant',ProductVariantController::class);


//Product Variant Item Route
Route::get('variantitem/{id}/edit',[VariantItemController::class,'edit'])->name('variantitem.edit');
Route::put('variantitem-update/{id}',[VariantItemController::class,'update'])->name('variantitem.update');
Route::get('variantitem/{productID}/{variantID}',[VariantItemController::class,'index'])->name('variantitem.index');
Route::get('variantitem/create/{productID}/{variantID}',[VariantItemController::class,'create'])->name('variantitem.create');
Route::post('variantitem',[VariantItemController::class,'store'])->name('variantitem.store');
Route::delete('variantitem/{id}',[VariantItemController::class,'destroy'])->name('variantitem.destroy');
Route::put('variantitem/change-status',[VariantItemController::class,'changeStatus'])->name('variantitem.change-status');


//Seller Product Variant
Route::get('seller',[SellerProductController::class,'index'])->name('seller.index');
Route::get('pending-seller',[SellerProductController::class,'pending_index'])->name('pending-seller.index');
Route::put('change-approved',[SellerProductController::class,'changeApproved'])->name('pending-seller.change-approved');

//Flash Sell Route
Route::get('flash-sale',[FlashSaleController::class,'index'])->name('flash-sale.index');
Route::put('flash-sale/create',[FlashSaleController::class,'update'])->name('flash-sale.update');
Route::put('flash-sale/addProduct',[FlashSaleController::class,'addProduct'])->name('flash-sale.addProduct');
Route::put('flash-sale/home/change-status',[FlashSaleController::class,'changeStatusHome'])->name('flash-sale.changeStatusHome');
Route::put('flash-sale/change-status',[FlashSaleController::class,'changeStatus'])->name('flash-sale.changeStatus');
Route::delete('flash-sale/{id}}',[FlashSaleController::class,'destroy'])->name('flash-sale.destroy');


//General Setting Route
Route::get('generalsetting',[SettingController::class,'index'])->name('general-setting.index');
Route::put('generalsetting-update',[SettingController::class,'update'])->name('general-setting.update');


//Coupon Route
Route::put('coupons-change-status',[CouponController::class,'changeStatus'])->name('coupons.change-status');
Route::resource('coupons',CouponController::class);


//Shipping Rule Route
Route::put('shipping-rule-change-status',[ShippingRuleController::class,'changeStatus'])->name('shipping-rule.change-status');
Route::resource('shipping-rule',ShippingRuleController::class);

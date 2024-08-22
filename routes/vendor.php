<?php
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProductVariantItemController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard',[VendorController::class,'dashboard'])->name('dashboard');

Route::group(['middleware' => 'auth', 'verified','prefix' => 'vendor'],function(){
    Route::get('profile',[VendorProfileController::class,'index'])->name('profile');

    Route::put('profile',[VendorProfileController::class,'updateProfile'])->name('profile.update');

    Route::post('profile',[VendorProfileController::class,'updatePassword'])->name('password.update');
});

// Vendor Shop Profile Route
Route::resource('shop-profile', VendorShopProfileController::class);

//Vendor Product Route
Route::get('get-subcategory',[VendorProductController::class,'getSubcategory'])->name('vendor.getSubcategory');
Route::get('get-childcategory',[VendorProductController::class,'getChildcategory'])->name('vendor.getChildcategory');
Route::resource('product',VendorProductController::class);


//Vendor Product Image gallery
Route::resource('vendor-product-gallery',VendorProductImageGalleryController::class);


//Vendor Product Variant
Route::put('vendor-variant/change-status',[VendorProductVariantController::class,'changeStatus'])->name('vendor-variant.change-status');
Route::resource('vendor-variant',VendorProductVariantController::class);

//Vendor Product Variant Item Route
Route::get('vendor-variant-item/{productID}/{variantID}',[VendorProductVariantItemController::class,'index'])
       ->name('vendor-variant-item.index');
Route::get('vendor-variant-item/create/{productID}/{variantID}',[VendorProductVariantItemController::class,'create'])
    ->name('vendor-variant-item.create');
Route::post('vendor-variant-item',[VendorProductVariantItemController::class,'store'])
    ->name('vendor-variant-item.store');

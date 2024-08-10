<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SlidersController;
use App\Http\Controllers\Backend\SubcategoryController;
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
Route::put('change-status',[SubcategoryController::class,'changeStatus'])->name('subcategory.change-status');
Route::resource('subcategory',SubcategoryController::class);

//Childcategory Route
Route::get('get-subcategory',[ChildCategoryController::class,'getSubcategory'])->name('childcategory.getSubcategory');
Route::get('get-childcategory',[ChildCategoryController::class,'getChildcategory'])->name('childcategory.getChildcategory');
Route::put('change-status',[ChildcategoryController::class,'changeStatus'])->name('childcategory.change-status');
Route::resource('childcategory',ChildCategoryController::class);


//Brand Route
Route::put('change-status',[BrandController::class,'changeStatus'])->name('brand.change-status');
Route::resource('brand',BrandController::class);

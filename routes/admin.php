<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SlidersController;
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
Route::resource('category',CategoryController::class);

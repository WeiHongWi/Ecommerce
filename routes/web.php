<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductDetailController;
use App\Http\Controllers\Frontend\ProfileController as FrontendProfileController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\ProfileController;
use App\Models\UserAddress;
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

Route::get('/',[HomeController::class,'home'])->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('admin/login',[AdminController::class,'login'])->name('admin.login');

Route::get('flash-sale',[FlashSaleController::class,'index'])->name('flash-sale');

Route::get('product-detail/{slug}',[ProductDetailController::class,'showproduct'])->name('product-detail');

Route::group(['middleware' => 'auth', 'verified','prefix' => 'user','as' =>'user.'],function(){
    Route::get('dashboard',[UserDashboardController::class,'index'])->name('dashboard');


    Route::get('profile',[FrontendProfileController::class,'index'])->name('profile');

    Route::put('profile',[FrontendProfileController::class,'updateProfile'])->name('profile.update');

    Route::post('profile',[FrontendProfileController::class,'updatePassword'])->name('password.update');

    Route::resource('address',UserAddressController::class);

});

//Route::get('user/dashboard',[UserDashboardController::class,'dashboard'])
          //->middleware(['auth', 'verified'])->name('dashboard');

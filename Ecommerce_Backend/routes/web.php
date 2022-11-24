<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizesController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\BrandController;



/*here we have auth routes , if we don't want  particular route to access then put it to false*/
Auth::routes(['register' => true]);
Route::view('/error_page','error_page')->name('error_page');
Route::middleware(['auth','admin_access'])->group(function(){
    Route::get('/',[App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('user', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubCategoryController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('sizes', SizesController::class);
    Route::resource('colors', ColorsController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('product', ProductController::class);
});







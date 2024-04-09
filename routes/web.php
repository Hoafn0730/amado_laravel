<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductTagController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;

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

// User
Route::get('/', [HomeController::class, 'index']);
Route::get('/products/{slug}', [DetailController::class, 'index']);
Route::get('/shop/{slug?}', [ShopController::class, 'index']);



Route::get('/cart', function () {
    return view('pages.cart');
});

Route::get('/checkout', function () {
    return view('pages.checkout');
});

Route::get('/login', function () {
    return view('pages.login');
});


// Admin
Route::resource('/dashboard', DashboardController::class);
Route::resource('/categories', CategoryController::class);
Route::resource('/coupons', CouponController::class);
Route::resource('/orders', OrderController::class);
Route::get('/order-product/{id}', [OrderProductController::class, 'show']);
Route::post('/order-product/{id}', [OrderProductController::class, 'store']);
Route::resource('/product-tag', ProductTagController::class);
Route::resource('/products', ProductController::class);
Route::resource('/tags', TagController::class);
Route::resource('/users', UserController::class);
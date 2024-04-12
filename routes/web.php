<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductTagController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
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
Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/',[CartController::class,'view'])->name('view');
    Route::get('/add/{product}', [CartController::class ,'addToCart'])->name('add');
    Route::get('/delete/{id}',[CartController::class,'deleteToCart'])->name('delete');
    Route::get('/update/{id}',[CartController::class,'updateToCart'])->name('update');
});
Route::prefix('checkout')->name('checkout.')->group(function(){
    Route::get('/',[CheckoutController::class,'view'])->name('view');
    Route::post('/add', [CheckoutController::class ,'store'])->name('add');
});
Route::get('/invoice', [InvoiceController::class, 'index']);
Route::get('/search', [SearchController::class, 'index']);


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
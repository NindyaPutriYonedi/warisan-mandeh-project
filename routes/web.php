<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrder;
use App\Http\Controllers\Admin\ReviewController as AdminReview;
use App\Http\Controllers\Admin\ProductController as AdminProduct;


// Home
//Route::get('/', [ProductController::class, 'home'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');

// Product detail
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/produk', [ProductController::class, 'all'])->name('product.index');


// Cart (langsung WA, tidak butuh login)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
//Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');


Route::post('/cart/add', [CartController::class, 'add'])
     ->name('cart.add');

Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');



// Checkout (WA Redirect)
//Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
//Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
//Route::get('/buy/{id}', [CheckoutController::class, 'buyNow'])->name('buy.now');
Route::post('/buy', [CheckoutController::class, 'buyNow'])
     ->name('buy.now');


// Review toko (customer tanpa login)
Route::get('/review/create', [ReviewController::class, 'create'])->name('review.create');
Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');

// Admin Login
Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'loginProcess'])->name('admin.login.process');

// Admin routes (pakai middleware admin)
//Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

    // Route::get('/dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('dashboard');
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');
    // Products
    Route::get('/products', [AdminProduct::class, 'index'])->name('products.index');
    Route::get('/products/{id}/edit', [AdminProduct::class, 'edit'])->name('products.edit');
    Route::post('/products/{id}/update', [AdminProduct::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [AdminProduct::class, 'destroy'])->name('products.destroy');
    Route::get('/products/create', [AdminProduct::class, 'create'])->name('products.create');
Route::post('/products/store', [AdminProduct::class, 'store'])->name('products.store');


    // Orders
    Route::get('/orders', [AdminOrder::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrder::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/status', [AdminOrder::class, 'updateStatus'])->name('orders.status');

    // Reviews
    Route::get('/reviews', [AdminReview::class, 'index'])->name('reviews.index');
    Route::delete('/reviews/{id}', [AdminReview::class, 'destroy'])->name('reviews.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});
Route::get('/tentang', function () {
    return view('about');
})->name('about');


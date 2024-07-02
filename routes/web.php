<?php

use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Default route
Route::get('/', function () {
    return view('auth.login');
});

// Authentication routes
Auth::routes();

// Routes requiring authentication
Route::middleware(['auth'])->group(function () {
    Route::resource('hotel', HotelController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::get('member', [UserController::class, 'members']);

    // Cart routes
    Route::get('laralux/user/cart', function () {
        return view('frontend.cart');
    })->name('cart');

    Route::get('laralux/cart/add/{id}', [FrontEndController::class, 'addToCart'])->name('addCart');
    Route::get('laralux/cart/delete/{id}', [FrontEndController::class, 'deleteFromCart'])->name('delFromCart');
    Route::post('laralux/cart/addQty', [FrontEndController::class, 'addQuantity'])->name('addQty');
    Route::post('laralux/cart/reduceQty', [FrontEndController::class, 'reduceQuantity'])->name('redQty');
    Route::get('laralux/cart/checkout', [FrontEndController::class, 'checkout'])->name('checkout');
});

// Public frontend routes
Route::get('/laralux', [FrontEndController::class, 'index'])->name('laralux.index');
Route::get('/laralux/{laralux}', [FrontEndController::class, 'show'])->name('laralux.show');

// Home route (authenticated)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

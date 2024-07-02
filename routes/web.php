<?php

use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MemberController;
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
    Route::resource('member', UserController::class);
    Route::get('laporansatu', [LaporanController::class, 'topThreeUserTotalTransaction']);
    Route::get('laporandua', [LaporanController::class, 'topThreeProductHotelReserved']);
    Route::get('laporantiga', [LaporanController::class, 'topThreeUserAverageTransaction']);

    // Cart routes
    Route::get('laralux/user/cart', function () {
        return view('frontend.cart');
    })->name('cart');

    Route::get('cart', [ProdukController::class, 'cart'])->name('cart');
    Route::get('cart/add/{id}', [ProdukController::class, 'addToCart'])->name('produk.addCart');
    Route::get('cart/delete/{id}', [ProdukController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('cart/addQty', [ProdukController::class, 'addQuantity'])->name('cart.addQty');
    Route::post('cart/reduceQty', [ProdukController::class, 'reduceQuantity'])->name('cart.reduceQty');  
    // Warning !!!  
    Route::get('cart/checkout', [ProdukController::class, 'checkout'])->name('cart.checkout');
    Route::get('cart/place-order', [ProdukController::class, 'placeOrder'])->name('cart.placeOrder');


    // OLD ROUTE
    // Route::get('laralux/cart/add/{id}', [FrontEndController::class, 'addToCart'])->name('addCart');
    // Route::get('laralux/cart/delete/{id}', [FrontEndController::class, 'deleteFromCart'])->name('delFromCart');
    // Route::post('laralux/cart/addQty', [FrontEndController::class, 'addQuantity'])->name('addQty');
    // Route::post('laralux/cart/reduceQty', [FrontEndController::class, 'reduceQuantity'])->name('redQty');
    // Route::get('laralux/cart/checkout', [FrontEndController::class, 'checkout'])->name('checkout');
});

// Public frontend routes
Route::get('/laralux', [FrontEndController::class, 'index'])->name('laralux.index');
Route::get('/laralux/{laralux}', [FrontEndController::class, 'show'])->name('laralux.show');

// Home route (authenticated)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php

use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TipeHotelController;
use App\Http\Controllers\TipeProdukController;
use App\Http\Controllers\TransaksiController;
use App\Models\TipeHotel;
use Database\Seeders\TipeHotelSeeder;
use Illuminate\Support\Facades\Auth;
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

// routes/web.php
Route::get('/', [HotelController::class, 'index']);

Auth::routes();

Route::resource('hotel', HotelController::class)->middleware('auth');
Route::resource('produk', ProdukController::class)->middleware('auth');
Route::resource('transaksi', TransaksiController::class)->middleware('auth');

Route::get('/laralux', [FrontEndController::class, 'index'])->name('laralux.index');

Route::get('/laralux/{laralux}', [FrontEndController::class, 'show'])->name('laralux.show');

Route::middleware(['auth'])->group(function(){
    Route::get('laralux/user/cart', function(){
        return view('frontend.cart');
    })->name('cart');
    
    Route::get('laralux/cart/add/{id}', [FrontEndController::class, 'addToCart'])->name('addCart');
    Route::get('laralux/cart/delete/{id}', [FrontEndController::class, 'deleteFromCart'])->name('delFromCart');
    Route::post('laralux/cart/addQty', [FrontEndController::class, 'addQuantity'])->name('addQty');
    Route::post('laralux/cart/reduceQty', [FrontEndController::class, 'reduceQuantity'])->name('redQty');
    Route::get('laralux/cart/checkout',[FrontEndController::class,'checkout'])->name('checkout');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TipeHotelController;
use App\Http\Controllers\TipeProdukController;
use App\Models\TipeHotel;
use Database\Seeders\TipeHotelSeeder;
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

Route::resource('hotel', HotelController::class);
Route::resource('produk', ProdukController::class);

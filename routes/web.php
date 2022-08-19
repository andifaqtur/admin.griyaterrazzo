<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::middleware('auth')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::resource('products', ProductController::class);
    Route::resource('categories', KategoriController::class);
    Route::resource('penjualan', PenjualanController::class);
    Route::get('penjualan/detail/{id}', [PenjualanController::class, 'detail_pesanan'])->name('pesanan.detail');
    Route::resource('users', UserController::class);
});


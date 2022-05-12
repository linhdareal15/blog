<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add-to-cart/{id}', [App\Http\Controllers\ShopController::class, 'AddToCart'])->name('AddToCart');

Route::resource('/product', 'App\Http\Controllers\ProductController');

Auth::routes();
Route::get('/login', function () {
    return view('login');
});




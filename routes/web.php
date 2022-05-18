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
Route::get('/add-to-cart/{id}', 'App\Http\Controllers\ShopController@AddToCart');
Route::post('prepare','App\Http\Controllers\PrepareShippingController@index');
Route::resource('/product', 'App\Http\Controllers\ProductController');
Route::resource('/category', 'App\Http\Controllers\CategoryController');
Route::resource('/checkout','App\Http\Controllers\CheckoutController');

//Route::resource('/dashboard','App\Http\Controllers\Admin\DashboardController');

Route::post('shipping','App\Http\Controllers\ShippingController@create_order');
Auth::routes();
Route::get('/login', function () {
    return view('login');
});

Auth::routes();
Route::resource('/cart', 'App\Http\Controllers\CartController');



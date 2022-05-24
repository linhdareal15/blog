<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->middleware('guest')->name('admin.login');
Route::middleware('auth:admin')->group(function (){
    Route::get('/logout', 'App\Http\Controllers\Admin\Auth\LogoutController@perform')->name('logout.perform');
    Route::get('/dashboard', 'App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');
    Route::resource('/manager-product','App\Http\Controllers\Admin\ProductController');
    Route::resource('/manager-order','App\Http\Controllers\Admin\OrderController');
    Route::resource('/manager-shipping','App\Http\Controllers\Admin\ShippingController');
    Route::get('manager-order/{id}/edit/{status}', 'App\Http\Controllers\Admin\OrderController@edit');
});


<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('admin.login');
Route::middleware('auth:admin')->group(function (){
    Route::get('/dashboard', 'App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');
    Route::resource('/manager-product','App\Http\Controllers\Admin\ProductController');
});


<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [App\Http\Controllers\SaleController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', UsersController::class);

Route::get('/usersHome', [App\Http\Controllers\HomeController::class, 'userHome'])->name('usersHome');

Route::get('/allusers',[App\Http\Controllers\UsersController::class, 'usersView'])->name('allUsers');


Route::resource('sale', SaleController::class);

Route::resource('category', CategoryController::class);

Route::resource('setting', SettingController::class);


Route::get('image/{id}',[ImageController::class, 'image']);

Route::get('thumbnail/{id}',[SaleController::class, 'thumbnail']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('images', ImageController::class);

Route::get('/buySale/{id}', [SaleController::class, 'buySale'])->name('buySale');

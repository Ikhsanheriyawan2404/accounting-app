<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;


// Auth::routes(['register' => false]);
Route::get('', [LoginController::class, 'showLoginForm']);
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resources(['users' => UserController::class]);
    Route::resources(['items' => ItemController::class]);
    Route::resources(['roles' => RoleController::class]);
    Route::resources(['customers' => CustomerController::class]);
    Route::post('city', [CustomerController::class, 'getCities'])->name('get_cities');
    Route::post('district', [CustomerController::class, 'getDistricts'])->name('get_districts');
    Route::post('village', [CustomerController::class, 'getVillages'])->name('get_villages');
});

<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('pages.welcome');
    });
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])->name('login.store');
});


Route::middleware('auth')->group(function () {
    Route::get('home', function () {
        return view('pages.home');
    })->name('home');
    Route::post('logout', [LogoutController::class, 'destroy'])->name('logout');
});



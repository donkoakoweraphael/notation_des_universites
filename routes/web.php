<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\EnsureUserIsAdmin;
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
        return view('pages.user.home');
    })->name('user.home');
    Route::get('profile', [ProfileController::class, 'edit'])->name('user.profile');
    Route::put('profile', [ProfileController::class, 'update'])->name('user.update-profile');
    Route::patch('profile', [ProfileController::class, 'updatePassword'])->name('user.update-password');
    Route::post('profile', [ProfileController::class, 'updateImage'])->name('user.update-profile-image');
    
    Route::post('logout', [LogoutController::class, 'destroy'])->name('logout');

    Route::middleware([EnsureUserIsAdmin::class])->group(function () {
        Route::get('dashboard', function () {
            return view('pages.admin.dashboard');
        })->name('admin.dashboard');
    });
});

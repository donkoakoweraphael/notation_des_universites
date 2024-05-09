<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CriterionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformationSectionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UniversityAdministrationController;
use App\Http\Controllers\UniversityController;
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

    Route::get('home', [UniversityController::class, 'index'])->name('user.home');
    Route::get('universities/{id}', [UniversityController::class, 'read'])->name('user.university.read');

    Route::post('ratings/{univ_id}', [RatingController::class, 'store'])->name('user.rating.store');
    Route::post('comments/{univ_id}', [CommentController::class, 'store'])->name('user.comment.store');

    Route::get('profile', [ProfileController::class, 'edit'])->name('user.profile');
    Route::put('profile', [ProfileController::class, 'update'])->name('user.update-profile');
    Route::patch('profile', [ProfileController::class, 'updatePassword'])->name('user.update-password');
    Route::post('profile', [ProfileController::class, 'updateImage'])->name('user.update-profile-image');

    Route::post('logout', [LogoutController::class, 'destroy'])->name('logout');

    Route::middleware([EnsureUserIsAdmin::class])->group(function () {
        Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('admin/universities', [UniversityAdministrationController::class, 'index'])->name('admin.university.index');
        Route::get('admin/universities/create', [UniversityAdministrationController::class, 'create'])->name('admin.university.create');
        Route::post('admin/universities/create', [UniversityAdministrationController::class, 'store'])->name('admin.university.store');
        Route::get('admin/universities/{id}', [UniversityAdministrationController::class, 'edit'])->name('admin.university.edit');
        Route::put('admin/universities/{id}', [UniversityAdministrationController::class, 'update'])->name('admin.university.update');
        Route::delete('admin/universities/{id}', [UniversityAdministrationController::class, 'destroy'])->name('admin.university.destroy');

        Route::post('admin/universities/{univ_id}/information/create', [InformationSectionController::class, 'store'])->name('admin.university.information.store');
        Route::put('admin/universities/information/{id}', [InformationSectionController::class, 'update'])->name('admin.university.information.update');
        Route::delete('admin/universities/information/{id}', [InformationSectionController::class, 'destroy'])->name('admin.university.information.destroy');

        Route::get('admin/criteria', [CriterionController::class, 'index'])->name('admin.criterion.index');
        Route::post('admin/criteria', [CriterionController::class, 'store'])->name('admin.criterion.store');
        Route::get('admin/criteria/{id}', [CriterionController::class, 'edit'])->name('admin.criterion.edit');
        Route::put('admin/criteria/{id}', [CriterionController::class, 'update'])->name('admin.criterion.update');
        Route::delete('admin/criteria/{id}', [CriterionController::class, 'destroy'])->name('admin.criterion.destroy');

    });
});

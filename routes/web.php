<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Student\AuthController as StudentAuthController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\RequestController as StudentRequestController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RequestManagementController;
use App\Http\Controllers\Admin\ReportController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::prefix('student')->name('student.')->group(function () {
    
    // Guest routes (login, register)
    Route::middleware('guest:student')->group(function () {  
        Route::get('login', [StudentAuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [StudentAuthController::class, 'login'])->name('login.submit');
        Route::get('register', [StudentAuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [StudentAuthController::class, 'register'])->name('register.submit');
    });

    Route::middleware(['auth:student'])->group(function () {  
        Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [StudentAuthController::class, 'logout'])->name('logout');

        Route::prefix('requests')->name('requests.')->group(function () {
            Route::get('/', [StudentRequestController::class, 'index'])->name('index');
            Route::get('create', [StudentRequestController::class, 'create'])->name('create');
            Route::post('/', [StudentRequestController::class, 'store'])->name('store');
            Route::get('track', [StudentRequestController::class, 'track'])->name('track');
            Route::get('{id}', [StudentRequestController::class, 'show'])->name('show');
        });

        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [StudentProfileController::class, 'show'])->name('show');
            Route::get('edit', [StudentProfileController::class, 'edit'])->name('edit');
            Route::put('/', [StudentProfileController::class, 'update'])->name('update');
        });
    });
});

// ===== ADMIN ROUTES =====
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::prefix('requests')->name('requests.')->group(function () {
            Route::get('/', [RequestManagementController::class, 'index'])->name('index');
            Route::get('{id}', [RequestManagementController::class, 'show'])->name('show');
            Route::put('{id}/status', [RequestManagementController::class, 'updateStatus'])->name('update-status');
        });

        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('index');
            Route::get('daily', [ReportController::class, 'daily'])->name('daily');
        });
    });
});

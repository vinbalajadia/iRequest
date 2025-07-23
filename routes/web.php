<?php

use App\Http\Controllers\Student\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/student', [ProfileController::class, 'edit'])->name('student.edit-profile');
    Route::patch('/student', [ProfileController::class, 'update'])->name('student.update-profile');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/my-request', [RequestController::class, 'myRequest'])->name('my.request');
    Route::get('/request/create', [RequestController::class, 'create'])->name('request.create');
});



Route::post('/request', [RequestController::class, 'store'])->name('requests.store');


Route::get('/dashboard', [RequestController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/auth.php';

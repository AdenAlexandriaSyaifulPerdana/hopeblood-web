<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Auth routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/auth.login', function () {
    return view('auth.login');
})->name('auth.login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Dashboard routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
});

Route::middleware(['auth', 'role:pendonor'])->group(function () {
    Route::get('/pendonor/dashboard', fn() => view('pendonor.dashboard'))->name('pendonor.dashboard');
});

Route::middleware(['auth', 'role:penerima'])->group(function () {
    Route::get('/penerima/dashboard', fn() => view('penerima.dashboard'))->name('penerima.dashboard');
});

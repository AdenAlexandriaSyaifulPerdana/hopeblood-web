<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\PendonorController;

/*
|--------------------------------------------------------------------------
| AUTH (Register & Login)
|--------------------------------------------------------------------------
*/

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

/*
|--------------------------------------------------------------------------
| COMPLETE PROFILE (WAJIB SEBELUM MASUK DASHBOARD)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/complete-profile', [RegisteredUserController::class, 'completeProfile'])
        ->name('complete.profile');

    Route::post('/complete-profile', [RegisteredUserController::class, 'storeProfile']);
});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin', 'checkprofile'])->group(function () {

    Route::get('/admin/dashboard', [UserController::class, 'index'])
        ->name('admin.dashboard');

    // CRUD Pendonor
    Route::get('/admin/pendonor', [UserController::class, 'pendonorIndex'])->name('admin.pendonor.index');
    Route::get('/admin/pendonor/create', [UserController::class, 'pendonorCreate'])->name('admin.pendonor.create');
    Route::post('/admin/pendonor', [UserController::class, 'pendonorStore'])->name('admin.pendonor.store');
    Route::get('/admin/pendonor/{id}/edit', [UserController::class, 'pendonorEdit'])->name('admin.pendonor.edit');
    Route::put('/admin/pendonor/{id}', [UserController::class, 'pendonorUpdate'])->name('admin.pendonor.update');
    Route::delete('/admin/pendonor/{id}', [UserController::class, 'pendonorDestroy'])->name('admin.pendonor.destroy');

});


/*
|--------------------------------------------------------------------------
| PENDONOR
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pendonor', 'checkprofile'])->group(function () {
    Route::get('/pendonor/dashboard', function () {
        return view('pendonor.dashboard');
    })->name('pendonor.dashboard');


    Route::get('/pendonor/permintaan', [PendonorController::class, 'lihatPermintaan'])
        ->name('pendonor.permintaan');


    // Konfirmasi donor
    Route::post('/pendonor/konfirmasi', 
    [PendonorController::class, 'konfirmasiDonor']
)->name('pendonor.konfirmasi');
});



/*
|--------------------------------------------------------------------------
| PENERIMA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:penerima', 'checkprofile'])->group(function () {
    Route::get('/penerima/dashboard', function () {
        return view('penerima.dashboard');
    })->name('penerima.dashboard');

    // FORM PERMOHONAN
    Route::get('/penerima/permohonan/buat', 
        [PenerimaController::class, 'formPermohonan']
    )->name('penerima.permohonan.form');

    // SIMPAN PERMOHONAN
    Route::post('/penerima/permohonan/kirim', 
        [PenerimaController::class, 'kirimPermohonan']
    )->name('penerima.permohonan.kirim');

    // STATUS PERMOHONAN
    Route::get('/penerima/permohonan/status', 
        [PenerimaController::class, 'statusPermohonan']
    )->name('penerima.permohonan.status');
});



/*
|--------------------------------------------------------------------------
| GOOGLE
|--------------------------------------------------------------------------
*/
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

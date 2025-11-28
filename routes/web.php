<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\PendonorController;
use App\Http\Controllers\HospitalController;

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

    // CRUD Penerima
    Route::get('/admin/penerima', [UserController::class, 'penerimaIndex'])->name('admin.penerima.index');
    Route::get('/admin/penerima/create', [UserController::class, 'penerimaCreate'])->name('admin.penerima.create');
    Route::post('/admin/penerima', [UserController::class, 'penerimaStore'])->name('admin.penerima.store');
    Route::get('/admin/penerima/{id}/edit', [UserController::class, 'penerimaEdit'])->name('admin.penerima.edit');
    Route::put('/admin/penerima/{id}', [UserController::class, 'penerimaUpdate'])->name('admin.penerima.update');
    Route::delete('/admin/penerima/{id}', [UserController::class, 'penerimaDestroy'])->name('admin.penerima.destroy');

    // ✅ CRUD Rumah Sakit
    Route::get('/admin/hospitals', [HospitalController::class, 'index'])->name('admin.hospitals.index');
    Route::get('/admin/hospitals/create', [HospitalController::class, 'create'])->name('admin.hospitals.create');
    Route::post('/admin/hospitals', [HospitalController::class, 'store'])->name('admin.hospitals.store');
    Route::get('/admin/hospitals/{id}/edit', [HospitalController::class, 'edit'])->name('admin.hospitals.edit');
    Route::put('/admin/hospitals/{id}', [HospitalController::class, 'update'])->name('admin.hospitals.update');
    Route::delete('/admin/hospitals/{id}', [HospitalController::class, 'destroy'])->name('admin.hospitals.destroy');

    // PERMOHONAN DARAH ADMIN
    Route::get('/admin/permohonan', [UserController::class, 'permohonanIndex'])
        ->name('admin.permohonan.index');

    Route::get('/admin/permohonan/{id}', [UserController::class, 'permohonanShow'])
        ->name('admin.permohonan.show');

    Route::put('/admin/permohonan/{id}/status', [UserController::class, 'permohonanUpdateStatus'])
        ->name('admin.permohonan.status');

    // Konfirmasi Donor (khusus admin rumah sakit)
    Route::get('/admin/konfirmasi-donor', [UserController::class, 'konfirmasiDonorIndex'])
        ->name('admin.konfirmasi.index');

    Route::put('/admin/konfirmasi-donor/{id}/acc', [UserController::class, 'konfirmasiDonorAcc'])
        ->name('admin.konfirmasi.acc');

    Route::put('/admin/konfirmasi-donor/{id}/reject', [UserController::class, 'konfirmasiDonorReject'])
        ->name('admin.konfirmasi.reject');



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

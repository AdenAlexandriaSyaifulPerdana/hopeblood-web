<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $gUser = Socialite::driver('google')->user();

        // Cari user berdasarkan email
        $user = User::where('email', $gUser->email)->first();

        // Kalau belum ada → buat baru
        if (!$user) {
            $user = User::create([
                'name' => $gUser->name,
                'email' => $gUser->email,
                'password' => bcrypt(uniqid()), // password random
                'role' => 'pendonor', // default
            ]);
        }

        // Login
        Auth::login($user);

        // Cek biodata
        if (
            empty($user->nama_lengkap) ||
            empty($user->usia) ||
            empty($user->alamat) ||
            empty($user->golongan_darah)
        ) {
            return redirect()->route('complete.profile');
        }

        // Redirect sesuai role
        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'pendonor' => redirect()->route('pendonor.dashboard'),
            'penerima' => redirect()->route('penerima.dashboard'),
            default => redirect('/'),
        };
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // Wajib isi biodata dulu
        if (
            empty($user->nama_lengkap) ||
            empty($user->usia) ||
            empty($user->alamat) ||
            empty($user->golongan_darah)
        ) {
            return redirect()->route('complete.profile');
        }

        // Redirect sesuai role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'pendonor') {
            return redirect()->route('pendonor.dashboard');
        } else {
            return redirect()->route('penerima.dashboard');
        }
    }


    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

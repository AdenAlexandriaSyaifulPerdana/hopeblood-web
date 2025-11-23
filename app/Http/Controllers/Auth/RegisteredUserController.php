<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:255'], // hanya huruf & spasi
        'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'], // email valid & domain benar
        'password' => [
            'required',
            'confirmed',
            'min:8',
            'regex:/[A-Z]/',      // harus ada huruf besar
            'regex:/[a-z]/',      // harus ada huruf kecil
            'regex:/[0-9]/',      // harus ada angka
            'regex:/[^A-Za-z0-9]/', // harus ada simbol
        ],
        'role' => ['required', 'in:pendonor,penerima'],

        ], [
            'name.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            'email.email' => 'Format email tidak valid.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
    ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => strtolower($request->role),
        ]);

        Auth::login($user);

        // WAJIB: direct ke complete profile
        return redirect()->route('complete.profile');
    }


    public function completeProfile()
    {
        return view('auth.complete-profile');
    }

    public function storeProfile(Request $request)
    {
        $request->validate([
        'nama_lengkap' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
        'usia' => ['required', 'integer', 'min:17', 'max:70'], // donor 17–70
        'alamat' => ['required', 'string', 'min:5', 'regex:/^[a-zA-Z0-9\s\.,-]+$/'],
        'golongan_darah' => ['required', 'in:A,B,O,AB'],
    ]);


        $user = Auth::user();

        $user->update([
            'name' => $request->nama_lengkap,
            'usia' => $request->usia,
            'alamat' => $request->alamat,
            'golongan_darah' => $request->golongan_darah,

        ]);

        // WAJIB: refresh user session agar middleware mendeteksi data terbaru
        Auth::setUser($user->fresh());

        // redirect sesuai role
        if ($user->role == 'pendonor') {
            return redirect()->route('pendonor.dashboard');
        } elseif ($user->role == 'penerima') {
            return redirect()->route('penerima.dashboard');
        }

        return redirect()->route('admin.dashboard');
    }

}

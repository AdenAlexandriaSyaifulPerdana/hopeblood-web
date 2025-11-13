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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
            'role' => ['required', 'in:pendonor,penerima'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => strtolower($request->role), // disimpan dalam huruf kecil
        ]);

        Auth::login($user);

        if ($user->role === 'pendonor') {
            return redirect()->route('pendonor.dashboard');
        } elseif ($user->role === 'penerima') {
            return redirect()->route('penerima.dashboard');
        }

        // fallback
        return redirect()->route('home');
    }
}

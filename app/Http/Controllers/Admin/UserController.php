<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    // LIST DATA PENDONOR
    public function pendonorIndex()
    {
        $pendonors = User::where('role', 'pendonor')->get();
        return view('admin.pendonor.index', compact('pendonors'));
    }

    // FORM TAMBAH PENDONOR
    public function pendonorCreate()
    {
        return view('admin.pendonor.create');
    }

    // SIMPAN DATA BARU
    public function pendonorStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'pendonor',
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.pendonor.index')
                         ->with('success', 'Pendonor berhasil ditambahkan');
    }

    // FORM EDIT
    public function pendonorEdit($id)
    {
        $pendonor = User::findOrFail($id);
        return view('admin.pendonor.edit', compact('pendonor'));
    }

    // UPDATE DATA
    public function pendonorUpdate(Request $request, $id)
    {
        $pendonor = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => "required|unique:users,email,$id",
        ]);

        $pendonor->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.pendonor.index')
                         ->with('success', 'Pendonor berhasil diperbarui');
    }

    // HAPUS DATA
    public function pendonorDestroy($id)
    {
        $pendonor = User::findOrFail($id);
        $pendonor->delete();

        return redirect()->route('admin.pendonor.index')
                         ->with('success', 'Pendonor berhasil dihapus');
    }
}

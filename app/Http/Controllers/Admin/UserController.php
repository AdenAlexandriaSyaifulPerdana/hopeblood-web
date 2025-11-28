<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\pendonor\KonfirmasiDonor;
use App\Models\penerima\PermohonanDarah;

class UserController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function index()
    {
        $jumlahPendonor = User::where('role', 'pendonor')->count();
        $jumlahPenerima = User::where('role', 'penerima')->count();

        return view('admin.dashboard', compact('jumlahPendonor', 'jumlahPenerima'));
    }

    /**
     * ============================
     *  CRUD DATA PENDONOR
     * ============================
     */

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

    // SIMPAN DATA PENDONOR
    public function pendonorStore(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => 'pendonor',
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.pendonor.index')
                         ->with('success', 'Pendonor berhasil ditambahkan');
    }

    // FORM EDIT PENDONOR
    public function pendonorEdit($id)
    {
        $pendonor = User::findOrFail($id);
        return view('admin.pendonor.edit', compact('pendonor'));
    }

    // UPDATE DATA PENDONOR
    public function pendonorUpdate(Request $request, $id)
    {
        $pendonor = User::findOrFail($id);

        $request->validate([
            'name'  => 'required',
            'email' => "required|unique:users,email,$id",
        ]);

        $pendonor->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.pendonor.index')
                         ->with('success', 'Pendonor berhasil diperbarui');
    }

    // HAPUS PENDONOR
    public function pendonorDestroy($id)
    {
        $pendonor = User::findOrFail($id);
        $pendonor->delete();

        return redirect()->route('admin.pendonor.index')
                         ->with('success', 'Pendonor berhasil dihapus');
    }

    /**
     * ============================
     *  CRUD DATA PENERIMA
     * ============================
     */

    // LIST PENERIMA
    public function penerimaIndex()
    {
        $penerimas = User::where('role', 'penerima')->get();
        return view('admin.penerima.index', compact('penerimas'));
    }

    // FORM TAMBAH PENERIMA
    public function penerimaCreate()
    {
        return view('admin.penerima.create');
    }

    // SIMPAN DATA PENERIMA
    public function penerimaStore(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users',
            'password'       => 'required|min:6',
            'usia'           => 'required|integer',
            'alamat'         => 'required|string',
            'golongan_darah' => 'required|string'
        ]);

        User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'password'       => bcrypt($request->password),
            'role'           => 'penerima',
            'usia'           => $request->usia,
            'alamat'         => $request->alamat,
            'golongan_darah' => $request->golongan_darah
        ]);

        return redirect()->route('admin.penerima.index')
                         ->with('success', 'Penerima berhasil ditambahkan.');
    }

    // FORM EDIT PENERIMA
    public function penerimaEdit($id)
    {
        $penerima = User::findOrFail($id);
        return view('admin.penerima.edit', compact('penerima'));
    }

    // UPDATE PENERIMA (TAMBAHAN, SEBELUMNYA BELUM ADA)
    public function penerimaUpdate(Request $request, $id)
    {
        $penerima = User::findOrFail($id);

        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => "required|email|unique:users,email,$id",
            'usia'           => 'required|integer',
            'alamat'         => 'required|string',
            'golongan_darah' => 'required|string',
        ]);

        $penerima->update([
            'name'           => $request->name,
            'email'          => $request->email,
            'usia'           => $request->usia,
            'alamat'         => $request->alamat,
            'golongan_darah' => $request->golongan_darah,
        ]);

        return redirect()->route('admin.penerima.index')
                         ->with('success', 'Penerima berhasil diperbarui.');
    }

    public function konfirmasiDonorIndex()
    {
        $adminRS = auth()->user()->name; // nama admin = nama rumah sakit

        $konfirmasi = KonfirmasiDonor::where('lokasi_donor', $adminRS)
            ->where('status', 'menunggu konfirmasi rumah sakit')
            ->get();

        return view('admin.konfirmasi.index', compact('konfirmasi'));
    }

    public function konfirmasiDonorAcc($id)
    {
        $konfirmasi = KonfirmasiDonor::findOrFail($id);

        // ubah status konfirmasi
        $konfirmasi->update(['status' => 'disetujui']);

        // update permohonan darah jadi "sedang di proses"
        PermohonanDarah::where('id', $konfirmasi->id_permohonan)
            ->update(['status' => 'sedang di proses']);

        return back()->with('success', 'Pendonor telah disetujui!');
    }

    public function konfirmasiDonorReject($id)
    {
        $konfirmasi = KonfirmasiDonor::findOrFail($id);

        $konfirmasi->update(['status' => 'ditolak']);

        PermohonanDarah::where('id', $konfirmasi->id_permohonan)
            ->update(['status' => 'menunggu']); // dibuka lagi

        return back()->with('success', 'Konfirmasi donor ditolak!');
    }




    // HAPUS PENERIMA
    public function penerimaDestroy($id)
    {
        $penerima = User::findOrFail($id);
        $penerima->delete();

        return redirect()->route('admin.penerima.index')
                         ->with('success', 'Penerima berhasil dihapus.');
    }
    // ==========================
    // PERMOHONAN DARAH ADMIN
    // ==========================

    public function permohonanIndex()
    {
        $permohonans = \App\Models\BloodRequest::with('pendonor')->latest()->get();
        return view('admin.permohonan.index', compact('permohonans'));
    }

    public function permohonanShow($id)
    {
        $permohonan = \App\Models\BloodRequest::with('pendonor')->findOrFail($id);
        return view('admin.permohonan.show', compact('permohonan'));
    }

    public function permohonanUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $permohonan = \App\Models\BloodRequest::findOrFail($id);
        $permohonan->status = $request->status;
        $permohonan->save();

        return back()->with('success', 'Status permohonan berhasil diperbarui');
    }

}

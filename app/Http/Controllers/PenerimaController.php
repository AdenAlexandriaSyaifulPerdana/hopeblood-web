<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penerima\PermohonanDarah;
use App\Models\Hospital;
use Illuminate\Support\Facades\Auth;

class PenerimaController extends Controller
{
    public function formPermohonan()
    {
        $hospitals = Hospital::all();
        return view('penerima.form_permohonan', compact('hospitals'));
    }

    public function kirimPermohonan(Request $request)
    {
        $request->session()->regenerate(); //regenerate session to prevent fixation

        $request->validate([
            'golongan_darah' => 'required',
            'lokasi_rumah_sakit' => 'required',
            'keterangan' => 'nullable'
        ]);

        PermohonanDarah::create([
            'id_penerima' => Auth::id(),   // ← aman, tidak error
            'golongan_darah' => $request->golongan_darah,
            'lokasi_rumah_sakit' => $request->lokasi_rumah_sakit,
            'keterangan' => $request->keterangan,
            'status' => 'menunggu',
        ]);

        return redirect()->route('penerima.permohonan.status')
            ->with('success', 'Permohonan darah berhasil dikirim!');
    }

    public function statusPermohonan()
    {
        $data = PermohonanDarah::where('id_penerima', Auth::id())->get();

        return view('penerima.status_permohonan', compact('data'));
    }


        // =========================
        // TAMPILKAN PROFIL
        // =========================
        public function profile()
        {
            $user = Auth::user();
            return view('penerima.profile', compact('user'));
        }

        // =========================
        // FORM EDIT PROFIL
        // =========================
        public function editProfile()
        {
            $user = Auth::user();
            return view('penerima.edit', compact('user'));
        }

        // =========================
        // SIMPAN PERUBAHAN PROFIL
        // =========================
        public function updateProfile(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'usia'   => 'required|numeric',
            'alamat' => 'required|string',
            'golongan_darah' => 'required|string|in:A,B,AB,O',
        ]);

        $user = Auth::user();

        // ✅ CEK APAKAH ADA PERUBAHAN
        if (
            $request->name == $user->name &&
            $request->usia == $user->usia &&
            $request->alamat == $user->alamat &&
            $request->golongan_darah == $user->golongan_darah
        ) {
            // ✅ TETAP DI HALAMAN EDIT + TAMPILKAN PESAN
            return redirect()
                ->route('penerima.profile.edit')
                ->withInput()
                ->with('warning', 'Tidak ada perubahan yang disimpan.');
        }

        // ✅ JIKA ADA PERUBAHAN → UPDATE
        $user->update([
            'name'   => $request->name,
            'usia'   => $request->usia,
            'alamat' => $request->alamat,
            'golongan_darah' => $request->golongan_darah,
        ]);

        // ✅ JIKA BERHASIL → PINDAH KE PROFIL
        return redirect()
            ->route('penerima.profile')
            ->with('success', 'Profil berhasil diperbarui');
    }

}




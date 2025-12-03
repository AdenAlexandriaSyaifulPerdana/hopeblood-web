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
}

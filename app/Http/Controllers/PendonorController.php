<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penerima\PermohonanDarah;
use App\Models\pendonor\KonfirmasiDonor;
use Illuminate\Support\Facades\Auth;

class PendonorController extends Controller
{
    /**
     * Menampilkan daftar permintaan darah
     * yang cocok dengan golongan pendonor.
     */
    public function lihatPermintaan()
    {
        $gol = Auth::user()->golongan_darah;

        $data = PermohonanDarah::where('golongan_darah', $gol)
                ->where('status', 'menunggu')
                ->get();

        return view('pendonor.permintaan', compact('data'));
    }

    /**
     * Pendonor mengonfirmasi kesediaan donor.
     */
  public function konfirmasiDonor(Request $request)
{
    $request->validate([
        'id_permohonan' => 'required|exists:permohonan_darah,id',
        'lokasi_donor'  => 'required',
        'waktu_donor'   => 'required',
    ]);

    // Cek apakah pendonor sudah pernah konfirmasi permohonan yang sama
    $cek = KonfirmasiDonor::where('id_pendonor', Auth::id())
            ->where('id_permohonan', $request->id_permohonan)
            ->first();

    if ($cek) {
        return back()->with('error', 'Anda sudah mengonfirmasi kesediaan untuk permohonan ini.');
    }

    // Pecah datetime-local
    $datetime = $request->waktu_donor;
    $tanggal = date('Y-m-d', strtotime($datetime));
    $waktu   = date('H:i:s', strtotime($datetime));

    KonfirmasiDonor::create([
        'id_pendonor'    => Auth::id(),
        'id_permohonan'  => $request->id_permohonan,
        'lokasi_donor'   => $request->lokasi_donor,
        'tanggal_donor'  => $tanggal,
        'waktu_donor'    => $waktu,
        'status'         => 'menunggu konfirmasi rumah sakit',
    ]);

    return back()->with('success', 'Konfirmasi donor berhasil dikirim!');
}
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penerima\PermohonanDarah;
use App\Models\pendonor\KonfirmasiDonor;
use Illuminate\Support\Facades\Auth;
use App\Models\Hospital;
use Barryvdh\DomPDF\Facade\Pdf;

class PendonorController extends Controller
{
    /**
     * Menampilkan daftar permintaan darah yang cocok dengan golongan pendonor.
     */
    public function lihatPermintaan()
    {
        $gol = Auth::user()->golongan_darah;
        $pendonorId = Auth::id();

        // Ambil daftar permohonan yg belum dikonfirmasi pendonor ini
        $data = PermohonanDarah::where('golongan_darah', $gol)
            ->where('status', 'menunggu')
            ->whereDoesntHave('konfirmasiPendonor', function ($q) use ($pendonorId) {
                $q->where('id_pendonor', $pendonorId);
            })
            ->get();

        $hospitals = Hospital::all();

        return view('pendonor.permintaan', compact('data', 'hospitals'));
    }


    /**
     * Pendonor mengonfirmasi kesediaan donor.
     * Status TIDAK mengubah permohonan — hanya buat konfirmasi saja.
     */
    public function konfirmasiDonor(Request $request)
    {
        $request->validate([
            'id_permohonan' => 'required|exists:permohonan_darah,id',
            'lokasi_donor'  => 'required|exists:hospitals,id',
            'tanggal_donor' => 'required|date|after_or_equal:today',
            'waktu_donor'   => 'required|date_format:H:i',
        ]);

        // Ambil hospital berdasarkan id
        $hospital = Hospital::findOrFail($request->lokasi_donor);

        // Parse jam operasional dan ubah '.' -> ':'
        $parts = explode('-', $hospital->jam_operasional);
        $open = isset($parts[0]) ? str_replace('.', ':', trim($parts[0])) : null;
        $close = isset($parts[1]) ? str_replace('.', ':', trim($parts[1])) : null;

        $waktu = $request->waktu_donor;

        // Validasi jam donor dalam jam operasional RS
        if ($open && $close) {
            if ($waktu < $open || $waktu > $close) {
                return back()
                    ->withInput()
                    ->with('error', "Jam donor harus antara $open - $close sesuai jam operasional {$hospital->nama_rumah_sakit}.");
            }
        }

        // Simpan konfirmasi donor
        KonfirmasiDonor::create([
            'id_pendonor'   => Auth::id(),
            'id_permohonan' => $request->id_permohonan,
            'lokasi_donor'  => $hospital->id, // simpan ID saja agar mudah difilter admin RS
            'tanggal_donor' => $request->tanggal_donor,
            'waktu_donor'   => $waktu,
            'status'        => 'menunggu konfirmasi rumah sakit',
        ]);

        return redirect()->back()->with('success', 'Kesediaan donor berhasil dikirim! Menunggu respon rumah sakit.');
    }

    public function riwayatDonor()
    {
        $riwayat = KonfirmasiDonor::where('id_pendonor', Auth::id())
                    ->with(['permohonan', 'hospital'])
                    ->get();

        return view('pendonor.riwayat', compact('riwayat'));
    }

    public function downloadSurat($id)
    {
        $data = KonfirmasiDonor::where('id', $id)
                ->where('id_pendonor', Auth::id())
                ->with(['permohonan', 'hospital'])

           ->firstOrFail();

        if ($data->status !== 'disetujui') {
            return back()->with('error', 'Belum bisa mendownload surat rujukan.');
        }

        $pdf = Pdf::loadView('pendonor.surat_rujukan', compact('data'));
        return $pdf->download('surat_rujukan_'.$data->id.'.pdf');
    }

    // ===============================
    // ✅ HALAMAN PROFIL
    // ===============================
    public function profile()
    {
        $user = Auth::user();
        return view('pendonor.profile', compact('user'));
    }

    // ===============================
    // ✅ HALAMAN EDIT PROFIL
    // ===============================
    public function editProfile()
    {
        $user = Auth::user();
        return view('pendonor.edit', compact('user'));
    }

    // ===============================
    // ✅ UPDATE PROFIL (KODEMU)
    // ===============================
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'usia'   => 'required|numeric',
            'alamat' => 'required|string',
            'golongan_darah' => 'required|string|in:A,B,AB,O',
        ]);

        $user = Auth::user();

        // ✅ CEK JIKA TIDAK ADA PERUBAHAN
        if (
            $request->name == $user->name &&
            $request->usia == $user->usia &&
            $request->alamat == $user->alamat &&
            $request->golongan_darah == $user->golongan_darah
        ) {
            return redirect()->route('pendonor.profile.edit')
                ->with('warning', 'Tidak ada perubahan yang disimpan.');
        }

        // ✅ UPDATE DATA
        $user->update([
            'name'   => $request->name,
            'usia'   => $request->usia,
            'alamat' => $request->alamat,
            'golongan_darah' => $request->golongan_darah,
        ]);

        // ✅ PESAN SUKSES
        return redirect()
            ->route('pendonor.profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}



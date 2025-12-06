<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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

        // permohonan menunggu (belum diputuskan RS)
        $permohonanMenunggu = PermohonanDarah::where('status', 'pending')->count();

        // permohonan terpenuhi = yang sudah diputuskan (acc atau reject)
        $permohonanTerpenuhi = PermohonanDarah::whereIn('status', ['acc', 'reject'])->count();

        return view('admin.dashboard', compact(
            'jumlahPendonor',
            'jumlahPenerima',
            'permohonanMenunggu',
            'permohonanTerpenuhi'
        ));
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

    public function penerimaUpdate(Request $request, $id)
    {
        $penerima = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            // usia, alamat, golongan_darah tidak perlu di-edit di sini
        ]);

        $penerima->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.penerima.index')
                        ->with('success', 'Penerima berhasil diperbarui.');
    }

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
    public function konfirmasiDonorIndex()
    {
        // Ambil ID rumah sakit admin login
        $adminHospitalId = Auth::user()->hospital_id;

        // Hanya ambil KONFIRMASI yang menunggu (artinya pendonor sudah klik "saya bersedia donor")
        $konfirmasi = KonfirmasiDonor::with(['pendonor', 'permohonan', 'hospital'])
                        ->where('lokasi_donor', $adminHospitalId)
                        ->where('status', 'menunggu konfirmasi rumah sakit')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('admin.konfirmasi.index', compact('konfirmasi'));
    }

    /**
     * Terima (ACC) sebuah konfirmasi donor
     * $id = id konfirmasi (KonfirmasiDonor)
     */
    public function konfirmasiDonorAcc($id)
    {
        $konfirmasi = KonfirmasiDonor::with('permohonan')->findOrFail($id);

        // pastikan admin RS sesuai
        if (Auth::user()->hospital_id != $konfirmasi->lokasi_donor) {
            return redirect()->back()->with('error', 'Anda tidak berwenang melakukan ACC pada konfirmasi ini.');
        }

        // update status konfirmasi
        $konfirmasi->status = 'disetujui';
        $konfirmasi->save();

        // update status permohonan terkait (opsional: sesuai flow aplikasi)
        if ($konfirmasi->permohonan) {
            $konfirmasi->permohonan->status = 'sedang dalam proses'; // atau 'disetujui' sesuai kebutuhan
            $konfirmasi->permohonan->save();
        }

        return back()->with('success', 'Konfirmasi donor disetujui.');
    }

    /**
     * Tolak (Reject) sebuah konfirmasi donor
     * $id = id konfirmasi (KonfirmasiDonor)
     */
    public function konfirmasiDonorReject($id)
    {
        $konfirmasi = KonfirmasiDonor::with('permohonan')->findOrFail($id);

        // validasi wewenang admin RS
        if (Auth::user()->hospital_id != $konfirmasi->lokasi_donor) {
            return redirect()->back()->with('error', 'Anda tidak berwenang melakukan Reject pada konfirmasi ini.');
        }

        // update status konfirmasi
        $konfirmasi->status = 'ditolak';
        $konfirmasi->save();

        // update status permohonan terkait (kembalikan ke menunggu atau sesuai flow)
        if ($konfirmasi->permohonan) {
            $konfirmasi->permohonan->status = 'menunggu'; // atau 'ditolak' sesuai kebutuhan
            $konfirmasi->permohonan->save();
        }

        return back()->with('success', 'Konfirmasi donor ditolak.');
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
        $adminHospitalId = Auth::user()->hospital_id;

        // Hanya ambil permohonan untuk rumah sakit admin ini
        $permohonan = PermohonanDarah::where('lokasi_rumah_sakit', $adminHospitalId)
                        ->with(['user', 'hospital'])
                        ->get();

        return view('admin.permohonan.index', compact('permohonan'));
    }

    public function permohonanUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:acc,reject'
        ]);

        // Update status permohonan darah
        $permohonan = PermohonanDarah::findOrFail($id);
        $permohonan->status = $request->status;
        $permohonan->save();

        // Update status konfirmasi pendonor yang terkait
        KonfirmasiDonor::where('id_permohonan', $id)->update([
            'status' => $request->status === 'acc' ? 'disetujui' : 'ditolak'
        ]);

        return redirect()->back()->with('success', 'Status permohonan berhasil diperbarui.');
    }



    public function permohonanShow($id)
    {
        $permohonan = PermohonanDarah::with(['user', 'hospital'])->findOrFail($id);

        return view('admin.permohonan.show', compact('permohonan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $permohonan = PermohonanDarah::findOrFail($id);
        $permohonan->status = $request->status;
        $permohonan->save();

        // CARI KONFIRMASI DONOR YANG BERHUBUNGAN
        KonfirmasiDonor::where('id_permohonan', $id)
            ->update([
                'status' => $request->status == 'acc'
                            ? 'disetujui'
                            : 'ditolak'
            ]);

        return back()->with('success', 'Status berhasil diperbarui.');
    }

}

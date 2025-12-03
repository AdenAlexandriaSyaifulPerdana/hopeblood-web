public function daftarPermintaan()
{
    // Ambil ID rumah sakit dari user admin ini
    $hospitalId = Auth::user()->hospital_id;

    // Ambil semua permintaan donor yang masuk ke RS ini
    $data = KonfirmasiDonor::with(['pendonor', 'permohonan', 'hospital'])
            ->where('lokasi_donor', $hospitalId)
            ->where('status', 'menunggu konfirmasi rumah sakit')
            ->get();

    return view('admin.permintaan', compact('data'));
}

public function setujui($id)
{
    $konfirmasi = KonfirmasiDonor::findOrFail($id);

    // Update status
    $konfirmasi->status = 'disetujui rumah sakit';
    $konfirmasi->save();

    return back()->with('success', 'Permintaan donor telah disetujui.');
}

public function tolak($id)
{
    $konfirmasi = KonfirmasiDonor::findOrFail($id);

    $konfirmasi->status = 'ditolak rumah sakit';
    $konfirmasi->save();

    return back()->with('success', 'Permintaan donor telah ditolak.');
}

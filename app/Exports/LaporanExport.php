<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Hospital;
use App\Models\penerima\PermohonanDarah;
use App\Models\pendonor\KonfirmasiDonor;
use Maatwebsite\Excel\Concerns\FromArray;

class LaporanExport implements FromArray
{
    public function array(): array
    {
        // =============================
        // RINGKASAN UTAMA
        // =============================
        $totalPendonor   = User::where('role', 'pendonor')->count();
        $totalPenerima   = User::where('role', 'penerima')->count();
        $totalPermohonan = PermohonanDarah::count();
        $donorDisetujui  = KonfirmasiDonor::where('status', 'disetujui')->count();
        $donorMenunggu   = KonfirmasiDonor::where('status', 'menunggu')->count();

        // =============================
        // STATISTIK GOLONGAN DARAH
        // =============================
        $golongan = PermohonanDarah::selectRaw('golongan_darah, COUNT(*) as total')
            ->groupBy('golongan_darah')
            ->get();

        $dataGolongan = [];
        foreach ($golongan as $g) {
            $dataGolongan[] = [$g->golongan_darah, $g->total];
        }

        // =============================
        // STATISTIK STATUS PERMOHONAN
        // =============================
        $status = PermohonanDarah::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        $dataStatus = [];
        foreach ($status as $s) {
            $dataStatus[] = [$s->status, $s->total];
        }

        return [
            ['LAPORAN STATISTIK HOPEBLOOD'],
            [''],
            ['RINGKASAN UTAMA'],
            ['Total Pendonor', $totalPendonor],
            ['Total Penerima', $totalPenerima],
            ['Total Permohonan', $totalPermohonan],
            ['Total Donor Disetujui', $donorDisetujui],
            ['Total Donor Menunggu', $donorMenunggu],
            [''],

            ['STATISTIK GOLONGAN DARAH'],
            ['Golongan', 'Jumlah'],
            ...$dataGolongan,
            [''],

            ['STATISTIK STATUS PERMOHONAN'],
            ['Status', 'Jumlah'],
            ...$dataStatus,
        ];
    }
}

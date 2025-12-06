<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tahun = (int) $request->query('year', date('Y'));
        $month = $request->query('month', null);
        $hospitalId = Auth::user()->hospital_id;

        /* ===============================
           1. PERTUMBUHAN USER
        =============================== */

        $rawData = DB::table('users')
            ->selectRaw("
                EXTRACT(MONTH FROM created_at) as bulan,
                SUM(CASE WHEN role = 'pendonor' THEN 1 ELSE 0 END) as total_pendonor,
                SUM(CASE WHEN role = 'penerima' THEN 1 ELSE 0 END) as total_penerima
            ")
            ->whereYear('created_at', $tahun)
            ->groupBy(DB::raw("EXTRACT(MONTH FROM created_at)"))
            ->orderBy(DB::raw("EXTRACT(MONTH FROM created_at)"))
            ->get();

        $bulanLengkap = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulanLengkap[$i] = ['pendonor' => 0, 'penerima' => 0];
        }

        foreach ($rawData as $data) {
            $bulanLengkap[(int)$data->bulan] = [
                'pendonor' => (int)$data->total_pendonor,
                'penerima' => (int)$data->total_penerima
            ];
        }

        /* ===============================
           2. GOLONGAN DARAH BULANAN
        =============================== */

        $dataGolonganBulanan = DB::table('permohonan_darah')
            ->selectRaw("
                EXTRACT(MONTH FROM created_at) as bulan,
                golongan_darah,
                COUNT(*) as total
            ")
            ->whereYear('created_at', $tahun)
            ->where('lokasi_rumah_sakit', $hospitalId)
            ->groupBy(DB::raw("EXTRACT(MONTH FROM created_at)"), 'golongan_darah')
            ->orderBy(DB::raw("EXTRACT(MONTH FROM created_at)"))
            ->get();

        $golonganBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $golonganBulanan[$i] = ['A'=>0,'B'=>0,'AB'=>0,'O'=>0];
        }

        foreach ($dataGolonganBulanan as $row) {
            $golonganBulanan[(int)$row->bulan][$row->golongan_darah] = (int)$row->total;
        }

        /* ===============================
           3. STATUS TOTAL TAHUNAN (RINGKASAN)
        =============================== */

        $statusPermohonan = DB::table('permohonan_darah')
            ->where('lokasi_rumah_sakit', $hospitalId)
            ->whereYear('created_at', $tahun)
            ->selectRaw("
                COUNT(*) as total,
                SUM(CASE WHEN status = 'acc' THEN 1 ELSE 0 END) as acc,
                SUM(CASE WHEN status != 'acc' THEN 1 ELSE 0 END) as reject
            ")
            ->first();

        $totalPermohonan = (int) ($statusPermohonan->total ?? 0);
        $totalAcc        = (int) ($statusPermohonan->acc ?? 0);
        $totalReject     = (int) ($statusPermohonan->reject ?? 0);

        $persenAcc = $totalPermohonan > 0
            ? round(($totalAcc / $totalPermohonan) * 100, 1)
            : 0;

        $grafikStatus = [
            'acc' => $totalAcc,
            'reject' => $totalReject
        ];

        /* ===============================
           4. STATUS PER BULAN (UNTUK GRAFIK %)
        =============================== */

        $statusBulananRaw = DB::table('permohonan_darah')
            ->selectRaw("
                EXTRACT(MONTH FROM created_at) as bulan,
                SUM(CASE WHEN status = 'acc' THEN 1 ELSE 0 END) as acc,
                SUM(CASE WHEN status != 'acc' THEN 1 ELSE 0 END) as reject
            ")
            ->whereYear('created_at', $tahun)
            ->where('lokasi_rumah_sakit', $hospitalId)
            ->groupBy(DB::raw("EXTRACT(MONTH FROM created_at)"))
            ->orderBy(DB::raw("EXTRACT(MONTH FROM created_at)"))
            ->get();

        $statusPerBulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $statusPerBulan[$i] = ['acc' => 0, 'reject' => 0];
        }

        foreach ($statusBulananRaw as $row) {
            $statusPerBulan[(int)$row->bulan] = [
                'acc' => (int)$row->acc,
                'reject' => (int)$row->reject
            ];
        }

        return view('admin.laporan.index', compact(
            'tahun',
            'bulanLengkap',
            'golonganBulanan',
            'totalPermohonan',
            'totalAcc',
            'totalReject',
            'persenAcc',
            'grafikStatus',
            'statusPerBulan'
        ));
    }

        public function pdf(Request $request)
    {
        $tahun = (int) $request->query('year', date('Y'));
        $hospitalId = Auth::user()->hospital_id;

        // ambil ulang data (ringkas)
        $totalPermohonan = DB::table('permohonan_darah')
            ->whereYear('created_at', $tahun)
            ->where('lokasi_rumah_sakit', $hospitalId)
            ->count();

        $totalAcc = DB::table('permohonan_darah')
            ->whereYear('created_at', $tahun)
            ->where('lokasi_rumah_sakit', $hospitalId)
            ->where('status', 'acc')
            ->count();

        $totalReject = $totalPermohonan - $totalAcc;

        $persenAcc = $totalPermohonan > 0
            ? round(($totalAcc / $totalPermohonan) * 100, 1)
            : 0;

        $pdf = Pdf::loadView('admin.laporan.pdf', compact(
            'tahun',
            'totalPermohonan',
            'totalAcc',
            'totalReject',
            'persenAcc'
        ));

        return $pdf->download("Laporan-$tahun.pdf");
    }


    public function exportExcel(Request $request)
    {
        $tahun = (int) $request->query('year', date('Y'));
        $hospitalId = Auth::user()->hospital_id;

        $data = DB::table('permohonan_darah')
            ->whereYear('created_at', $tahun)
            ->where('lokasi_rumah_sakit', $hospitalId)
            ->orderBy('created_at', 'desc')
            ->get(); // ✅ ambil semua kolom yang benar-benar ada

        $headers = [
            "Content-Type" => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=laporan-permohonan-$tahun.xls"
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // HEADER EXCEL (SESUIKAN DENGAN KOLOM ASLI)
            fputcsv($file, [
                'No',
                'Golongan Darah',
                'Jumlah Kantong',
                'Status',
                'Tanggal'
            ], "\t");

            foreach ($data as $i => $row) {
                fputcsv($file, [
                    $i + 1,
                    $row->golongan_darah ?? '-',
                    $row->jumlah_kantong ?? 0,
                    strtoupper($row->status ?? '-'),
                    date('d-m-Y', strtotime($row->created_at))
                ], "\t");
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}

@extends('admin.layout')

@section('content')
<div class="bg-gradient-to-br from-red-50 via-white to-sky-50 rounded-3xl shadow-md p-8 md:p-10 mb-8">
    <div class="grid md:grid-cols-2 gap-8 items-center">
        {{-- KIRI: TEKS HERO --}}
        <div class="space-y-4">
            <p class="text-xs md:text-sm uppercase tracking-[0.25em] text-red-500 font-semibold">
                keep the blood flowing
            </p>
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight">
                Blood<br class="hidden md:block" />
                <span class="text-red-500">Donation Control Center</span>
            </h2>
            <p class="text-sm md:text-base text-slate-600 max-w-md">
                Di dashboard ini kamu bisa memantau aktivitas donor, permohonan darah,
                dan performa rumah sakit mitra secara real time.
            </p>
            <ul class="text-xs md:text-sm text-slate-600 space-y-1">
                <li>• Pantau jumlah pendonor dan penerima terdaftar.</li>
                <li>• Lihat permohonan yang perlu diprioritaskan.</li>
                <li>• Kelola data rumah sakit dan laporan bulanan.</li>
            </ul>
        </div>

        {{-- KANAN: KARTU STATISTIK RINGKAS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-white rounded-2xl shadow p-5 border-l-4 border-red-500">
                <h3 class="text-xs font-semibold text-slate-500 uppercase">
                    Total Pendonor
                </h3>
                <p class="text-3xl font-extrabold text-red-600 mt-2">
                    {{ $jumlahPendonor }}
                </p>
                <p class="text-xs text-slate-500 mt-1">
                    Akun pendonor yang siap dihubungi.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow p-5 border-l-4 border-sky-500">
                <h3 class="text-xs font-semibold text-slate-500 uppercase">
                    Total Penerima
                </h3>
                <p class="text-3xl font-extrabold text-sky-600 mt-2">{{ $jumlahPenerima }}
                </p>
                <p class="text-xs text-slate-500 mt-1">
                    Pasien terdaftar yang pernah mengajukan permohonan.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow p-5 border-l-4 border-amber-400">
                <h3 class="text-xs font-semibold text-slate-500 uppercase">
                    Permohonan Menunggu
                </h3>
                    <p class="text-3xl font-extrabold text-amber-500 mt-2">{{ $permohonanMenunggu }}</p>
                </p>
                <p class="text-xs text-slate-500 mt-1">
                    Perlu segera diproses oleh admin.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow p-5 border-l-4 border-emerald-500">
                <h3 class="text-xs font-semibold text-slate-500 uppercase">
                    Permohonan Terpenuhi
                </h3>
                    <p class="text-3xl font-extrabold text-emerald-600 mt-2">{{ $permohonanTerpenuhi }}</p>
                </p>
                <p class="text-xs text-slate-500 mt-1">
                    Donasi berhasil tersalurkan.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

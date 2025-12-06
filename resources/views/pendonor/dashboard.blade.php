@extends('pendonor.layout')

@section('content')
<div class="bg-gradient-to-br from-sky-50 via-white to-sky-100 rounded-3xl shadow-md p-8 md:p-10">
    <div class="grid md:grid-cols-2 gap-8 items-center">

        {{-- LEFT SECTION --}}
        <div class="space-y-5">
            <p class="text-sm uppercase tracking-[0.2em] text-sky-500 font-semibold">
                Donate Blood, Save Lives
            </p>

            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight">
                Blood<br class="hidden md:block" />
                <span class="text-sky-600">Donation</span>
            </h2>

            <p class="text-sm md:text-base text-slate-600 max-w-md">
                Terima kasih telah menjadi pendonor. Di dashboard ini kamu bisa melihat jadwal,
                riwayat donasi, dan permintaan darah yang membutuhkan bantuanmu.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="{{ route('pendonor.permintaan') }}"
                   class="inline-flex items-center px-5 py-2.5 rounded-full bg-red-500 text-white text-sm font-semibold shadow-md hover:bg-red-600 transition">
                    Lihat Permintaan
                </a>

                <a href="{{ route('pendonor.riwayat') }}"
                   class="inline-flex items-center px-5 py-2.5 rounded-full border border-sky-500 text-sky-600 text-sm font-semibold hover:bg-sky-50 transition">
                    Riwayat Donor
                </a>
            </div>
        </div>

        {{-- RIGHT SECTION (CARD) --}}
        <div class="relative">
            <div class="relative mx-auto w-full max-w-md">

                {{-- MAIN CARD --}}
                <div class="relative bg-white rounded-3xl shadow-xl px-7 py-6">
                    {{-- HEADER STATUS --}}
                    <div class="flex items-center justify-between mb-4">
                        <div class="inline-flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center text-white font-bold text-sm">
                                +
                            </span>
                            <span class="text-sm font-semibold text-slate-800">Status Pendonor</span>
                        </div>

                        <span class="text-xs px-3 py-1 rounded-full bg-red-50 text-red-500 font-semibold">
                            Aktif
                        </span>
                    </div>

                    <div class="space-y-3 text-sm text-slate-600">
                        <div class="flex items-center justify-between">
                            <span>Permintaan menunggu</span>
                            <span class="font-semibold text-amber-500">
                                {{ $permintaan_menunggu ?? 0 }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Permintaan disetujui</span>
                            <span class="font-semibold text-emerald-600">
                                {{ $permintaan_disetujui ?? 0 }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Permintaan ditolak</span>
                            <span class="font-semibold text-rose-500">
                                {{ $permintaan_ditolak ?? 0 }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

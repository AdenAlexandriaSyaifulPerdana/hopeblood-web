@extends('penerima.layout')

@section('content')
<div class="bg-gradient-to-br from-sky-50 via-white to-sky-100 rounded-3xl shadow-md p-8 md:p-10">
    <div class="grid md:grid-cols-2 gap-8 items-center">

        {{-- Kiri: teks hero --}}
        <div class="space-y-5">
            <p class="text-xs md:text-sm uppercase tracking-[0.2em] text-sky-500 font-semibold">
                find blood, save lives
            </p>

            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight">
                Blood<br />
                <span class="text-red-500">Donation Finder</span>
            </h2>

            <p class="text-sm md:text-base text-slate-600 max-w-md">
                Ajukan permohonan darah dan pantau statusnya secara realtime.
                Sistem akan membantu mencarikan pendonor yang sesuai kebutuhanmu.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="{{ route('penerima.permohonan.form') }}"
                   class="inline-flex items-center px-5 py-2.5 rounded-full bg-red-500 text-white text-sm font-semibold shadow-md hover:bg-red-600 transition">
                    Buat Permohonan Darah
                </a>

                <a href="{{ route('penerima.permohonan.status') }}"
                   class="inline-flex items-center px-5 py-2.5 rounded-full border border-sky-500 text-sky-600 text-sm font-semibold hover:bg-sky-50 transition">
                    Lihat Status Permohonan
                </a>
            </div>
        </div>

        {{-- Kanan: kartu status ringkas --}}
        <div class="relative">
            <div class="relative mx-auto w-full max-w-md bg-white rounded-3xl shadow-xl px-7 py-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="inline-flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center text-white font-bold text-sm">
                            +
                        </span>
                        <span class="text-sm font-semibold text-slate-800">Ringkasan Permohonan</span>
                    </div>
                </div>

                <div class="space-y-3 text-sm text-slate-600">
                    <div class="flex items-center justify-between">
                        <span>Sedang diproses</span>
                        <span class="font-semibold text-orange-500">{{ $permohonan_proses ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Terkabul</span>
                        <span class="font-semibold text-emerald-500">{{ $permohonan_terkabul ?? 0 }}</span>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('penerima.permohonan.status') }}"
                       class="text-xs text-sky-600 hover:text-sky-700 font-medium">
                        Lihat detail permohonan →
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

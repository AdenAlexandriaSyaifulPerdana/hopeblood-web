{{-- resources/views/penerima/permohonan-status.blade.php --}}
@extends('penerima.layout')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-3xl shadow-md px-6 py-7 md:px-8 md:py-8">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">
                    Status Permohonan Darah
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                    Daftar permohonan darah yang pernah kamu ajukan.
                </p>
            </div>

            <a href="{{ route('penerima.permohonan.form') }}"
               class="inline-flex items-center px-4 py-2 rounded-full bg-red-500 text-white text-xs md:text-sm font-semibold shadow hover:bg-red-600 transition">
                + Buat Permohonan Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-600">
                        <th class="px-4 py-3 text-left font-semibold border-b border-slate-200">
                            Golongan Darah
                        </th>
                        <th class="px-4 py-3 text-left font-semibold border-b border-slate-200">
                            Rumah Sakit
                        </th>
                        <th class="px-4 py-3 text-left font-semibold border-b border-slate-200">
                            Keterangan
                        </th>
                        <th class="px-4 py-3 text-left font-semibold border-b border-slate-200">
                            Status
                        </th>
                        <th class="px-4 py-3 text-left font-semibold border-b border-slate-200">
                            Dibuat
                        </th>
                    </tr>
                </thead>
                <tbody class="text-slate-700">
                    @forelse ($data as $d)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 border-b border-slate-100">
                                {{ $d->golongan_darah }}
                            </td>
                            <td class="px-4 py-3 border-b border-slate-100">
                                {{ $d->lokasi_rumah_sakit }}
                            </td>
                            <td class="px-4 py-3 border-b border-slate-100 max-w-xs">
                                <span class="block truncate" title="{{ $d->keterangan }}">
                                    {{ $d->keterangan ?: '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 border-b border-slate-100">
                                @php
                                    $color = match($d->status) {
                                        'menunggu' => 'bg-amber-50 text-amber-700 border-amber-200',
                                        'diproses' => 'bg-sky-50 text-sky-700 border-sky-200',
                                        'terpenuhi' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'ditolak' => 'bg-rose-50 text-rose-700 border-rose-200',
                                        default => 'bg-slate-50 text-slate-700 border-slate-200',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $color }}">
                                    {{ ucfirst($d->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 border-b border-slate-100 text-xs text-slate-500">
                                {{ $d->created_at->format('d M Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-slate-500 text-sm">
                                Belum ada permohonan darah yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5 flex justify-between items-center">
            <a href="{{ route('penerima.dashboard') }}"
               class="text-sm text-sky-600 hover:text-sky-700 font-medium">
                ← Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection

@extends('admin.layout')

@section('content')
<div class="bg-white shadow-md rounded-3xl p-6 md:p-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 flex items-center gap-2">
                <span>🏥</span>
                <span>Data Rumah Sakit</span>
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Daftar rumah sakit mitra yang dapat menerima permohonan donor darah.
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-2xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm border-collapse">
            <thead>
                <tr class="bg-red-600 text-white">
                    <th class="px-4 py-3 text-left font-semibold">Nama Rumah Sakit</th>
                    <th class="px-4 py-3 text-left font-semibold">Alamat</th>
                    <th class="px-4 py-3 text-left font-semibold">Jam Operasional</th>
                    <th class="px-4 py-3 text-left font-semibold">No. HP</th>
                </tr>
            </thead>
            <tbody class="text-slate-700">
                @forelse ($hospitals as $h)
                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                        <td class="px-4 py-3 font-semibold">
                            {{ $h->nama_rumah_sakit }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $h->alamat }}
                        </td>
                        <td class="px-4 py-3 text-xs md:text-sm text-slate-600">
                            {{ $h->jam_operasional }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-xs font-medium text-slate-700">
                                {{ $h->nomer_hp }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-slate-500">
                            Belum ada data rumah sakit yang terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

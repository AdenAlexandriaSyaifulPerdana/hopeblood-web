@extends('pendonor.layout')

@section('content')
<div class="bg-white shadow-md rounded-2xl p-6 md:p-8">

    <h2 class="text-2xl font-bold text-slate-800 mb-6">
        Riwayat Donor
    </h2>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm border border-slate-200 rounded-lg overflow-hidden">
            <thead class="bg-slate-100 text-slate-700">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Golongan Darah</th>
                    <th class="px-4 py-3 text-left">Rumah Sakit</th>
                    <th class="px-4 py-3 text-left">Tanggal Donor</th>
                    <th class="px-4 py-3 text-left">Waktu Donor</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Surat Rujukan</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200">
                @forelse ($riwayat as $r)
                <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>

                    {{-- Golongan darah dari permohonan --}}
                    <td class="px-4 py-3">{{ $r->permohonan->golongan_darah ?? '-' }}</td>

                    {{-- Nama rumah sakit --}}
                    <td class="px-4 py-3">{{ $r->hospital->nama_rumah_sakit ?? '-' }}</td>

                    <td class="px-4 py-3">{{ $r->tanggal_donor }}</td>
                    <td class="px-4 py-3">{{ $r->waktu_donor }}</td>

                    {{-- STATUS --}}
                    <td class="px-4 py-3">
                        @if ($r->status == 'menunggu konfirmasi rumah sakit')
                            <span class="px-2.5 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">
                                Menunggu
                            </span>
                        @elseif ($r->status == 'disetujui')
                            <span class="px-2.5 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">
                                Disetujui
                            </span>
                        @else
                            <span class="px-2.5 py-1 text-xs rounded-full bg-red-100 text-red-700 font-medium">
                                Ditolak
                            </span>
                        @endif
                    </td>

                    {{-- SURAT RUJUKAN --}}
                    <td class="px-4 py-3">
                        @if ($r->status == 'disetujui')
                            <a href="{{ route('pendonor.downloadSurat', $r->id) }}"
                               class="inline-block px-4 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-lg shadow">
                                Download PDF
                            </a>
                        @else
                            <span class="text-slate-400 text-xs">Belum tersedia</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-6 text-slate-500">
                        Belum ada riwayat donor.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection

@extends('admin.layout')

@section('content')
<div class="bg-white shadow-md rounded-3xl p-6 md:p-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Daftar Permohonan Darah</h2>
            <p class="text-sm text-slate-500 mt-1">
                Pantau dan kelola status permohonan darah dari penerima.
            </p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm border-collapse">
            <thead>
                <tr class="bg-red-600 text-white">
                    <th class="px-4 py-3 text-left font-semibold">No</th>
                    <th class="px-4 py-3 text-left font-semibold">Nama Penerima</th>
                    <th class="px-4 py-3 text-left font-semibold">Golongan Darah</th>
                    <th class="px-4 py-3 text-left font-semibold">Rumah Sakit</th>
                    <th class="px-4 py-3 text-left font-semibold">Status</th>
                    @if ($permohonan->where('lokasi_rumah_sakit', Auth::user()->hospital_id)->count() > 0)
                        <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                    @endif
                </tr>
            </thead>

            <tbody class="text-slate-700">
                @forelse ($permohonan as $p)
                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $p->user->name }}</td>
                        <td class="px-4 py-3">{{ $p->golongan_darah }}</td>
                        <td class="px-4 py-3">{{ $p->hospital->nama_rumah_sakit ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if ($p->status == 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-semibold">
                                    Pending
                                </span>
                            @elseif ($p->status == 'acc')
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">
                                    Disetujui
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-rose-50 text-rose-700 text-xs font-semibold">
                                    Ditolak
                                </span>
                            @endif
                        </td>

                        @if (Auth::user()->hospital_id == $p->lokasi_rumah_sakit)
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-2">
                                    {{-- ACC --}}
                                    <form action="{{ route('admin.permohonan.status', $p->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="acc">
                                        <button
                                            class="inline-flex items-center px-3 py-1.5 rounded-full bg-emerald-500 text-white text-xs font-semibold hover:bg-emerald-600">
                                            ACC
                                        </button>
                                    </form>

                                    {{-- Reject --}}
                                    <form action="{{ route('admin.permohonan.status', $p->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="reject">
                                        <button
                                            class="inline-flex items-center px-3 py-1.5 rounded-full bg-rose-500 text-white text-xs font-semibold hover:bg-rose-600">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-slate-500">
                            Belum ada permohonan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('admin.layout')

@section('content')
<div class="bg-white shadow-md rounded-3xl p-6 md:p-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Data Penerima</h2>
            <p class="text-sm text-slate-500 mt-1">
                Kelola akun penerima darah yang terdaftar.
            </p>
        </div>

        <a href="{{ route('admin.penerima.create') }}"
           class="inline-flex items-center gap-2 bg-red-600 text-white px-4 py-2.5 rounded-full text-sm font-semibold hover:bg-red-700 transition shadow">
            <span class="text-lg leading-none">+</span>
            <span>Tambah Penerima</span>
        </a>
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
                    <th class="p-3 text-left font-semibold">Nama</th>
                    <th class="p-3 text-left font-semibold">Email</th>
                    <th class="p-3 text-left font-semibold w-40">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-slate-700">
                @forelse($penerimas as $penerima)
                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                        <td class="p-3">{{ $penerima->name }}</td>
                        <td class="p-3">{{ $penerima->email }}</td>
                        <td class="p-3">
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('admin.penerima.edit', $penerima->id) }}"
                                   class="inline-flex items-center px-3 py-1.5 rounded-full bg-amber-500 text-white text-xs font-semibold hover:bg-amber-600">
                                    Edit
                                </a>
                                <form action="{{ route('admin.penerima.destroy', $penerima->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus penerima ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="inline-flex items-center px-3 py-1.5 rounded-full bg-red-600 text-white text-xs font-semibold hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-5 text-center text-slate-500">
                            Belum ada data penerima.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('admin.layout')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Data Pendonor</h2>
        <a href="{{ route('admin.pendonor.create') }}"
           class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
            + Tambah Pendonor
        </a>
    </div>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-red-600 text-white">
                <th class="p-3 text-left">Nama</th>
                <th class="p-3 text-left">Email</th>
                <th class="p-3 text-left">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($pendonors as $pendonor)
            <tr class="border-b hover:bg-gray-100">
                <td class="p-3">{{ $pendonor->name }}</td>
                <td class="p-3">{{ $pendonor->email }}</td>
                <td class="p-3 flex space-x-2">
                    <a href="{{ route('admin.pendonor.edit', $pendonor->id) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">
                        Edit
                    </a>

                    <form method="POST"
                          action="{{ route('admin.pendonor.destroy', $pendonor->id) }}"
                          onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="p-3 text-center text-gray-500">Tidak ada data pendonor</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('admin.layout')

@section('content')
<h2 class="text-2xl font-bold mb-4">Daftar Pendonor Menunggu Konfirmasi</h2>

<table class="table-auto w-full border">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2">Pendonor</th>
            <th class="px-4 py-2">Lokasi</th>
            <th class="px-4 py-2">Tanggal</th>
            <th class="px-4 py-2">Waktu</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($konfirmasi as $k)
        <tr>
            <td class="px-4 py-2">{{ $k->pendonor->name }}</td>
            <td class="px-4 py-2">{{ $k->lokasi_donor }}</td>
            <td class="px-4 py-2">{{ $k->tanggal_donor }}</td>
            <td class="px-4 py-2">{{ $k->waktu_donor }}</td>

            <td class="px-4 py-2 flex gap-2">

                <form action="{{ route('admin.konfirmasi.acc', $k->id) }}" method="POST">
                    @csrf @method('PUT')
                    <button class="bg-green-500 text-white px-3 py-1 rounded">ACC</button>
                </form>

                <form action="{{ route('admin.konfirmasi.reject', $k->id) }}" method="POST">
                    @csrf @method('PUT')
                    <button class="bg-red-500 text-white px-3 py-1 rounded">Tolak</button>
                </form>

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center py-3 text-gray-500">
                Tidak ada konfirmasi donor.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection

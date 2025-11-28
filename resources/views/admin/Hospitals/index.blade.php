@extends('admin.layout')

@section('content')

<h2 class="text-3xl font-bold mb-6">🏥 Data Rumah Sakit</h2>

@if(session('success'))
<div class="bg-green-200 text-green-800 px-4 py-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-lg shadow p-6">
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border">Nama Rumah Sakit</th>
                <th class="px-4 py-2 border">Alamat</th>
                <th class="px-4 py-2 border">Jam Operasional</th>
                <th class="px-4 py-2 border">No. HP</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($hospitals as $h)
            <tr>
                <td class="px-4 py-2 border">{{ $h->nama_rumah_sakit }}</td>
                <td class="px-4 py-2 border">{{ $h->alamat }}</td>
                <td class="px-4 py-2 border">{{ $h->jam_operasional }}</td>
                <td class="px-4 py-2 border">{{ $h->nomer_hp }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

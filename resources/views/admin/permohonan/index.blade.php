@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Daftar Permintaan Darah</h1>

<table class="table-auto w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Nama Penerima</th>
            <th class="px-4 py-2">Golongan Darah</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($permohonans as $p)
            <tr>
                <td class="px-4 py-2">{{ $p->id }}</td>
                <td class="px-4 py-2">{{ $p->nama }}</td>
                <td class="px-4 py-2">{{ $p->golongan_darah }}</td>
                <td class="px-4 py-2">{{ $p->status }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('admin.permohonan.show', $p->id) }}"
                       class="text-blue-600 hover:underline">
                        Detail
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

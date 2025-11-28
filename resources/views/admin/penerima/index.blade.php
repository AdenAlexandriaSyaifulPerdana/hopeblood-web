@extends('admin.layout')

@section('content')

<h2 class="text-2xl font-bold mb-4">Data Penerima Darah</h2>

<a href="{{ route('admin.penerima.create') }}"
   class="bg-red-600 text-white px-4 py-2 rounded-md mb-4 inline-block">
   + Tambah Penerima
</a>

<table class="w-full bg-white shadow rounded-lg">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="p-3">Nama</th>
            <th class="p-3">Email</th>
            <th class="p-3">Usia</th>
            <th class="p-3">Gol. Darah</th>
            <th class="p-3">Alamat</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($penerimas as $p)
        <tr class="border-b">
            <td class="p-3">{{ $p->name }}</td>
            <td class="p-3">{{ $p->email }}</td>
            <td class="p-3">{{ $p->usia }}</td>
            <td class="p-3">{{ $p->golongan_darah }}</td>
            <td class="p-3">{{ $p->alamat }}</td>
            <td class="p-3 flex space-x-2">

                <a href="{{ route('admin.penerima.edit', $p->id) }}"
                   class="bg-blue-500 text-white px-3 py-1 rounded">
                    Edit
                </a>

                <form action="{{ route('admin.penerima.destroy', $p->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin hapus penerima ini?');">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white px-3 py-1 rounded">
                        Hapus
                    </button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

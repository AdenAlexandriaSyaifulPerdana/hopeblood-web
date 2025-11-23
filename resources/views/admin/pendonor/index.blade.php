@extends('admin.layout')

@section('content')
<h2>Data Pendonor</h2>

<a href="{{ route('admin.pendonor.create') }}" class="btn btn-primary">Tambah Pendonor</a>

@if(session('success'))
    <div class="alert alert-success mt-2">{{ session('success') }}</div>
@endif

<table class="table mt-3">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Aksi</th>
    </tr>

    @foreach($pendonors as $p)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->name }}</td>
        <td>{{ $p->email }}</td>
        <td>
            <a href="{{ route('admin.pendonor.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>

            <form action="{{ route('admin.pendonor.destroy', $p->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach

</table>
@endsection

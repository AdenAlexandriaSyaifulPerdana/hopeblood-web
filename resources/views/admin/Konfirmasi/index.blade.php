@extends('admin.layout') {{-- sesuaikan layoutmu --}}

@section('content')
<h2>Konfirmasi Donor Masuk</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Pendonor</th>
            <th>Permohonan ID</th>
            <th>Tanggal Donor</th>
            <th>Waktu Donor</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse($konfirmasi as $k)
        <tr>
            <td>{{ $k->pendonor->name }}</td>
            <td>{{ $k->id_permohonan }}</td>
            <td>{{ $k->tanggal_donor }}</td>
            <td>{{ $k->waktu_donor }}</td>
            <td>
                <form action="{{ route('admin.konfirmasi.acc', $k->id) }}" method="POST" style="display:inline">
                    @csrf @method('PUT')
                    <button type="submit">ACC</button>
                </form>
                <form action="{{ route('admin.konfirmasi.reject', $k->id) }}" method="POST" style="display:inline">
                    @csrf @method('PUT')
                    <button type="submit">Tolak</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="5">Tidak ada konfirmasi donor.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection

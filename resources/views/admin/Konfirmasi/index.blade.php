@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h3>Konfirmasi Donor Masuk</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pendonor</th>
                <th>Nama Pasien</th>
                <th>Golongan Darah</th>
                <th>Rumah Sakit Tujuan</th>
                <th>Tanggal Donor</th>
                <th>Waktu Donor</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($konfirmasi as $k)
            <tr>
                <td>{{ $loop->iteration }}</td>

                {{-- Nama Pendonor --}}
                <td>{{ $k->pendonor->name ?? '-' }}</td>

                {{-- Nama Pasien dari permohonan --}}
                <td>{{ $k->permohonan->user->name ?? '-' }}</td>

                {{-- Golongan Darah dari permohonan --}}
                <td>{{ $k->permohonan->golongan_darah ?? '-' }}</td>

                {{-- Rumah Sakit Tujuan --}}
                <td>{{ $k->hospital->nama_rumah_sakit ?? '-' }}</td>

                <td>{{ $k->tanggal_donor }}</td>
                <td>{{ $k->waktu_donor }}</td>

                <td>
                    @if($k->status === 'menunggu konfirmasi rumah sakit')
                        <span class="badge bg-warning">Menunggu</span>
                    @elseif($k->status === 'disetujui')
                        <span class="badge bg-success">Disetujui</span>
                    @else
                        <span class="badge bg-danger">Ditolak</span>
                    @endif
                </td>

                <td>
                    @if($k->status === 'menunggu konfirmasi rumah sakit')
                        <form action="{{ route('admin.konfirmasi.acc', $k->id) }}" method="POST" style="display:inline">
                            @csrf @method('PUT')
                            <button class="btn btn-success btn-sm">ACC</button>
                        </form>

                        <form action="{{ route('admin.konfirmasi.reject', $k->id) }}" method="POST" style="display:inline">
                            @csrf @method('PUT')
                            <button class="btn btn-danger btn-sm">Tolak</button>
                        </form>
                    @else
                        <em class="text-muted">Selesai</em>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center text-muted">Tidak ada konfirmasi donor.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection

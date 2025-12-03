@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h3>Daftar Permohonan Darah</h3>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penerima</th>
                <th>Golongan Darah</th>
                <th>Rumah Sakit</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($permohonan as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->user->name }}</td>
                <td>{{ $p->golongan_darah }}</td>
                <td>{{ $p->hospital->nama_rumah_sakit ?? '-' }}</td>
                <td>
                    @if ($p->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($p->status == 'acc')
                        <span class="badge bg-success">ACC</span>
                    @else
                        <span class="badge bg-danger">Rejected</span>
                    @endif
                </td>
                <td class="d-flex">

                    {{-- Tombol ACC --}}
                    <form action="{{ route('admin.permohonan.status', $p->id) }}" method="POST" class="me-2">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="acc">
                        <button class="btn btn-success btn-sm">ACC</button>
                    </form>

                    {{-- Tombol Reject --}}
                    <form action="{{ route('admin.permohonan.status', $p->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="reject">
                        <button class="btn btn-danger btn-sm">Reject</button>
                    </form>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada permohonan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('pendonor.layout')

@section('content')
<div class="container mt-4">
    <h3>Riwayat Donor</h3>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Golongan Darah Permintaan</th>
                <th>Rumah Sakit</th>
                <th>Tanggal Donor</th>
                <th>Waktu Donor</th>
                <th>Status</th>
                <th>Surat Rujukan</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($riwayat as $r)
            <tr>
                <td>{{ $loop->iteration }}</td>

                {{-- Golongan darah dari permohonan --}}
                <td>{{ $r->permohonan->golongan_darah ?? '-' }}</td>

                {{-- Nama rumah sakit dari relasi hospital --}}
                <td>{{ $r->hospital->nama_rumah_sakit ?? '-' }}</td>

                <td>{{ $r->tanggal_donor }}</td>
                <td>{{ $r->waktu_donor }}</td>

                <td>
                    @if ($r->status == 'menunggu konfirmasi rumah sakit')
                        <span class="badge bg-warning">Menunggu</span>
                    @elseif ($r->status == 'disetujui')
                        <span class="badge bg-success">Disetujui</span>
                    @else
                        <span class="badge bg-danger">Ditolak</span>
                    @endif
                </td>

                {{-- Tombol download hanya muncul jika status disetujui --}}
                <td>
                    @if ($r->status == 'disetujui')
                        <a href="{{ route('pendonor.downloadSurat', $r->id) }}"
                           class="btn btn-primary btn-sm">
                            Download PDF
                        </a>
                    @else
                        <span class="text-muted">Belum tersedia</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada riwayat</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

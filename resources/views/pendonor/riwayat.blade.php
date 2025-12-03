<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Donor</title>
</head>
<body>

<h2>Riwayat Donor Anda</h2>
<hr>

@if ($riwayat->isEmpty())
    <p>Belum ada riwayat donor.</p>
@else
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Golongan Darah</th>
            <th>Tanggal Donor</th>
            <th>Waktu Donor</th>
            <th>Lokasi Donor</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($riwayat as $r)
        <tr>
            <td>{{ $r->permohonan->golongan_darah ?? '-' }}</td>
            <td>{{ $r->tanggal_donor }}</td>
            <td>{{ $r->waktu_donor }}</td>
            <td>{{ $r->hospital->nama_rumah_sakit ?? '-' }}</td>
            <td>{{ $r->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

</body>
</html>

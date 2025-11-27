<h1>Status Permohonan Darah</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8">
    <tr>
        <th>Golongan Darah</th>
        <th>Rumah Sakit</th>
        <th>Keterangan</th>
        <th>Status</th>
        <th>Dibuat</th>
    </tr>

    @foreach ($data as $d)
    <tr>
        <td>{{ $d->golongan_darah }}</td>
        <td>{{ $d->lokasi_rumah_sakit }}</td>
        <td>{{ $d->keterangan }}</td>
        <td>{{ $d->status }}</td>
        <td>{{ $d->created_at }}</td>
    </tr>
    @endforeach
</table>

<br>

<a href="{{ route('penerima.dashboard') }}">Kembali ke Dashboard</a>

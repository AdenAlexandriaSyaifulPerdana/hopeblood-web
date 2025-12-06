<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Penerima</title>
</head>
<body>

<h1>Profil Penerima</h1>

{{-- Notifikasi Sukses --}}
@if(session('success'))
    <p style="padding:10px; background:#d4edda; color:#155724; border:1px solid #c3e6cb;">
        {{ session('success') }}
    </p>
@endif

<p><strong>Nama:</strong> {{ $user->name }}</p>
<p><strong>Usia:</strong> {{ $user->usia ?? '-' }}</p>
<p><strong>Alamat:</strong> {{ $user->alamat ?? '-' }}</p>
<p><strong>Golongan Darah:</strong> {{ $user->golongan_darah ?? '-' }}</p>

<br>

<a href="{{ route('penerima.profile.edit') }}"
   style="display:inline-block; padding:8px 14px; background:#007bff; color:white; text-decoration:none; border-radius:4px;">
    Edit Profil
</a>

<br><br>

<a href="{{ route('penerima.dashboard') }}"
   style="display:inline-block; padding:8px 14px; background:#6c757d; color:white; text-decoration:none; border-radius:4px;">
    Kembali ke Dashboard
</a>

</body>
</html>

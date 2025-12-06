<h1>Dashboard Penerima Darah</h1>

<p>Halo, {{ Auth::user()->name }}</p>

<hr>

<h3>Menu Utama</h3>

<!-- Tombol buat permohonan -->
<a href="{{ route('penerima.permohonan.form') }}">
    <button>Buat Permohonan Darah</button>
</a>
<br><br>

<!-- Tombol lihat status -->
<a href="{{ route('penerima.permohonan.status') }}">
    <button>Lihat Status Permohonan Darah</button>
</a>


<!-- Tombol Profil  -->
<a href="{{ route('penerima.profile') }}">Lihat Profil</a>

<hr>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

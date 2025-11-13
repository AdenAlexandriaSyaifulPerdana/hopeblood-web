<h1>Dashboard Pengguna</h1>
<p>Halo, {{ Auth::user()->name }}</p>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

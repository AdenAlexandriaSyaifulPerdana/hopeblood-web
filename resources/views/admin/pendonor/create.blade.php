@extends('admin.layout')

@section('content')
<h2>Tambah Pendonor</h2>

<form action="{{ route('admin.pendonor.store') }}" method="POST">
    @csrf

    <label>Nama</label>
    <input type="text" name="name" class="form-control">

    <label>Email</label>
    <input type="email" name="email" class="form-control">

    <label>Password</label>
    <input type="password" name="password" class="form-control">

    <button class="btn btn-primary mt-3">Simpan</button>
</form>
@endsection

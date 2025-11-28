@extends('admin.layout')

@section('content')

<h2 class="text-2xl font-bold mb-4">Tambah Penerima Darah</h2>

<form action="{{ route('admin.penerima.store') }}" method="POST" class="space-y-4">
    @csrf

    <input type="text" name="name" placeholder="Nama lengkap" class="w-full p-2 border rounded">

    <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded">

    <input type="number" name="usia" placeholder="Usia" class="w-full p-2 border rounded">

    <input type="text" name="golongan_darah" placeholder="Golongan Darah (A/B/O/AB)" class="w-full p-2 border rounded">

    <textarea name="alamat" placeholder="Alamat" class="w-full p-2 border rounded"></textarea>

    <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded">

    <button class="bg-red-600 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>

@endsection

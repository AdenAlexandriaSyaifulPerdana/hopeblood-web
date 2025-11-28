@extends('admin.layout')

@section('content')

<h2 class="text-2xl font-bold mb-4">Edit Penerima Darah</h2>

<form action="{{ route('admin.penerima.update', $penerima->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $penerima->name }}" class="w-full p-2 border rounded">

    <input type="email" name="email" value="{{ $penerima->email }}" class="w-full p-2 border rounded">

    <input type="number" name="usia" value="{{ $penerima->usia }}" class="w-full p-2 border rounded">

    <input type="text" name="golongan_darah" value="{{ $penerima->golongan_darah }}" class="w-full p-2 border rounded">

    <textarea name="alamat" class="w-full p-2 border rounded">{{ $penerima->alamat }}</textarea>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Update
    </button>
</form>

@endsection

@extends('admin.layout')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-6 max-w-xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Tambah Pendonor</h2>

    <form action="{{ route('admin.pendonor.store') }}" method="POST">
        @csrf

        <label class="block mb-2 font-semibold">Nama</label>
        <input type="text" name="name"
               class="w-full border rounded-lg px-4 py-2 mb-4"
               required>

        <label class="block mb-2 font-semibold">Email</label>
        <input type="email" name="email"
               class="w-full border rounded-lg px-4 py-2 mb-4"
               required>

        <label class="block mb-2 font-semibold">Password</label>
        <input type="password" name="password"
               class="w-full border rounded-lg px-4 py-2 mb-4"
               required>

        <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
            Simpan
        </button>
    </form>

</div>
@endsection

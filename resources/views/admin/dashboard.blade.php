@extends('admin.layout')

@section('content')

<div class="bg-white p-8 rounded-xl shadow-md">

    <h2 class="text-3xl font-bold text-red-600 mb-4">Dashboard Admin</h2>
    <p class="text-gray-600 mb-6">
        Selamat datang di sistem manajemen donor darah.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-red-50 p-6 rounded-xl shadow">
            <h3 class="text-xl font-bold text-red-700">Pendonor Terdaftar</h3>
            <p class="text-3xl font-bold mt-2">{{ $pendonorCount ?? 0 }}</p>
        </div>

        <div class="bg-blue-50 p-6 rounded-xl shadow">
            <h3 class="text-xl font-bold text-blue-700">Penerima Darah</h3>
            <p class="text-3xl font-bold mt-2">{{ $penerimaCount ?? 0 }}</p>
        </div>

        <div class="bg-green-50 p-6 rounded-xl shadow">
            <h3 class="text-xl font-bold text-green-700">Permintaan Aktif</h3>
            <p class="text-3xl font-bold mt-2">{{ $permintaanCount ?? 0 }}</p>
        </div>

    </div>

</div>

@endsection

@extends('admin.layout')

@section('content')

<h2 class="text-3xl font-bold mb-6 text-gray-700">Dashboard Admin</h2>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

    <!-- Card Pendonor -->
    <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-red-500">
        <h3 class="text-lg font-semibold text-gray-700">Total Pendonor</h3>
        <p class="text-4xl font-bold text-red-600 mt-2">{{ $jumlahPendonor }}</p>
    </div>

    <!-- Card Penerima -->
    <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-blue-500">
        <h3 class="text-lg font-semibold text-gray-700">Total Penerima Darah</h3>
        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $jumlahPenerima }}</p>
    </div>

</div>

@endsection

@extends('admin.layout')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">

    <h2 class="text-xl font-bold mb-5">Profil Penerima</h2>

    {{-- ✅ PESAN BERHASIL UPDATE --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-3 text-sm">
        <p><b>Nama:</b> {{ $user->name }}</p>
        <p><b>Usia:</b> {{ $user->usia ?? '-' }}</p>
        <p><b>Alamat:</b> {{ $user->alamat ?? '-' }}</p>
    </div>

    <div class="mt-6 flex gap-3">
        <a href="{{ route('penerima.profile.edit') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded">
           Edit Profil
        </a>

        <a href="{{ route('penerima.dashboard') }}"
           class="bg-gray-400 text-white px-4 py-2 rounded">
           Kembali
        </a>
    </div>

</div>
@endsection

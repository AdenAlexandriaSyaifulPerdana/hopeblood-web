@extends('admin.layout')

    @section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

        <h2 class="text-lg font-bold mb-5">Edit Profil Penerima</h2>
    @if(session('warning'))
        <div class="bg-yellow-100 text-yellow-700 p-3 mb-4 rounded">
            {{ session('warning') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

{{-- PESAN WARNING --}}
@if(session('warning'))
    <div class="mb-4 bg-yellow-100 text-yellow-800 p-3 rounded">
        {{ session('warning') }}
    </div>
@endif

{{-- PESAN ERROR VALIDASI --}}
@if ($errors->any())
    <div class="mb-4 bg-red-100 text-red-800 p-3 rounded">
        <ul class="list-disc list-inside">/
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form action="{{ route('penerima.profile.update') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm mb-1">Nama</label>
            <input type="text" name="name"
                   value="{{ old('name', $user->name) }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block text-sm mb-1">Usia</label>
            <input type="number" name="usia"
                   value="{{ old('usia', $user->usia) }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block text-sm mb-1">Alamat</label>
            <textarea name="alamat"
                      class="w-full border p-2 rounded">{{ old('alamat', $user->alamat) }}</textarea>
        </div>

        <div class="flex gap-3">
            <button class="bg-green-500 text-white px-4 py-2 rounded">
                Simpan
            </button>

            <a href="{{ route('penerima.profile') }}"
               class="bg-gray-400 text-white px-4 py-2 rounded">
               Batal
            </a>
        </div>

    </form>
</div>
@endsection

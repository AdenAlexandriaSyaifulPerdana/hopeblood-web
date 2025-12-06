@extends('pendonor.layout')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">

    <h2 class="text-xl font-bold mb-5">Edit Profil Pendonor</h2>

    {{-- ✅ PESAN ERROR VALIDASI --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ✅ PESAN WARNING (TIDAK ADA PERUBAHAN) --}}
    @if(session('warning'))
        <div class="bg-yellow-100 text-yellow-800 p-3 mb-4 rounded">
            {{ session('warning') }}
        </div>
    @endif

    {{-- ✅ PESAN SUKSES --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pendonor.profile.update') }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- NAMA --}}
        <div>
            <label class="block text-sm mb-1 font-medium">Nama Lengkap</label>
            <input type="text" name="name"
                value="{{ old('name', $user->name) }}"
                class="w-full border p-2 rounded" required>
        </div>

        {{-- USIA --}}
        <div>
            <label class="block text-sm mb-1 font-medium">Usia</label>
            <input type="number" name="usia"
                value="{{ old('usia', $user->usia) }}"
                class="w-full border p-2 rounded" required>
        </div>

        {{-- ALAMAT --}}
        <div>
            <label class="block text-sm mb-1 font-medium">Alamat</label>
            <textarea name="alamat"
                class="w-full border p-2 rounded"
                rows="3"
                required>{{ old('alamat', $user->alamat) }}</textarea>
        </div>

        {{-- ✅ (OPSIONAL) GOLONGAN DARAH – SIAP PAKAI --}}
        <div>
            <label class="block text-sm mb-1 font-medium">Golongan Darah</label>
            <select name="golongan_darah" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih --</option>
                <option value="A"  {{ old('golongan_darah', $user->golongan_darah) == 'A' ? 'selected' : '' }}>A</option>
                <option value="B"  {{ old('golongan_darah', $user->golongan_darah) == 'B' ? 'selected' : '' }}>B</option>
                <option value="AB" {{ old('golongan_darah', $user->golongan_darah) == 'AB' ? 'selected' : '' }}>AB</option>
                <option value="O"  {{ old('golongan_darah', $user->golongan_darah) == 'O' ? 'selected' : '' }}>O</option>
            </select>
        </div>

        {{-- TOMBOL --}}
        <div class="flex justify-between mt-6">
            <a href="{{ route('pendonor.profile') }}"
               class="bg-gray-400 text-white px-4 py-2 rounded">
               Kembali
            </a>

            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Simpan Perubahan
            </button>
        </div>

    </form>

</div>
@endsection

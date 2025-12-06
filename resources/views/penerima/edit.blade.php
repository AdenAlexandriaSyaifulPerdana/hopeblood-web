@extends('admin.layout')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">

    <h2 class="text-xl font-bold mb-5">Edit Profil Penerima</h2>

    {{-- Pesan Error --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- Pesan Warning --}}
    @if(session('warning'))
        <div class="bg-yellow-100 text-yellow-800 p-3 mb-4 rounded">
            {{ session('warning') }}
        </div>
    @endif

    {{-- Pesan Sukses --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif


    <form action="{{ route('penerima.profile.update') }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div>
            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
            <input type="text" name="name"
                   value="{{ old('name', $user->name) }}"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        {{-- Usia --}}
        <div>
            <label class="block text-sm font-medium mb-1">Usia</label>
            <input type="number" name="usia"
                   value="{{ old('usia', $user->usia) }}"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        {{-- Golongan Darah --}}
        <div>
            <label class="block text-sm font-medium mb-1">Golongan Darah</label>
            <select name="golongan_darah" class="w-full border rounded px-3 py-2" required>
                <option value="A" {{ old('golongan_darah', $user->golongan_darah) == 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ old('golongan_darah', $user->golongan_darah) == 'B' ? 'selected' : '' }}>B</option>
                <option value="AB" {{ old('golongan_darah', $user->golongan_darah) == 'AB' ? 'selected' : '' }}>AB</option>
                <option value="O" {{ old('golongan_darah', $user->golongan_darah) == 'O' ? 'selected' : '' }}>O</option>
            </select>
        </div>

        {{-- Alamat --}}
        <div>
            <label class="block text-sm font-medium mb-1">Alamat</label>
            <textarea name="alamat" rows="3"
                      class="w-full border rounded px-3 py-2"
                      required>{{ old('alamat', $user->alamat) }}</textarea>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between mt-6">
            <a href="{{ route('penerima.profile') }}"
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

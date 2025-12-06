{{-- resources/views/penerima/permohonan-form.blade.php --}}
@extends('penerima.layout')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-3xl shadow-md px-8 py-8 md:px-10 md:py-10">
        <h2 class="text-2xl font-bold text-slate-900 mb-2">
            Form Permohonan Darah
        </h2>
        <p class="text-sm text-slate-500 mb-6">
            Isi data berikut untuk mengajukan permohonan darah.
        </p>

        <form action="{{ route('penerima.permohonan.kirim') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Golongan darah --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Golongan Darah
                </label>
                <select name="golongan_darah" required
                        class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400">
                    <option value="">-- Pilih --</option>
                    <option value="A"  @selected(old('golongan_darah')=='A')>A</option>
                    <option value="B"  @selected(old('golongan_darah')=='B')>B</option>
                    <option value="AB" @selected(old('golongan_darah')=='AB')>AB</option>
                    <option value="O"  @selected(old('golongan_darah')=='O')>O</option>
                </select>
                @error('golongan_darah')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lokasi rumah sakit --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Lokasi Rumah Sakit
                </label>
                <select name="lokasi_rumah_sakit" required
                        class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400">
                    <option value="">-- Pilih Rumah Sakit --</option>
                    @foreach ($hospitals as $h)
                        <option value="{{ $h->id }}" @selected(old('lokasi_rumah_sakit') == $h->id)>
                            {{ $h->nama_rumah_sakit }}
                        </option>
                    @endforeach
                </select>
                @error('lokasi_rumah_sakit')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Keterangan (opsional)
                </label>
                <textarea name="keterangan" rows="4"
                          class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-sky-400 resize-y"
                          placeholder="Misalnya: kebutuhan untuk operasi, jumlah kantong, atau catatan lain.">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol aksi --}}
            <div class="flex flex-wrap items-center gap-3 pt-2">
                <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 rounded-full bg-red-500 text-white text-sm font-semibold shadow-md hover:bg-red-600 transition">
                    Kirim Permohonan
                </button>

                <a href="{{ route('penerima.dashboard') }}"
                   class="text-sm text-sky-600 hover:text-sky-700 font-medium">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

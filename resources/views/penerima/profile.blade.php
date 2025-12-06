{{-- resources/views/penerima/profile.blade.php --}}
@extends('penerima.layout')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-3xl shadow-md px-8 py-8 md:px-10 md:py-10">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Profil Penerima</h1>
                <p class="text-sm text-slate-500 mt-1">
                    Data akun yang digunakan untuk permohonan darah.
                </p>
            </div>
        </div>

        {{-- Notifikasi sukses --}}
        @if(session('success'))
            <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400 mb-1">Nama</p>
                <p class="text-base font-semibold text-slate-900">
                    {{ $user->name }}
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400 mb-1">Usia</p>
                    <p class="text-base text-slate-800">
                        {{ $user->usia ?? '-' }}
                    </p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400 mb-1">Golongan Darah</p>
                    <p class="text-base font-semibold text-red-500">
                        {{ $user->golongan_darah ?? '-' }}
                    </p>
                </div>
            </div>

            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400 mb-1">Alamat</p>
                <p class="text-base text-slate-800">
                    {{ $user->alamat ?? '-' }}
                </p>
            </div>
        </div>

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('penerima.profile.edit') }}"
               class="inline-flex items-center px-5 py-2.5 rounded-full bg-sky-600 text-white text-sm font-semibold shadow-md hover:bg-sky-700 transition">
                Edit Profil
            </a>

            <a href="{{ route('penerima.dashboard') }}"
               class="inline-flex items-center px-5 py-2.5 rounded-full border border-slate-300 text-slate-700 text-sm font-semibold hover:bg-slate-50 transition">
                ← Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection

@extends('admin.layout')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow-md rounded-3xl p-6 md:p-8">
    <h2 class="text-2xl font-bold text-slate-900 mb-2">Tambah Penerima</h2>
    <p class="text-sm text-slate-500 mb-6">
        Lengkapi data penerima baru.
    </p>

    <form action="{{ route('admin.penerima.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block mb-1 text-sm font-semibold text-slate-700">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400"
                   required>
        </div>

        <div>
            <label class="block mb-1 text-sm font-semibold text-slate-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400"
                   required>
        </div>

        <div>
            <label class="block mb-1 text-sm font-semibold text-slate-700">Password</label>
            <input type="password" name="password"
                   class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400"
                   required>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 text-sm font-semibold text-slate-700">Usia</label>
                <input type="number" name="usia" value="{{ old('usia') }}"
                       class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400"
                       required>
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold text-slate-700">Golongan Darah</label>
                <input type="text" name="golongan_darah" value="{{ old('golongan_darah') }}"
                       class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400"
                       required>
            </div>
        </div>

        <div>
            <label class="block mb-1 text-sm font-semibold text-slate-700">Alamat</label>
            <textarea name="alamat" rows="3"
                      class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400"
                      required>{{ old('alamat') }}</textarea>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button
                class="bg-red-600 text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-red-700 transition">
                Simpan
            </button>
            <a href="{{ route('admin.penerima.index') }}"
               class="text-sm text-slate-500 hover:text-slate-700">
                Batal dan kembali
            </a>
        </div>
    </form>
</div>
@endsection

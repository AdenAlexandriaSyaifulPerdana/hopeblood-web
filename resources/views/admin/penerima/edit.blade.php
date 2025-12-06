@extends('admin.layout')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow-md rounded-3xl p-6 md:p-8">
    <h2 class="text-2xl font-bold text-slate-900 mb-2">Edit Penerima</h2>
    <p class="text-sm text-slate-500 mb-6">
        Admin hanya dapat mengubah nama dan email penerima.
    </p>

    <form action="{{ route('admin.penerima.update', $penerima->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 text-sm font-semibold text-slate-700">Nama</label>
            <input type="text" name="name"
                   value="{{ old('name', $penerima->name) }}"
                   class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400"
                   required>
        </div>

        <div>
            <label class="block mb-1 text-sm font-semibold text-slate-700">Email</label>
            <input type="email" name="email"
                   value="{{ old('email', $penerima->email) }}"
                   class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400"
                   required>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button
                class="bg-amber-500 text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-amber-600 transition">
                Update
            </button>
            <a href="{{ route('admin.penerima.index') }}"
               class="text-sm text-slate-500 hover:text-slate-700">
                Kembali ke daftar
            </a>
        </div>
    </form>
</div>
@endsection

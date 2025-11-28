@extends('admin.layout')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-6 max-w-xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Edit Pendonor</h2>

    <form action="{{ route('admin.pendonor.update', $pendonor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2 font-semibold">Nama</label>
        <input type="text" name="name"
               value="{{ $pendonor->name }}"
               class="w-full border rounded-lg px-4 py-2 mb-4"
               required>

        <label class="block mb-2 font-semibold">Email</label>
        <input type="email" name="email"
               value="{{ $pendonor->email }}"
               class="w-full border rounded-lg px-4 py-2 mb-4"
               required>

        <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">
            Update
        </button>
    </form>

</div>
@endsection

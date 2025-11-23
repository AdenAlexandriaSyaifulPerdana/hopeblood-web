@extends('admin.layout')

@section('content')
<h2>Edit Pendonor</h2>

<form action="{{ route('admin.pendonor.update', $pendonor->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama</label>
    <input type="text" name="name" class="form-control" value="{{ $pendonor->name }}">

    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ $pendonor->email }}">

    <button class="btn btn-primary mt-3">Update</button>
</form>
@endsection

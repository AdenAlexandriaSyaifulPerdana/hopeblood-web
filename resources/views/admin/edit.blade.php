<h2>Edit Data User</h2>

<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama:</label>
    <input type="text" name="name" value="{{ $user->name }}" required><br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ $user->email }}" required><br>

    <label>Role:</label>
    <select name="role" required>
        <option value="pendonor" {{ $user->role == 'pendonor' ? 'selected' : '' }}>Pendonor</option>
        <option value="penerima" {{ $user->role == 'penerima' ? 'selected' : '' }}>Penerima</option>
    </select><br>

    <button type="submit">Update</button>
</form>

<h2>Tambah User Baru</h2>

<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    <label>Nama:</label>
    <input type="text" name="name" required><br>

    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <label>Role:</label>
    <select name="role" required>
        <option value="pendonor">Pendonor</option>
        <option value="penerima">Penerima</option>
    </select><br>

    <button type="submit">Simpan</button>
</form>

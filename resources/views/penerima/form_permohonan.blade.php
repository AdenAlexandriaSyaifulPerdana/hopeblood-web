<h2>Form Permohonan Darah</h2>

<form action="{{ route('penerima.permohonan.kirim') }}" method="POST">
    @csrf

    <label>Golongan Darah:</label><br>
    <select name="golongan_darah" required>
        <option value="">-- Pilih --</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="AB">AB</option>
        <option value="O">O</option>
    </select>

    <br><br>

    <label>Lokasi Rumah Sakit:</label><br>
    <select name="lokasi_rumah_sakit" required>
        <option value="">-- Pilih Rumah Sakit --</option>
        @foreach($hospitals as $h)
            <option value="{{ $h->nama_rumah_sakit }}">
                {{ $h->nama_rumah_sakit }} — {{ $h->alamat }}
            </option>
        @endforeach
    </select>
    <br><br>


    <br><br>

    <label>Keterangan (opsional):</label><br>
    <textarea name="keterangan"></textarea>

    <br><br>

    <button type="submit">Kirim Permohonan</button>
</form>

<br>

<a href="{{ route('penerima.dashboard') }}">← Kembali ke Dashboard</a>

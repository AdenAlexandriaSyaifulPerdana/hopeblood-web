<h2>Permintaan Darah Sesuai Golongan Anda</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8">
    <tr>
        <th>Penerima</th>
        <th>Golongan</th>
        <th>Rumah Sakit</th>
        <th>Keterangan</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $d)
    <tr>
        <td>{{ $d->id_penerima }}</td>
        <td>{{ $d->golongan_darah }}</td>
        <td>{{ $d->lokasi_rumah_sakit }}</td>
        <td>{{ $d->keterangan }}</td>
        <td>
            <form action="{{ route('pendonor.konfirmasi') }}" method="POST">
                @csrf
                <input type="hidden" name="id_permohonan" value="{{ $d->id }}">
                <input type="text" name="lokasi_donor" placeholder="Lokasi Donor" required>
                <input type="datetime-local" name="waktu_donor" required>
                <button type="submit">Saya Bersedia Donor</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@if(session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

<a href="{{ route('pendonor.dashboard') }}">Kembali</a>

<!-- Modal Notifikasi -->
<!-- Modal Custom -->
<div id="successModal"
    style="
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        justify-content: center;
        align-items: center;
    ">
    
    <div style="
        background: white;
        padding: 20px 25px;
        border-radius: 10px;
        width: 350px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        animation: fadeIn 0.3s ease;
    ">
        <h3 style="margin-bottom: 10px; color: green;">Berhasil</h3>
        <p>{{ session('success') }}</p>

        <button onclick="closeModal()"
            style="
                margin-top: 15px;
                padding: 8px 15px;
                border: none;
                background: green;
                color: white;
                border-radius: 6px;
                cursor: pointer;
            ">
            OK
        </button>
    </div>
</div>


@if(session('success'))
<script>
    document.getElementById('successModal').style.display = 'flex';

    function closeModal() {
        document.getElementById('successModal').style.display = 'none';
    }
</script>
@endif

<style>
@keyframes fadeIn {
    from { transform: scale(0.9); opacity: 0; }
    to   { transform: scale(1); opacity: 1; }
}
</style>
<h2>Permintaan Darah Sesuai Golongan Anda</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8">
    <tr>
        <th>Golongan</th>
        <th>Rumah Sakit</th>
        <th>Keterangan</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $d)
    <tr>
        <td>{{ $d->golongan_darah }}</td>
        <td>{{ $d->lokasi_rumah_sakit }}</td>
        <td>{{ $d->keterangan }}</td>
        <td>
            <form action="{{ route('pendonor.konfirmasi') }}" method="POST" class="permohonan-form">
                @csrf
                <input type="hidden" name="id_permohonan" value="{{ $d->id }}">

                <label>Lokasi Donor</label><br>
                <select name="lokasi_donor" id="lokasi_select_{{ $d->id }}" required>
                    <option value="">-- Pilih Lokasi Donor --</option>

                    @foreach ($hospitals as $rs)
                        @php
                            $jam = explode('-', $rs->jam_operasional);
                            $open = trim($jam[0] ?? '');
                            $close = trim($jam[1] ?? '');
                            $openHtml = str_replace('.', ':', $open);    // 08.00 -> 08:00
                            $closeHtml = str_replace('.', ':', $close);
                        @endphp

                        <option value="{{ $rs->id }}"
                                data-open="{{ $openHtml }}"
                                data-close="{{ $closeHtml }}">
                            {{ $rs->nama_rumah_sakit }} ({{ $rs->jam_operasional }})
                        </option>
                    @endforeach
                </select>

                <div style="margin-top:6px;">
                    <label>Tanggal Donor</label><br>
                    <input type="date" name="tanggal_donor" id="tanggal_{{ $d->id }}" required>
                </div>

                <div style="margin-top:6px;">
                    <label>Waktu Donor</label><br>
                    <input type="time" name="waktu_donor" id="waktu_{{ $d->id }}" required>
                    <div id="waktu_error_{{ $d->id }}" style="color:#b91c1c; font-size:.9rem; display:none;"></div>
                    <button type="button" id="set_open_{{ $d->id }}" style="display:none; margin-top:6px;">Set ke jam buka</button>
                </div>

                <div style="margin-top:8px;">
                    <button type="submit">Saya Bersedia Donor</button>
                </div>

                {{-- menampilkan pesan server-side --}}
                @if(session('error'))
                    <p style="color:red; margin-top:6px;">{{ session('error') }}</p>
                @endif
                @if ($errors->any())
                    <div style="color:red; margin-top:6px;">
                        <ul style="margin:0; padding-left:18px;">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>


        </td>
    </tr>
    @endforeach
</table>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // set tanggal minimal hari ini (global)
    const today = new Date().toISOString().split('T')[0];

    // cari semua form permohonan (loop berdasarkan id pattern)
    document.querySelectorAll('form.permohonan-form').forEach(function(form) {
        const hiddenId = form.querySelector('input[name="id_permohonan"]').value;
        const lokasiSelect = form.querySelector('select[name="lokasi_donor"]');
        const tanggalInput   = form.querySelector('input[name="tanggal_donor"]');
        const waktuInput     = form.querySelector('input[name="waktu_donor"]');
        const errDiv         = form.querySelector('[id^="waktu_error_"]');
        const setOpenBtn     = form.querySelector('[id^="set_open_"]');

        // set minimal tanggal = hari ini
        if (tanggalInput) tanggalInput.setAttribute('min', today);

        function hideError() {
            if (!errDiv) return;
            errDiv.style.display = 'none';
            errDiv.textContent = '';
        }

        function showError(text) {
            if (!errDiv) return;
            errDiv.textContent = text;
            errDiv.style.display = 'block';
        }

        // ketika ganti lokasi => set time.min/time.max dan tampilkan tombol set ke jam buka
        lokasiSelect.addEventListener('change', function() {
            hideError();
            if (!this.value) {
                waktuInput.removeAttribute('min');
                waktuInput.removeAttribute('max');
                if (setOpenBtn) setOpenBtn.style.display = 'none';
                return;
            }

            const opt = this.selectedOptions[0];
            const open = opt.dataset.open;   // "08:00"
            const close = opt.dataset.close; // "20:00"

            if (open) waktuInput.setAttribute('min', open);
            if (close) waktuInput.setAttribute('max', close);

            // tampilkan tombol auto-set ke jam buka
            if (setOpenBtn) {
                setOpenBtn.style.display = 'inline-block';
                setOpenBtn.onclick = function() {
                    waktuInput.value = open || '';
                    hideError();
                };
            }

            // jika user sudah isi waktu dan di luar rentang -> adjust ke nearest bound (UX-friendly)
            if (waktuInput.value) {
                const val = waktuInput.value;
                if (open && val < open) {
                    waktuInput.value = open;
                    showError(`Waktu disesuaikan ke jam buka ${open}`);
                    setTimeout(hideError, 3000);
                } else if (close && val > close) {
                    waktuInput.value = close;
                    showError(`Waktu disesuaikan ke jam tutup ${close}`);
                    setTimeout(hideError, 3000);
                }
            }
        });

        // ketika user input waktu -> validasi tanpa alert
        waktuInput.addEventListener('input', function () {
            hideError();
            const min = this.getAttribute('min');
            const max = this.getAttribute('max');

            if (!min && !max) return; // belum pilih lokasi

            if ((min && this.value < min) || (max && this.value > max)) {
                showError(`Waktu harus antara ${min || '00:00'} — ${max || '23:59'}.`);
            } else {
                hideError();
            }
        });

        // optional: saat submit, double-check waktu client-side supaya user cepat tau
        form.addEventListener('submit', function (ev) {
            const min = waktuInput.getAttribute('min');
            const max = waktuInput.getAttribute('max');
            if ((min && waktuInput.value < min) || (max && waktuInput.value > max)) {
                ev.preventDefault();
                showError(`Waktu harus antara ${min || '00:00'} — ${max || '23:59'}. Silakan perbaiki atau klik "Set ke jam buka".`);
                return false;
            }
            // else submit (server-side akan tetap memvalidasi)
        });
    });
});
</script>


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

<style>

/* ===== GLOBAL ===== */
body {
    font-family: "Inter", Arial, sans-serif;
    background: #f3f4f6;
    color: #1f2937;
}

/* ===== TABLE ===== */
table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-top: 20px;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
}

th {
    background: #dc2626;
    color: white;
    padding: 14px;
    text-align: left;
    font-size: 15px;
    letter-spacing: 0.3px;
}

td {
    padding: 14px;
    border-bottom: 1px solid #e5e7eb;
}

tr:last-child td {
    border-bottom: none;
}

tr:hover td {
    background: #f9fafb;
    transition: 0.2s;
}

/* ===== FORM CARD ===== */
.permohonan-form {
    margin-top: 10px;
    background: #ffffff;
    padding: 16px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

/* ===== LABEL ===== */
.permohonan-form label {
    font-size: 14px;
    font-weight: 600;
    color: #374151;
}

/* ===== INPUT + SELECT ===== */
.permohonan-form select,
.permohonan-form input[type="date"],
.permohonan-form input[type="time"] {
    width: 100%;
    margin-top: 6px;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    background: #f9fafb;
    transition: 0.2s;
}

.permohonan-form select:focus,
.permohonan-form input[type="date"]:focus,
.permohonan-form input[type="time"]:focus {
    border-color: #dc2626;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(220,38,38,0.2);
}

/* ===== SUBMIT BUTTON ===== */
.permohonan-form button[type="submit"] {
    width: 100%;
    background: #dc2626;
    padding: 10px 14px;
    color: white;
    border-radius: 8px;
    border: none;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 12px;
    transition: 0.25s;
    box-shadow: 0 2px 6px rgba(220,38,38,0.3);
}

.permohonan-form button[type="submit"]:hover {
    background: #b91c1c;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(220,38,38,0.4);
}

/* ===== TOMBOL SET JAM BUKA ===== */
button[id^="set_open_"] {
    background: #2563eb;
    padding: 8px 12px;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    cursor: pointer;
    margin-top: 10px;
    transition: 0.2s;
}

button[id^="set_open_"]:hover {
    background: #1d4ed8;
}

/* ===== ERROR TEXT ===== */
[id^="waktu_error_"] {
    margin-top: 6px;
    padding: 6px 8px;
    background: #fee2e2;
    color: #b91c1c;
    border: 1px solid #fecaca;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
}

/* ===== MODAL ===== */
#successModal {
    backdrop-filter: blur(4px);
}

#successModal > div {
    border-radius: 14px !important;
    padding: 25px !important;
    animation: fadeUp 0.3s ease;
}

#successModal button {
    width: 100%;
    padding: 10px 12px !important;
    border-radius: 8px !important;
}

/* ===== ANIMATION ===== */
@keyframes fadeUp {
    from {
        transform: translateY(30px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

</style>

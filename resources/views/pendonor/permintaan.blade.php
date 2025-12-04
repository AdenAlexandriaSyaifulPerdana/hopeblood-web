@extends('pendonor.layout')

@section('content')

<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Permintaan Darah Sesuai Golongan Anda</h2>
</div>

{{-- SUCCESS ALERT --}}
@if(session('success'))
<div class="mb-4 rounded-xl bg-green-50 border border-green-200 p-4 text-green-700">
    {{ session('success') }}
</div>
@endif

{{-- TABLE --}}
<div class="bg-white rounded-xl shadow-md overflow-hidden p-4">
    <table id="tabelPermintaan" class="min-w-full text-sm">
        <thead class="bg-red-600 text-white">
            <tr>
                <th class="py-3 px-4 text-left">Golongan</th>
                <th class="py-3 px-4 text-left">Rumah Sakit</th>
                <th class="py-3 px-4 text-left">Keterangan</th>
                <th class="py-3 px-4 text-left">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $d)
            <tr class="border-b hover:bg-slate-50">
                <td class="py-3 px-4">{{ $d->golongan_darah }}</td>
                <td class="py-3 px-4">{{ $d->lokasi_rumah_sakit }}</td>
                <td class="py-3 px-4">{{ $d->keterangan }}</td>

                <td class="py-3 px-4">
                    {{-- FORM CARD --}}
                    <form action="{{ route('pendonor.konfirmasi') }}" method="POST"
                        class="permohonan-form bg-white border p-4 rounded-xl shadow-sm space-y-3">
                        @csrf

                        <input type="hidden" name="id_permohonan" value="{{ $d->id }}">

                        {{-- LOKASI --}}
                        <div>
                            <label class="font-semibold">Lokasi Donor</label>
                            <select name="lokasi_donor" id="lokasi_{{ $d->id }}" required>
                                <option value="">-- Pilih Lokasi Donor --</option>

                                @foreach ($hospitals as $rs)
                                    @php
                                        $jam = explode('-', $rs->jam_operasional);
                                        $open = str_replace('.', ':', trim($jam[0] ?? ''));
                                        $close = str_replace('.', ':', trim($jam[1] ?? ''));
                                    @endphp

                                    <option value="{{ $rs->id }}"
                                        data-open="{{ $open }}"
                                        data-close="{{ $close }}">
                                        {{ $rs->nama_rumah_sakit }} ({{ $rs->jam_operasional }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- TANGGAL --}}
                        <div>
                            <label class="font-semibold">Tanggal Donor</label>
                            <input type="date" name="tanggal_donor" id="tanggal_{{ $d->id }}" required>
                        </div>

                        {{-- WAKTU --}}
                        <div>
                            <label class="font-semibold">Waktu Donor</label>
                            <input type="time" name="waktu_donor" id="waktu_{{ $d->id }}" required>
                            <div id="err_{{ $d->id }}" class="hidden mt-2 rounded-lg border border-red-200 bg-red-50 text-red-600 text-xs p-2"></div>
                            <button type="button" id="btn_open_{{ $d->id }}" class="hidden mt-2 bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded-lg">
                                Set ke Jam Buka
                            </button>
                        </div>

                        <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded-lg shadow-md">
                            Saya Bersedia Donor
                        </button>

                        {{-- server errors --}}
                        @if ($errors->any())
                            <ul class="text-red-600 text-sm mt-2 list-disc pl-5">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- BACK --}}
<div class="mt-6">
    <a href="{{ route('pendonor.dashboard') }}"
        class="inline-block px-4 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-800">
        Kembali
    </a>
</div>

{{-- SUCCESS MODAL --}}
@if(session('success'))
<div id="successModal"
    class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center">
    <div class="bg-white p-6 rounded-2xl w-80 shadow-lg animate-fadeUp text-center">
        <h3 class="text-green-600 font-bold text-lg mb-2">Berhasil</h3>
        <p>{{ session('success') }}</p>

        <button onclick="document.getElementById('successModal').remove()"
            class="w-full mt-4 bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg">
            OK
        </button>
    </div>
</div>
@endif


{{-- SCRIPT VALIDASI --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const today = new Date().toISOString().split('T')[0];

    document.querySelectorAll('.permohonan-form').forEach(form => {
        const id = form.querySelector('input[name="id_permohonan"]').value;
        const lokasi = form.querySelector(`#lokasi_${id}`);
        const tanggal = form.querySelector(`#tanggal_${id}`);
        const waktu   = form.querySelector(`#waktu_${id}`);
        const err     = form.querySelector(`#err_${id}`);
        const btnOpen = form.querySelector(`#btn_open_${id}`);

        tanggal.min = today;

        const hideError = () => {
            err.classList.add('hidden');
            err.textContent = '';
        };

        const showError = (msg) => {
            err.textContent = msg;
            err.classList.remove('hidden');
        };

        lokasi.addEventListener('change', () => {
            hideError();

            if (!lokasi.value) {
                waktu.removeAttribute('min');
                waktu.removeAttribute('max');
                btnOpen.classList.add('hidden');
                return;
            }

            let open = lokasi.selectedOptions[0].dataset.open;
            let close = lokasi.selectedOptions[0].dataset.close;

            waktu.min = open;
            waktu.max = close;

            btnOpen.classList.remove('hidden');
            btnOpen.onclick = () => {
                waktu.value = open;
                hideError();
            };
        });

        waktu.addEventListener('input', () => {
            hideError();
            let min = waktu.min;
            let max = waktu.max;

            if ((min && waktu.value < min) || (max && waktu.value > max)) {
                showError(`Waktu harus antara ${min} — ${max}.`);
            }
        });
    });
});
</script>


{{-- TABLE JAVASCRIPT (tanpa jQuery, simple + rapi) --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    const table = document.querySelector("#tabelPermintaan");
    const rows = Array.from(table.querySelectorAll("tbody tr"));
    const searchBar = document.createElement("input");

    searchBar.placeholder = "Cari permintaan...";
    searchBar.className =
        "mb-3 w-full p-2 border rounded-lg shadow-sm focus:ring-red-400 focus:border-red-400";

    table.parentElement.prepend(searchBar);

    searchBar.addEventListener("keyup", () => {
        let q = searchBar.value.toLowerCase();

        rows.forEach(r => {
            r.style.display = r.innerText.toLowerCase().includes(q) ? "" : "none";
        });
    });
});
</script>

{{-- ANIMATION --}}
<style>
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
.animate-fadeUp { animation: fadeUp .35s ease; }
</style>

@endsection

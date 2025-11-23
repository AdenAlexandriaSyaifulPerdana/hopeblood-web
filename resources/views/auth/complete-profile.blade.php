@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-red-50">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg border-t-4 border-red-600">

        <h2 class="text-2xl font-bold text-center text-red-700 mb-6">
            Lengkapi Data Diri Anda
        </h2>

        <form method="POST" action="{{ route('complete.profile') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Usia</label>
                <input type="number" id="usia" name="usia" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Alamat</label>
                <textarea id="alamat" name="alamat" class="w-full px-4 py-2 border rounded-lg"></textarea>
            </div>

            <div class="mb-6">
                <label class="block mb-1 font-semibold">Golongan Darah</label>
                <select id="golongan_darah" name="golongan_darah" class="w-full px-4 py-2 border rounded-lg">
                    <option>A</option>
                    <option>B</option>
                    <option>O</option>
                    <option>AB</option>
                </select>
            </div>

            <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-bold">
                Simpan
            </button>
        </form>

        <script>
        document.addEventListener("DOMContentLoaded", () => {

            const nama = document.getElementById("nama_lengkap");
            nama.addEventListener("input", () => {
                validate(nama, /^[a-zA-Z\s]+$/, "Nama hanya boleh huruf & spasi");
            });

            const usia = document.getElementById("usia");
            usia.addEventListener("input", () => {
                validate(usia, /^(1[7-9]|[2-6][0-9]|70)$/, "Usia minimal 17 dan maksimal 70");
            });

            const alamat = document.getElementById("alamat");
            alamat.addEventListener("input", () => {
                validate(alamat, /^[a-zA-Z0-9\s\.,-]+$/, "Alamat hanya boleh huruf, angka, titik, koma, dan -");
            });

            const goldar = document.getElementById("golongan_darah");
            goldar.addEventListener("change", () => {
                if (!["A","B","O","AB"].includes(goldar.value)) {
                    showError(goldar, "Pilih golongan darah valid");
                } else {
                    removeError(goldar);
                }
            });

            // --- HELPER ---
            function validate(input, regex, message) {
                if (!regex.test(input.value)) {
                    showError(input, message);
                } else {
                    removeError(input);
                }
            }

            function showError(input, message) {
                input.classList.add("input-error");

                let err = input.parentNode.querySelector(".error-text");
                if (!err) {
                    err = document.createElement("p");
                    err.classList.add("error-text");
                    input.parentNode.appendChild(err);
                }
                err.textContent = message;
            }

            function removeError(input) {
                input.classList.remove("input-error");
                const err = input.parentNode.querySelector(".error-text");
                if (err) err.remove();
            }

        });
        </script>


    </div>
</div>
@endsection

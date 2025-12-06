<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Profil | HopeBlood</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center px-4">

<div class="max-w-xl w-full bg-white rounded-3xl shadow-2xl border-t-4 border-red-600 p-8 md:p-10">
    <div class="mb-6 text-center">
        <h1 class="text-2xl md:text-3xl font-bold text-red-700">
            Lengkapi Data Diri Anda
        </h1>
        <p class="text-sm text-slate-500 mt-2">
            Data ini akan digunakan untuk proses permohonan dan pendataan donor darah.
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-2xl bg-rose-50 border border-rose-200 px-4 py-3 text-sm text-rose-700">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('complete.profile') }}" class="space-y-5">
        @csrf

        <div>
            <label for="nama_lengkap" class="block mb-1 text-sm font-semibold text-slate-700">
                Nama Lengkap
            </label>
            <input type="text" id="nama_lengkap" name="nama_lengkap"
                   value="{{ old('nama_lengkap') }}"
                   class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm
                          focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400">
        </div>

        <div>
            <label for="usia" class="block mb-1 text-sm font-semibold text-slate-700">
                Usia
            </label>
            <input type="number" id="usia" name="usia"
                   value="{{ old('usia') }}"
                   class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm
                          focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400">
        </div>

        <div>
            <label for="alamat" class="block mb-1 text-sm font-semibold text-slate-700">
                Alamat
            </label>
            <textarea id="alamat" name="alamat" rows="3"
                      class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm
                             focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400">{{ old('alamat') }}</textarea>
        </div>

        <div>
            <label for="golongan_darah" class="block mb-1 text-sm font-semibold text-slate-700">
                Golongan Darah
            </label>
            <select id="golongan_darah" name="golongan_darah"
                    class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm
                           focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400">
                <option value="">-- Pilih golongan darah --</option>
                <option value="A"  @selected(old('golongan_darah')=='A')>A</option>
                <option value="B"  @selected(old('golongan_darah')=='B')>B</option>
                <option value="O"  @selected(old('golongan_darah')=='O')>O</option>
                <option value="AB" @selected(old('golongan_darah')=='AB')>AB</option>
            </select>
        </div>

        <button
            class="w-full bg-red-600 hover:bg-red-700 text-white py-2.5 rounded-full text-sm font-semibold shadow-md transition">
            Simpan
        </button>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const nama   = document.getElementById("nama_lengkap");
    const usia   = document.getElementById("usia");
    const alamat = document.getElementById("alamat");
    const goldar = document.getElementById("golongan_darah");

    if (nama) {
        nama.addEventListener("input", () => {
            validate(nama, /^[a-zA-Z\s]+$/, "Nama hanya boleh huruf & spasi");
        });
    }

    if (usia) {
        usia.addEventListener("input", () => {
            validate(usia, /^(1[7-9]|[2-6][0-9]|70)$/, "Usia minimal 17 dan maksimal 70");
        });
    }

    if (alamat) {
        alamat.addEventListener("input", () => {
            validate(alamat, /^[a-zA-Z0-9\s\.,-]+$/, "Alamat hanya boleh huruf, angka, titik, koma, dan -");
        });
    }

    if (goldar) {
        goldar.addEventListener("change", () => {
            if (!["A","B","O","AB"].includes(goldar.value)) {
                showError(goldar, "Pilih golongan darah valid");
            } else {
                removeError(goldar);
            }
        });
    }

    function validate(input, regex, message) {
        if (input.value && !regex.test(input.value)) {
            showError(input, message);
        } else {
            removeError(input);
        }
    }

    function showError(input, message) {
        input.classList.add("border-rose-400", "focus:ring-rose-400");
        let err = input.parentNode.querySelector(".error-text");
        if (!err) {
            err = document.createElement("p");
            err.classList.add("error-text", "mt-1", "text-xs", "text-rose-600");
            input.parentNode.appendChild(err);
        }
        err.textContent = message;
    }

    function removeError(input) {
        input.classList.remove("border-rose-400", "focus:ring-rose-400");
        const err = input.parentNode.querySelector(".error-text");
        if (err) err.remove();
    }
});
</script>

</body>
</html>

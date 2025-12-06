<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | HopeBlood</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center px-4">

<div class="bg-white shadow-2xl rounded-3xl flex max-w-5xl w-full overflow-hidden">

    {{-- LEFT: HERO --}}
    <div class="hidden md:flex w-1/2 bg-gradient-to-br from-red-600 via-red-500 to-rose-500 flex-col justify-center items-center text-white p-10">
        <h1 class="text-3xl font-extrabold tracking-tight mb-2">HopeBlood</h1>
        <p class="text-xs uppercase tracking-[0.25em] text-red-100 mb-6">
            donate blood, save lives
        </p>

        <img src="https://cdn-icons-png.flaticon.com/512/2965/2965879.png"
             class="w-32 mb-5 drop-shadow-lg" alt="Blood Icon">

        <h2 class="text-2xl font-bold mb-2">Ayo Jadi Pahlawan!</h2>
        <p class="text-center text-sm text-red-50 max-w-sm">
            Daftar sebagai pendonor atau penerima. Setetes darahmu dapat menyelamatkan mereka yang membutuhkan.
        </p>
    </div>

    {{-- RIGHT: FORM --}}
    <div class="w-full md:w-1/2 p-8 md:p-10">
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-slate-900">
                Buat Akun Donor Darah
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Isi data berikut untuk mulai menggunakan HopeBlood.
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-700 p-3 rounded-2xl mb-4 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="text-sm font-semibold text-slate-700">Nama</label>
                <input type="Nama" id="name" name="name" required
                       value="{{ old('name') }}"
                       class="w-full border border-slate-200 rounded-xl px-4 py-2.5 mt-1 text-sm
                              focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400">
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Email</label>
                <input type="email" id="email" name="email" required
                       value="{{ old('email') }}"
                       class="w-full border border-slate-200 rounded-xl px-4 py-2.5 mt-1 text-sm
                              focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400">
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Sebagai</label>
                <select name="role" id="role" required
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 mt-1 text-sm
                               focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400">
                    <option value="">-- Pendonor / Penerima --</option>
                    <option value="pendonor" @selected(old('role')=='pendonor')>Pendonor</option>
                    <option value="penerima" @selected(old('role')=='penerima')>Penerima</option>
                </select>
            </div>

            <div class="relative">
                <label class="block mb-1 text-sm font-semibold text-slate-700">Password</label>
                <input type="password" id="password" name="password"
                       class="w-full px-4 py-2.5 border border-slate-200 rounded-xl pr-16 text-sm
                              focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400">
                <button type="button" onclick="togglePassword('password', 'toggleIcon1')"
                        class="absolute right-3 top-8 text-xs font-semibold text-slate-500">
                    <span id="toggleIcon1">Show</span>
                </button>
            </div>

            <div class="relative">
                <label class="block mb-1 text-sm font-semibold text-slate-700">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="w-full px-4 py-2.5 border border-slate-200 rounded-xl pr-16 text-sm
                              focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400">
                <button type="button" onclick="togglePassword('password_confirmation', 'toggleIcon2')"
                        class="absolute right-3 top-8 text-xs font-semibold text-slate-500">
                    <span id="toggleIcon2">Show</span>
                </button>
            </div>

            <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white py-2.5 rounded-full text-sm font-semibold mt-2">
                Daftar
            </button>
        </form>


        <p class="text-center mt-6 text-xs text-slate-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-red-600 font-semibold hover:underline">
                Login sekarang
            </a>
        </p>
    </div>
</div>

<script>
function togglePassword(fieldId, iconId) {
    const input = document.getElementById(fieldId);
    const icon  = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        icon.textContent = "Hide";
    } else {
        input.type = "password";
        icon.textContent = "Show";
    }
}
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Donor Darah | HopeBlood</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center px-4">

<div class="max-w-5xl w-full bg-white shadow-2xl rounded-3xl overflow-hidden flex flex-col md:flex-row">

    {{-- LEFT: HERO / BRAND --}}
    <div class="md:w-1/2 bg-gradient-to-br from-red-600 via-red-500 to-rose-500 text-white p-10 flex flex-col justify-between">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight mb-2">
                HopeBlood
            </h1>
            <p class="text-xs uppercase tracking-[0.25em] text-red-100 mb-6">
                donate blood, save lives
            </p>

            <div class="flex flex-col items-start gap-4">
                <img src="https://cdn-icons-png.flaticon.com/512/2965/2965879.png"
                     class="w-28 md:w-32 drop-shadow-lg" alt="Blood Icon">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold mb-1">
                        Ayo Donor Darah!
                    </h2>
                    <p class="text-sm text-red-50 max-w-xs">
                        Setetes darahmu sangat berarti bagi mereka yang membutuhkan.
                        Kelola jadwal donor dan permohonan darah dalam satu sistem.
                    </p>
                </div>
            </div>
        </div>

        <p class="mt-8 text-[11px] text-red-100">
            HopeBlood. Platform manajemen donor darah.
        </p>
    </div>

    {{-- RIGHT: FORM --}}
    <div class="md:w-1/2 p-8 md:p-10 bg-white">
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-slate-900">
                Masuk ke Akun
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Gunakan email dan password yang sudah terdaftar.
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

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-700">Email</label>
                <input type="email" name="email"
                       class="mt-1 w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400"
                       required autofocus>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">Password</label>
                <div class="relative mt-1">
                    <input type="password" id="login_password" name="password"
                           class="w-full border border-slate-200 rounded-xl px-4 py-2.5 pr-16 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400">
                    <button type="button"
                            onclick="togglePassword('login_password','loginToggle')"
                            class="absolute inset-y-0 right-3 flex items-center text-xs font-semibold text-slate-500">
                        <span id="loginToggle">Show</span>
                    </button>
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white py-2.5 rounded-full text-sm font-semibold shadow-md transition">
                Masuk
            </button>
        </form>


        <p class="text-center mt-6 text-xs text-slate-500">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-red-600 font-semibold hover:underline">
                Daftar sekarang
            </a>
        </p>
    </div>
</div>

<script>
function togglePassword(fieldId, iconId) {
    const input = document.getElementById(fieldId);
    const icon  = document.getElementById(iconId);

    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = 'Hide';
    } else {
        input.type = 'password';
        icon.textContent = 'Show';
    }
}
</script>

</body>
</html>

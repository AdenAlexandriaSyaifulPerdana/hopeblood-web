<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Donor Darah</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center px-4">
    <div class="bg-white shadow-xl rounded-xl flex max-w-4xl w-full overflow-hidden">

        <!-- LEFT SIDE -->
        <div class="hidden md:flex w-1/2 bg-red-500 flex-col justify-center items-center text-white p-10">
            <img src="https://cdn-icons-png.flaticon.com/512/2965/2965879.png"
                 class="w-40 mb-6" alt="Blood Icon">

            <h2 class="text-3xl font-bold mb-2">Ayo Jadi Pahlawan!</h2>
            <p class="text-center opacity-90">
                Daftar sekarang sebagai pendonor atau penerima.
                Setetes darahmu dapat menyelamatkan mereka yang membutuhkan.
            </p>
        </div>

        <!-- RIGHT SIDE (FORM) -->
        <div class="w-full md:w-1/2 p-10">

            <h2 class="text-2xl font-bold text-center text-red-600 mb-6">
                Buat Akun Donor Darah
            </h2>

            {{-- ERROR HANDLER --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- REGISTER FORM --}}
            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="text-sm font-semibold">Nama Lengkap</label>
                    <input type="text" id="name"
                           name="name"
                           required
                           class="w-full border rounded px-3 py-2 mt-1 focus:outline-red-500">
                </div>

                <div>
                    <label class="text-sm font-semibold">Email</label>
                    <input type="email" id="email"
                           name="email"
                           required
                           class="w-full border rounded px-3 py-2 mt-1 focus:outline-red-500">
                </div>

                <div>
                    <label class="text-sm font-semibold">Role</label>
                    <select name="role" id="role"
                            required
                            class="w-full border rounded px-3 py-2 mt-1 focus:outline-red-500">
                        <option value="">-- Pilih role --</option>
                        <option value="pendonor">Pendonor</option>
                        <option value="penerima">Penerima</option>
                    </select>
                </div>

                <div class="mb-4 relative">
                    <label class="block mb-1 font-semibold">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border rounded-lg pr-12">

                    <!-- BUTTON TOGGLE -->
                    <button type="button" onclick="togglePassword('password', 'toggleIcon1')"
                            class="absolute right-3 top-9 text-gray-600">
                        <span id="toggleIcon1">Hide</span>
                    </button>
                </div>

                <div class="mb-4 relative">
                    <label class="block mb-1 font-semibold">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full px-4 py-2 border rounded-lg pr-12">

                    <!-- BUTTON TOGGLE -->
                    <button type="button" onclick="togglePassword('password_confirmation', 'toggleIcon2')"
                            class="absolute right-3 top-9 text-gray-600">
                        <span id="toggleIcon2">Hide</span>
                    </button>
                </div>

                <div>

                <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-semibold">
                    Daftar
                </button>
            </form>

            <a href="{{ route('google.redirect') }}"
            class="block w-full text-center bg-white border border-gray-300 py-2 rounded-lg shadow-sm hover:bg-gray-100 mt-4">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg"
                    class="inline w-5 mr-2">
                Daftar dengan Google
            </a>


            <p class="text-center mt-6 text-sm">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                   class="text-red-600 font-semibold hover:underline">
                    Login sekarang
                </a>
            </p>

        </div>
    </div>
</div>

<script>
function togglePassword(fieldId, iconId) {
    const input = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        icon.textContent = "Hide"; // icon saat terlihat
    } else {
        input.type = "password";
        icon.textContent = "Show"; // icon saat disembunyikan
    }
}
</script>


</body>
</html>

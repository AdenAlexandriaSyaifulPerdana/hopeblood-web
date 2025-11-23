<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Donor Darah</title>

    <!-- TAILWIND CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center px-4">
    <div class="bg-white shadow-xl rounded-xl flex max-w-4xl w-full overflow-hidden">

        <!-- LEFT IMAGE / INFO -->
        <div class="w-1/2 bg-red-500 flex flex-col justify-center items-center p-10 text-white">
            <img src="https://cdn-icons-png.flaticon.com/512/2965/2965879.png"
                 class="w-40 mb-5" alt="Blood Icon">
            <h2 class="text-3xl font-bold mb-2">Ayo Donor Darah!</h2>
            <p class="text-center opacity-80">
                Setetes darahmu sangat berarti bagi mereka yang membutuhkan.
            </p>
        </div>

        <!-- RIGHT FORM -->
        <div class="w-1/2 p-10">
            <h2 class="text-2xl font-bold mb-6 text-center text-red-600">
                Login Akun Donor
            </h2>

            @if ($errors->any())
                <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
                    <ul class="text-sm">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="text-sm font-semibold">Email</label>
                    <input type="email" name="email"
                           class="w-full border rounded px-3 py-2 mt-1 focus:outline-red-500"
                           required>
                </div>

                <div class="mb-4 relative">
                    <label class="block mb-1 font-semibold">Password</label>
                    <input type="password" id="login_password" name="password"
                        class="w-full px-4 py-2 border rounded-lg pr-12">

                    <button type="button" onclick="togglePassword('login_password', 'loginToggle')"
                            class="absolute right-3 top-9 text-gray-600">
                        <span id="loginToggle">Hide</span>
                    </button>
                </div>


                <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-semibold">
                    Sign In
                </button>
            </form>

            <!-- Google Login -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500 mb-3">Atau login dengan</p>

                <a href="{{ route('google.redirect') }}"
                class="w-full flex justify-center items-center border py-2 rounded-lg hover:bg-gray-50">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 mr-2">
                    Google Account
                </a>
            </div>

            <p class="text-center mt-5 text-sm">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-red-600 font-semibold hover:underline">
                    Daftar Sekarang
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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pendonor</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .sidebar-closed {
            transform: translateX(-16rem); /* -64 */
        }
    </style>
</head>

<body class="bg-slate-100 font-sans">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside id="sidebar" class="bg-white shadow-lg border-r w-64 transition-transform duration-200 ease-in-out">
        <div class="h-16 flex items-center px-6 border-b">
            <span class="font-bold text-xl text-red-600">HopeBlood</span>
        </div>

        <nav class="mt-4">

            <a href="{{ route('pendonor.dashboard') }}"
               class="flex items-center px-6 py-3 text-sm font-medium
                      text-red-600 bg-red-50 border-l-4 border-red-500">
                <span>Dashboard</span>
            </a>

            <a href="{{ route('pendonor.permintaan') }}"
               class="flex items-center px-6 py-3 text-sm text-slate-600 hover:bg-slate-50">
                <span>Permintaan Donor</span>
            </a>

            <a href="{{ route('pendonor.riwayat') }}"
               class="flex items-center px-6 py-3 text-sm text-slate-600 hover:bg-slate-50">
                <span>Riwayat Donor</span>
            </a>

        </nav>
    </aside>

    <!-- KONTEN UTAMA -->
    <div class="flex-1 flex flex-col">

        <!-- TOPBAR -->
        <header class="h-16 bg-white shadow flex items-center justify-between px-6">
            <div class="flex items-center gap-3">

                <!-- Toggle Button -->
                <button id="toggleSidebar"
                        class="md:hidden inline-flex items-center justify-center rounded-lg p-2 hover:bg-slate-100">
                    <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <h1 class="text-lg font-semibold text-slate-800">Dashboard Pendonor</h1>
            </div>
            <div class="flex items-center gap-4">

                {{-- Nama User --}}
                <span class="text-sm text-slate-600">
                    Halo, {{ Auth::user()->name ?? 'Pendonor' }}
                </span>

                {{-- Avatar --}}
                <div class="w-9 h-9 rounded-full bg-red-500 text-white flex items-center justify-center text-sm">
                    {{ strtoupper(substr(Auth::user()->name ?? 'P',0,1)) }}
                </div>

                {{-- Tombol Logout --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="text-sm px-3 py-1 rounded-full bg-slate-200 hover:bg-slate-300 text-slate-700 transition font-medium"
                    >
                        Logout
                    </button>
                </form>

            </div>


        </header>

        <!-- CONTENT SLOT -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>
</div>

<!-- jQuery Sidebar Script -->
<script>
    $(document).ready(function () {
        $("#toggleSidebar").click(function () {
            $("#sidebar").toggleClass("sidebar-closed");
        });
    });
</script>

</body>
</html>

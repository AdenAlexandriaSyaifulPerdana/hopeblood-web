<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Donor Darah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans" x-data="{ sidebarOpen: true }">

{{-- NAVBAR ATAS --}}
<nav class="bg-white shadow fixed top-0 left-0 w-full z-40">
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
        <h1 class="text-xl md:text-2xl font-extrabold tracking-tight text-red-600">
            HopeBlood Admin
        </h1>

        <div class="flex items-center gap-4">
            <span class="hidden sm:inline text-sm text-slate-600">
                Halo, <span class="font-semibold">{{ Auth::user()->name }}</span>
            </span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button
                    class="bg-red-600 text-white px-4 py-2 rounded-full text-xs md:text-sm font-semibold
                           hover:bg-red-700 transition shadow">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="flex pt-16 min-h-screen">

    {{-- SIDEBAR KIRI --}}
    <aside class="w-64 bg-white shadow-lg border-r fixed inset-y-16 left-0 z-30">
        <nav class="py-5 px-4 text-sm">
            <p class="px-2 mb-2 text-[11px] uppercase tracking-[0.2em] text-slate-400">
                Navigasi
            </p>

            <a href="{{ route('admin.dashboard') }}"
               class="block px-3 py-2 rounded-lg font-semibold text-red-700 bg-red-50 mb-1">
                Dashboard
            </a>

            <p class="px-2 mt-4 mb-1 text-[11px] uppercase tracking-[0.2em] text-slate-400">
                Manajemen Data
            </p>
            <a href="{{ route('admin.pendonor.index') }}"
               class="block px-3 py-2 rounded-lg hover:bg-slate-50 text-slate-700">
                Data Pendonor
            </a>
            <a href="{{ route('admin.penerima.index') }}"
               class="block px-3 py-2 rounded-lg hover:bg-slate-50 text-slate-700">
                Data Penerima
            </a>
            <a href="{{ route('admin.hospitals.index') }}"
               class="block px-3 py-2 rounded-lg hover:bg-slate-50 text-slate-700">
                Data Rumah Sakit
            </a>

            <p class="px-2 mt-4 mb-1 text-[11px] uppercase tracking-[0.2em] text-slate-400">
                Operasional
            </p>
            <a href="{{ route('admin.permohonan.index') }}"
               class="block px-3 py-2 rounded-lg hover:bg-slate-50 text-slate-700">
                Permintaan Darah
            </a>

            <p class="px-2 mt-4 mb-1 text-[11px] uppercase tracking-[0.2em] text-slate-400">
                Laporan
            </p>
            <a href="{{ route('admin.laporan') }}"
               class="block px-3 py-2 rounded-lg hover:bg-slate-50 text-slate-700">
                Laporan & Statistik
            </a>
        </nav>
    </aside>

    {{-- KONTEN KANAN (SELAYAR) --}}
    <main class="flex-1 ml-64 p-8">
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@yield('scripts')
</body>
</html>

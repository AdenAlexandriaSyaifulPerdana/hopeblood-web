<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Penerima Darah</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine.js untuk toggle sidebar (opsional) --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-100 font-sans" x-data="{ sidebarOpen: true }">

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="bg-white shadow-lg border-r w-64 transition-transform duration-200 ease-in-out
                  fixed inset-y-0 left-0 z-30"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'">
        <div class="h-16 flex items-center px-6 border-b">
            <span class="font-extrabold text-xl text-red-600 tracking-tight">HopeBlood</span>
        </div>

        <div class="px-6 py-4 border-b">
            <p class="text-xs text-slate-500 uppercase tracking-[0.2em]">Penerima Darah</p>
            <p class="mt-1 text-sm text-slate-700">Halo, <span class="font-semibold">
                {{ Auth::user()->name ?? 'Pengguna' }}
            </span></p>
        </div>

        <nav class="mt-4 space-y-1 px-3">
            <a href="{{ route('penerima.dashboard') }}"
               class="flex items-center px-3 py-2 rounded-lg text-sm font-medium
                      bg-red-50 text-red-600 border border-red-100">
                <span>Dashboard</span>
            </a>

            <a href="{{ route('penerima.permohonan.form') }}"
               class="flex items-center px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50">
                <span>Buat Permohonan Darah</span>
            </a>

            <a href="{{ route('penerima.permohonan.status') }}"
               class="flex items-center px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50">
                <span>Status Permohonan</span>
            </a>

            <a href="{{ route('penerima.profile') }}"
               class="flex items-center px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50">
                <span>Profil Saya</span>
            </a>
        </nav>

        <div class="mt-auto px-3 pb-4 pt-6">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full inline-flex justify-center items-center px-3 py-2 rounded-lg
                               text-sm font-semibold text-white bg-slate-800 hover:bg-slate-900">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- AREA KONTEN (DIKANAN SIDEBAR) --}}
    <div class="flex-1 flex flex-col ml-64">

        {{-- TOPBAR SEDERHANA --}}
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


                <span class="text-sm text-slate-600">
                    Halo, {{ Auth::user()->name ?? 'Penerima' }}
                </span>

               {{-- Avatar --}}
                <a href="{{ route('penerima.profile') }}"
                    class="w-9 h-9 bg-red-500 text-white flex items-center justify-center rounded-full font-bold">
                    {{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 1)) }}
                </a>


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


        </header>

        {{-- KONTEN YANG DI-EXTEND --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Donor Darah</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#e8f3ff]">

    <!-- NAVBAR -->
    <nav class="bg-white shadow fixed top-0 left-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-red-600">BloodCare Admin</h1>

            <div class="flex items-center space-x-6">
                <span class="text-gray-600">Halo, {{ Auth::user()->name }}</span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- MAIN WRAPPER -->
    <div class="flex pt-20">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-white shadow-lg h-screen fixed left-0 top-20 py-6">

            <ul class="space-y-2 px-4">

                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="block px-4 py-3 rounded-lg hover:bg-red-100 text-gray-700 font-semibold">
                       Dashboard Utama
                    </a>
                </li>

                <li class="pt-2 text-gray-500 uppercase text-xs font-bold">Manajemen Data</li>

                <li>
                    <a href="{{ route('admin.pendonor.index') }}"
                    class="block px-4 py-3 rounded-lg hover:bg-red-100">
                        📌 Data Pendonor
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.penerima.index') }}" class="block px-4 py-3 rounded-lg hover:bg-red-100">
                        🩸 Data Penerima Darah
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.hospitals.index') }}" class="block px-4 py-3 rounded-lg hover:bg-red-100">
                         Data Rumah Sakit
                    </a>
                </li>

                <li class="pt-2 text-gray-500 uppercase text-xs font-bold">Operasional</li>

                <li>
                    <a href="{{ route('admin.permohonan.index') }}" class="block px-4 py-3 rounded-lg hover:bg-red-100">
                        Permintaan Darah
                    </a>
                </li>

                <li class="pt-2 text-gray-500 uppercase text-xs font-bold">Laporan</li>

                <li>
                    <a href="#" class="block px-4 py-3 rounded-lg hover:bg-red-100">
                        📊 Laporan & Statistik
                    </a>
                </li>

            </ul>

        </aside>

        <!-- CONTENT -->
        <main class="ml-64 p-8 w-full">

            {{-- KONTEN MASUK DI SINI --}}
            @yield('content')

        </main>

    </div>

</body>
</html>

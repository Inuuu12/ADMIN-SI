<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-[#F8F9FD]" x-data="{ sidebarOpen: false, open: false }" style="visibility: hidden;">
    <!-- Tombol Menu untuk Mobile -->
    <button @click="sidebarOpen = !sidebarOpen"
        class="fixed top-4 left-4 z-50 bg-emerald-600 text-white p-2 rounded-md md:hidden">
        ☰
    </button>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed top-0 left-0 w-64 h-screen bg-emerald-500 shadow-lg transition-transform duration-300 ease-out z-50 md:translate-x-0">

        <button @click="sidebarOpen = false"
            class="absolute top-4 right-4 text-gray-700 text-xl md:hidden">×</button>

        <nav class="p-6">
            @include('layouts.sidebar')
        </nav>
    </aside>

    <!-- Overlay saat sidebar aktif -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"></div>

    <!-- Konten utama -->
    <main class="flex-1 md:ml-64 p-6">
        @yield('content')
    </main>

    <!-- Popup Konfirmasi Logout -->
    <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-80 text-center">
            <h2 class="text-lg font-semibold mb-4">Konfirmasi Logout</h2>
            <p class="text-gray-600 mb-4">Apakah Anda yakin ingin keluar?</p>
            <div class="flex justify-center gap-4">
                <button @click="open = false" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Batal</button>
                <a href="/login" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Logout</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.body.style.visibility = "visible";
        });
    </script>
</body>
</html>

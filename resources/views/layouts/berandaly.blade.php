<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TPA Nurul Iman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 520;
        }
    </style>
</head>

<body class="pt-28">
    <nav class="fixed top-0 left-0 w-full bg-white shadow-md py-6 text-sm z-50">
        <div class="container mx-auto flex justify-between items-center px-6 md:px-32">
            <!-- Logo -->
            <a href="{{ route('beranda') }}" class="flex items-center space-x-3 text-xl font-bold text-gray-700">
                <img src="img/logotpanurul.png" alt="Logo TPQ" class="h-12 w-auto">
                <span>TPQ Nurul Iman</span>
            </a>

            <!-- Menu Tengah -->
            <ul class="hidden md:flex space-x-10">
                <li><a href="{{ route('beranda') }}" class="text-gray-600 hover:text-green-500 transition">Beranda</a></li>

                <!-- Dropdown Profil -->
                <li class="relative group">
                    <button class="flex items-center text-gray-600 hover:text-green-500 transition"
                        onclick="toggleDropdown('profilDropdown')">
                        Profil <i class="ph ph-caret-down ml-1"></i>
                    </button>
                    <ul id="profilDropdown" class="absolute hidden bg-white shadow-md mt-2 py-2 w-40">
                        <li><a href="{{ route('tentang') }}" class="block px-4 py-2 text-gray-600 hover:bg-green-100">Tentang</a></li>
                        <li><a href="{{ route('pengajar') }}" class="block px-4 py-2 text-gray-600 hover:bg-green-100">Guru</a></li>
                        <li><a href="{{ route('program') }}" class="block px-4 py-2 text-gray-600 hover:bg-green-100">Program</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('galeri') }}" class="text-gray-600 hover:text-green-500 transition">Galeri</a></li>

                <!-- Dropdown Layanan -->
                <li class="relative group">
                    <button class="flex items-center text-gray-600 hover:text-green-500 transition"
                        onclick="toggleDropdown('layananDropdown')">
                        Layanan <i class="ph ph-caret-down ml-1"></i>
                    </button>
                    <ul id="layananDropdown" class="absolute hidden bg-white shadow-md mt-2 py-2 w-48">
                        <li><a href="{{ route('informasi_pendaftaran') }}" class="block px-4 py-2 text-gray-600 hover:bg-green-100">Informasi Pendaftaran</a></li>
                        <li><a href="{{ route('pendaftaran') }}" class="block px-4 py-2 text-gray-600 hover:bg-green-100">Pendaftaran Online</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('kontak') }}" class="text-gray-600 hover:text-green-500 transition">Kontak</a></li>
            </ul>

            <!-- Tombol Login -->
            <a href="{{ route('login') }}" onclick="document.getElementById('modal_login').showModal();"
                class="hidden md:flex items-center px-4 py-1 text-gray-600 border-2 border-gray-400 rounded-lg hover:border-green-500 hover:text-green-500 transition">

                <i class="ph ph-user-circle text-lg mr-2"></i>
                Login
            </a>

            <!-- Burger Menu untuk Mobile -->
            <button id="menuToggle" class="md:hidden text-gray-600 focus:outline-none">
                ☰
            </button>
        </div>

        <!-- Menu Mobile -->
        <div id="mobileMenu" class="hidden md:hidden bg-white shadow-md py-3 px-6">
            <a href="{{ route('beranda') }}" class="block text-gray-600 hover:text-green-500 transition py-2">Beranda</a>

            <button class="w-full flex justify-between text-gray-600 hover:text-green-500 transition py-2"
                onclick="toggleDropdown('profilDropdownMobile')">
                Profil <i class="ph ph-caret-down"></i>
            </button>
            <div id="profilDropdownMobile" class="hidden pl-4">
                <a href="{{ route('tentang') }}" class="block text-gray-600 hover:bg-green-100 py-1">Tentang</a>
                <a href="{{ route('pengajar') }}" class="block text-gray-600 hover:bg-green-100 py-1">Guru</a>
                <a href="{{ route('program') }}" class="block text-gray-600 hover:bg-green-100 py-1">Program</a>
            </div>

            <a href="{{ route('galeri') }}" class="block text-gray-600 hover:text-green-500 transition py-2">Galeri</a>

            <button class="w-full flex justify-between text-gray-600 hover:text-green-500 transition py-2"
                onclick="toggleDropdown('layananDropdownMobile')">
                Layanan <i class="ph ph-caret-down"></i>
            </button>
            <div id="layananDropdownMobile" class="hidden pl-4">
                <a href="{{ route('informasi_pendaftaran') }}" class="block text-gray-600 hover:bg-green-100 py-1">Informasi Pendaftaran</a>
                <a href="{{ route('pendaftaran') }}" class="block text-gray-600 hover:bg-green-100 py-1">Pendaftaran</a>
            </div>

            <a href="{{ route('kontak') }}" class="block text-gray-600 hover:text-green-500 transition py-2">Kontak</a>

            <a href="{{ route('login') }}" class="block text-gray-600 border border-gray-300 rounded-lg text-center mt-2 py-2 hover:border-green-500 hover:text-green-500 transition">
                <i class="ph ph-user-circle text-lg mr-2"></i> Login
            </a>
        </div>
    </nav>

    <script>
        // Toggle menu untuk tampilan mobile
        document.getElementById('menuToggle').addEventListener('click', function () {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });

        // Toggle dropdown saat diklik
        function toggleDropdown(id) {
            document.getElementById(id).classList.toggle("hidden");
        }

        // Tutup dropdown jika klik di luar
        document.addEventListener("click", function (event) {
            const dropdowns = ["profilDropdown", "layananDropdown"];
            dropdowns.forEach(id => {
                const dropdown = document.getElementById(id);
                if (dropdown && !dropdown.contains(event.target) && !event.target.closest('.group')) {
                    dropdown.classList.add("hidden");
                }
            });
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 520;
        }
    </style>
</head>

<body>
    <nav class="fixed top-0 left-0 w-full bg-white shadow-md py-6 text-sm z-50">

        <body class="pt-20">
            <div class="container mx-auto flex justify-between items-center px-32">

                <!-- Logo -->
                <a href="{{ route('beranda') }}" class="text-xl font-bold text-gray-800">Logo</a>

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
                            <li><a href="{{ route('tentang') }}"
                                    class="block px-4 py-2 text-gray-600 hover:bg-green-100">Tentang</a>
                            </li>
                            <li><a href="{{ route('pengajar') }}"
                                    class="block px-4 py-2 text-gray-600 hover:bg-green-100">Guru</a>
                            </li>
                            <li><a href="{{ route('program') }}"
                                    class="block px-4 py-2 text-gray-600 hover:bg-green-100">Program</a>
                            </li>
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
                            <li><a href="{{ route('informasi_pendaftaran') }}"
                                    class="block px-4 py-2 text-gray-600 hover:bg-green-100">Informasi
                                    Pendaftaran</a></li>
                            <li><a href="{{ route('pendaftaran') }}"
                                    class="block px-4 py-2 text-gray-600 hover:bg-green-100">Pendaftaran Online</a>
                            </li>
                        </ul>
                    </li>

                    <li><a href="{{ route('kontak') }}" class="text-gray-600 hover:text-green-500 transition">Kontak</a></li>
                </ul>

                <!-- Tombol Login -->
                <a href="#" onclick="document.getElementById('modal_login').showModal();"
                    class="hidden md:flex items-center px-4 py-1 text-gray-600 border border-transparent rounded-lg hover:border-green-500 hover:text-green-500 transition">
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
                <a href="#" class="block text-gray-600 hover:text-green-500 transition py-2">Beranda</a>
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
                    <a href="{{ route('informasi_pendaftaran') }}" class="block text-gray-600 hover:bg-green-100 py-1">Informasi
                        Pendaftaran</a>
                    <a href="{{ route('pendaftaran') }}" class="block text-gray-600 hover:bg-green-100 py-1">Pendaftaran</a>
                </div>

                <a href="{{ route('kontak') }}" class="block text-gray-600 hover:text-green-500 transition py-2">Kontak</a>

                <a href="#"
                    class="block text-gray-600 border border-gray-300 rounded-lg text-center mt-2 py-2 hover:border-green-500 hover:text-green-500 transition">
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


    <div class="container mx-auto py-10">
        <h1 class="text-2xl font-bold text-center mb-4 text-gray-800">Kontak</h1>
        <div class="flex flex-wrap justify-center gap-6">


            <div class="container mx-auto ">
                <h1 class="text-sm font-sm text-center mb-10 text-gray-600">Silahkan menghubungi kami untuk menyampaikan
                    pertanyaan, komentar, saran maupun hal lainnya.</h1>
                <div class="flex flex-wrap justify-center">

                    <div class="container mx-auto p-1/2">
                        <div class="flex flex-wrap gap-6 justify-center">
                            <!-- Card 1: Nomor Telepon -->
                            <div
                                class="card flex flex-col items-center justify-center bg-white shadow-sm rounded-lg overflow-hidden w-full md:w-5/12 transform transition-all duration-300 hover:scale-105 hover:shadow-lg border border-gray-300 p-6">
                                <svg class="w-8" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path
                                        d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                                </svg>
                                <h2 class="text-lg font-semibold text-gray-800 mt-4 text-center">Nomor Telepon</h2>
                                <p class="text-sm text-gray-600 text-center mt-2">+62 812-3456-7890</p>
                            </div>

                            <!-- Card 2: Email -->
                            <div
                                class="card flex flex-col items-center justify-center bg-white shadow-sm rounded-lg overflow-hidden w-full md:w-5/12 transform transition-all duration-300 hover:scale-105 hover:shadow-lg border border-gray-300 p-6">
                                <svg class="w-8" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path
                                        d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                                </svg>
                                <h2 class="text-lg font-semibold text-gray-800 mt-4 text-center">Email</h2>
                                <p class="text-sm text-gray-600 text-center mt-2">agusbuono@apps.ipb.ac.id</p>
                            </div>
                        </div>

                        <!-- Peta -->
                        <div class="flex px-28">
                            <div
                                class="relative mt-12 rounded-lg overflow-hidden shadow-lg border border-gray-300 w-full">
                                <div
                                    class="absolute inset-0 bg-gradient-to-b from-transparent to-green-50 opacity-30 pointer-events-none">
                                </div>
                                <iframe class="rounded-lg"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.6269499982014!2d106.85750497479656!3d-7.162048372994154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6993ef57336b33%3A0x553bb830cc0bcebc!2sAnanda%20Collection%20Pisangan%20Baru!5e0!3m2!1sid!2sid!4v1699000000000!5m2!1sid!2sid"
                                    width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-green-600 to-green-700 text-white py-6">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Tentang TPA -->
                <div>
                    <h2 class="text-lg font-bold mb-4">Tentang TPA Nurul Iman</h2>
                    <p class="text-sm">
                        TPA Nurul Iman adalah lembaga pendidikan Al-Qur'an yang bertujuan mencetak generasi muda
                        berakhlakul karimah
                        dengan pendekatan islami yang menyenangkan dan edukatif.
                    </p>
                </div>
                <!-- Tautan Cepat -->
                <div>
                    <h2 class="text-lg font-bold mb-4">Tautan Cepat</h2>
                    <ul class="text-sm space-y-2">
                        <li><a href="{{ route('beranda') }}" class="hover:underline">Beranda</a></li>
                        <li><a href="{{ route('tentang') }}" class="hover:underline">Tentang Kami</a></li>
                        <li><a href="{{ route('program') }}" class="hover:underline">Program Belajar</a></li>
                        <li><a href="{{ route('pendaftaran') }}" class="hover:underline">Pendaftaran</a></li>
                        <li><a href="{{ route('kontak') }}" class="hover:underline">Kontak</a></li>
                    </ul>
                </div>
                <!-- Kontak -->
                <div>
                    <h2 class="text-lg font-bold mb-4">Kontak Kami</h2>
                    <ul class="text-sm space-y-2">
                        <li><strong>Alamat:</strong> Jl. Pisangan Baru, Jakarta Timur</li>
                        <li><strong>Email:</strong> <a href="mailto:info@tpanuruliman.com"
                                class="hover:underline">info@tpanuruliman.com</a></li>
                        <li><strong>Telepon:</strong> +62 812-3456-7890</li>
                        <li><strong>Jam Operasional:</strong> Senin - Jum'at, 08.00 - 16.00 WIB</li>
                    </ul>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-400 mt-6"></div>

            <!-- Footer Bottom -->
            <div class="mt-4 text-center text-sm">
                <p>&copy; 2025 TPA Nurul Iman. Semua Hak Dilindungi.</p>
            </div>
        </div>
    </footer>

</body>

</html>
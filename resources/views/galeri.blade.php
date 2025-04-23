<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri</title>
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
        <h1 class="text-2xl font-bold text-center mb-4 text-gray-800">Dokumentasi Kegiatan</h1>
        <div class="flex flex-wrap justify-center gap-6">


            <div class="container mx-auto ">
                <h1 class="text-sm font-sm text-center mb-10 text-gray-600">Dokumentasi berbagai kegiatan dan program
                    unggulan yang telah kami selenggarakan.</h1>
                <div class="flex flex-wrap justify-center gap-10">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Card 1 -->
                        <div
                            class="border border-gray-300 shadow-md rounded-lg overflow-hidden w-80 min-h-[360px] flex flex-col">
                            <img src="img/photo1.png" alt="Gambar 1" class="w-full h-2/3 object-cover">
                            <div class="p-4 flex flex-col flex-1">
                                <h2 class="text-lg font-semibold text-gray-800 text-center">Pesantren Kilat</h2>
                                <p class="text-sm text-gray-600 mt-2 flex-grow text-center">
                                    Pesantren Kilat di TPA Nurul Iman bertujuan meningkatkan pemahaman dan pengamalan
                                    nilai-nilai Islam selama bulan Ramadhan.
                                </p>
                                <div class="w-full">
                                    <button type="submit"
                                        class="bg-gradient-to-r from-green-700 to-green-500 text-white text-sm font-medium px-4 py-2 w-full rounded-lg mt-4 shadow-md transition-all hover:opacity-90">
                                        Selengkapnya
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div
                            class="border border-gray-300 shadow-md rounded-lg overflow-hidden w-80 min-h-[360px] flex flex-col">
                            <img src="img/photo1.png" alt="Gambar 2" class="w-full h-2/3 object-cover">
                            <div class="p-4 flex flex-col flex-1">
                                <h2 class="text-lg font-semibold text-gray-800 text-center">Kajian Islami</h2>
                                <p class="text-sm text-gray-600 mt-2 flex-grow text-center">
                                    Program kajian Islam yang membahas berbagai topik keagamaan dengan pendekatan yang
                                    interaktif dan mendalam.
                                </p>
                                <div class="w-full">
                                    <button type="submit"
                                        class="bg-gradient-to-r from-green-700 to-green-500 text-white text-sm font-medium px-4 py-2 w-full rounded-lg mt-4 shadow-md transition-all hover:opacity-90">
                                        Selengkapnya
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div
                            class="border border-gray-300 shadow-md rounded-lg overflow-hidden w-80 min-h-[360px] flex flex-col">
                            <img src="img/photo1.png" alt="Gambar 3" class="w-full h-2/3 object-cover">
                            <div class="p-4 flex flex-col flex-1">
                                <h2 class="text-lg font-semibold text-gray-800 text-center">Buka Puasa Bersama</h2>
                                <p class="text-sm text-gray-600 mt-2 flex-grow text-center">
                                    Acara buka puasa bersama yang mempererat tali silaturahmi dan berbagi kebahagiaan
                                    dalam suasana Ramadhan.
                                </p>
                                <div class="w-full">
                                    <button type="submit"
                                        class="bg-gradient-to-r from-green-700 to-green-500 text-white text-sm font-medium px-4 py-2 w-full rounded-lg mt-4 shadow-md transition-all hover:opacity-90">
                                        Selengkapnya
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div
                            class="border border-gray-300 shadow-md rounded-lg overflow-hidden w-80 min-h-[360px] flex flex-col">
                            <img src="img/photo1.png" alt="Gambar 4" class="w-full h-2/3 object-cover">
                            <div class="p-4 flex flex-col flex-1">
                                <h2 class="text-lg font-semibold text-gray-800 text-center">Tadarus Al-Quran</h2>
                                <p class="text-sm text-gray-600 mt-2 flex-grow text-center">
                                    Program membaca dan memahami Al-Quran bersama dalam suasana yang khidmat dan penuh
                                    hikmah.
                                </p>
                                <div class="w-full">
                                    <button type="submit"
                                        class="bg-gradient-to-r from-green-700 to-green-500 text-white text-sm font-medium px-4 py-2 w-full rounded-lg mt-4 shadow-md transition-all hover:opacity-90">
                                        Selengkapnya
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 5 -->
                        <div
                            class="border border-gray-300 shadow-md rounded-lg overflow-hidden w-80 min-h-[360px] flex flex-col">
                            <img src="img/photo1.png" alt="Gambar 5" class="w-full h-2/3 object-cover">
                            <div class="p-4 flex flex-col flex-1">
                                <h2 class="text-lg font-semibold text-gray-800 text-center">Santunan Yatim</h2>
                                <p class="text-sm text-gray-600 mt-2 flex-grow text-center">
                                    Kegiatan berbagi kebahagiaan dengan anak-anak yatim dalam bentuk santunan dan
                                    donasi.
                                </p>
                                <div class="w-full">
                                    <button type="submit"
                                        class="bg-gradient-to-r from-green-700 to-green-500 text-white text-sm font-medium px-4 py-2 w-full rounded-lg mt-4 shadow-md transition-all hover:opacity-90">
                                        Selengkapnya
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 6 -->
                        <div
                            class="border border-gray-300 shadow-md rounded-lg overflow-hidden w-80 min-h-[360px] flex flex-col">
                            <img src="img/photo1.png" alt="Gambar 6" class="w-full h-2/3 object-cover">
                            <div class="p-4 flex flex-col flex-1">
                                <h2 class="text-lg font-semibold text-gray-800 text-center">Pelatihan Dai</h2>
                                <p class="text-sm text-gray-600 mt-2 flex-grow text-center">
                                    Program pelatihan dai muda untuk meningkatkan keterampilan berdakwah secara efektif.
                                </p>
                                <div class="w-full">
                                    <button type="submit"
                                        class="bg-gradient-to-r from-green-700 to-green-500 text-white text-sm font-medium px-4 py-2 w-full rounded-lg mt-4 shadow-md transition-all hover:opacity-90">
                                        Selengkapnya
                                    </button>
                                </div>
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
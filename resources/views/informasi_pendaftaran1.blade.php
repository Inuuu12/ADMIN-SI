<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pendaftaran</title>
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
                <a href="/beranda.blade.php" class="text-xl font-bold text-gray-800">Logo</a>

                <!-- Menu Tengah -->
                <ul class="hidden md:flex space-x-10">
                    <li><a href="/beranda.blade.php" class="text-gray-600 hover:text-green-500 transition">Beranda</a></li>

                    <!-- Dropdown Profil -->
                    <li class="relative group">
                        <button class="flex items-center text-gray-600 hover:text-green-500 transition"
                            onclick="toggleDropdown('profilDropdown')">
                            Profil <i class="ph ph-caret-down ml-1"></i>
                        </button>
                        <ul id="profilDropdown" class="absolute hidden bg-white shadow-md mt-2 py-2 w-40">
                            <li><a href="/tentang.blade.php"
                                    class="block px-4 py-2 text-gray-600 hover:bg-green-100">Tentang</a>
                            </li>
                            <li><a href="/pengajar.blade.php"
                                    class="block px-4 py-2 text-gray-600 hover:bg-green-100">Guru</a>
                            </li>
                            <li><a href="/program.blade.php"
                                    class="block px-4 py-2 text-gray-600 hover:bg-green-100">Program</a>
                            </li>
                        </ul>
                    </li>

                    <li><a href="/galeri.blade.php" class="text-gray-600 hover:text-green-500 transition">Galeri</a></li>

                    <!-- Dropdown Layanan -->
                    <li class="relative group">
                        <button class="flex items-center text-gray-600 hover:text-green-500 transition"
                            onclick="toggleDropdown('layananDropdown')">
                            Layanan <i class="ph ph-caret-down ml-1"></i>
                        </button>
                        <ul id="layananDropdown" class="absolute hidden bg-white shadow-md mt-2 py-2 w-48">
                            <li><a href="/informasi_pendaftaran1.blade.php"
                                    class="block px-4 py-2 text-gray-600 hover:bg-green-100">Informasi
                                    Pendaftaran</a></li>
                            <li><a href="/pendaftaran.blade.php"
                                    class="block px-4 py-2 text-gray-600 hover:bg-green-100">Pendaftaran Online</a>
                            </li>
                        </ul>
                    </li>

                    <li><a href="/kontak.blade.php" class="text-gray-600 hover:text-green-500 transition">Kontak</a></li>
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
                    <a href="/tentang.blade.php" class="block text-gray-600 hover:bg-green-100 py-1">Tentang</a>
                    <a href="/pengajar.blade.php" class="block text-gray-600 hover:bg-green-100 py-1">Guru</a>
                    <a href="/program.blade.php" class="block text-gray-600 hover:bg-green-100 py-1">Program</a>
                </div>

                <a href="/galeri.blade.php" class="block text-gray-600 hover:text-green-500 transition py-2">Galeri</a>

                <button class="w-full flex justify-between text-gray-600 hover:text-green-500 transition py-2"
                    onclick="toggleDropdown('layananDropdownMobile')">
                    Layanan <i class="ph ph-caret-down"></i>
                </button>
                <div id="layananDropdownMobile" class="hidden pl-4">
                    <a href="/informasi_pendaftaran1.blade.php" class="block text-gray-600 hover:bg-green-100 py-1">Informasi
                        Pendaftaran</a>
                    <a href="/pendaftaran.blade.php" class="block text-gray-600 hover:bg-green-100 py-1">Pendaftaran</a>
                </div>

                <a href="/kontak.blade.php" class="block text-gray-600 hover:text-green-500 transition py-2">Kontak</a>

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

    <div class="container mx-auto py-10 px-6 mb-10">
        <h1 class="text-2xl font-bold text-center mb-6 text-gray-800">Informasi Pendaftaran</h1>
        <p class="text-sm text-center mb-10 text-gray-600">Staf pengajar TPA Nurul Iman siap mendampingi anak Anda dalam
            meraih kecintaan terhadap Al-Qur'an dan tumbuh menjadi generasi Qur'ani.</p>

        <div class="flex flex-wrap justify-center gap-8">
            <!-- Card Prosedur Pendaftaran -->
            <div class="flex flex-wrap gap-6 justify-center">
                <div class="flex flex-wrap gap-6 justify-center">
                    <!-- Card 1: Syarat Pendaftaran -->
                    <div
                        class="card bg-white shadow-sm rounded-lg overflow-hidden w-full md:w-5/12 transform transition-all duration-300 hover:scale-105 hover:shadow-lg border border-gray-300 p-6">
                        <h2 class="text-xl font-bold text-center mb-6 text-gray-800">Syarat Pendaftaran</h2>
                        <ul class="list-disc list-inside text-sm text-gray-600 space-y-2">
                            <li>Fotokopi akta kelahiran.</li>
                            <li>Fotokopi kartu keluarga (KK).</li>
                            <li>Pas foto ukuran 3x4 (3 lembar).</li>
                            <li>Surat keterangan sehat dari dokter.</li>
                            <li>Ijazah terakhir (untuk pendaftar SMP/SMA).</li>
                        </ul>
                    </div>

                    <!-- Card 2: Prosedur Pendaftaran -->
                    <div
                        class="card bg-white shadow-sm rounded-lg overflow-hidden w-full md:w-5/12 transform transition-all duration-300 hover:scale-105 hover:shadow-lg border border-gray-300 p-6">
                        <h2 class="text-xl font-bold text-center mb-6 text-gray-800">Prosedur Pendaftaran Calon Santri
                        </h2>

                        <div class="relative">
                            <!-- Garis vertikal -->
                            <div class="absolute left-3 top-0 h-full w-1 bg-green-500"></div>

                            <!-- Langkah 1 -->
                            <div class="relative flex items-start mb-6">
                                <div
                                    class="absolute left-0 w-6 h-6 bg-green-500 text-white flex items-center justify-center text-xs font-bold rounded-full">
                                    1</div>
                                <div class="ml-12">
                                    <h3 class="text-sm font-bold text-gray-600">Mengisi Formulir Pendaftaran Daring</h3>
                                    <p class="text-sm text-gray-600">Sesuai jenjang sekolah yang dituju (KB-TK, SD, SMP,
                                        atau SMA).</p>
                                </div>
                            </div>

                            <!-- Langkah 2 -->
                            <div class="relative flex items-start mb-6">
                                <div
                                    class="absolute left-0 w-6 h-6 bg-green-500 text-white flex items-center justify-center text-xs font-bold rounded-full">
                                    2</div>
                                <div class="ml-12">
                                    <h3 class="text-sm font-bold text-gray-600">Mengisi Data dengan Benar</h3>
                                    <p class="text-sm text-gray-600">Email aktif, data siswa, data orang tua/wali,
                                        wawancara, dan tes online (SMP dan SMA).</p>
                                </div>
                            </div>

                            <!-- Langkah 3 -->
                            <div class="relative flex items-start mb-6">
                                <div
                                    class="absolute left-0 w-6 h-6 bg-green-500 text-white flex items-center justify-center text-xs font-bold rounded-full">
                                    3</div>
                                <div class="ml-12">
                                    <h3 class="text-sm font-bold text-gray-600">Menerima Bukti Pendaftaran di Email</h3>
                                    <p class="text-sm text-gray-600">Cek email masuk yang berisi file PDF dan simpan
                                        sebagai bukti pendaftaran. Pihak sekolah akan segera menghubungi.</p>
                                </div>
                            </div>

                            <!-- Langkah 4 -->
                            <div class="relative flex items-start mb-6">
                                <div
                                    class="absolute left-0 w-6 h-6 bg-green-500 text-white flex items-center justify-center text-xs font-bold rounded-full">
                                    4</div>
                                <div class="ml-12">
                                    <h3 class="text-sm font-bold text-gray-600">Mengikuti Tes Penerimaan Sesuai Jenjang
                                        Sekolah</h3>
                                    <p class="text-sm text-gray-600">Tes berbasis komputer untuk jenjang SMP dan SMA.
                                    </p>
                                </div>
                            </div>

                            <!-- Langkah 5 -->
                            <div class="relative flex items-start">
                                <div
                                    class="absolute left-0 w-6 h-6 bg-gray-600 text-white flex items-center justify-center text-xs font-bold rounded-full">
                                    5</div>
                                <div class="ml-12">
                                    <h3 class="text-sm font-bold text-gray-600">Wawancara Keuangan</h3>
                                    <p class="text-sm text-gray-600">Kesepakatan biaya pendidikan.</p>
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
                        <li><a href="/beranda.blade.php" class="hover:underline">Beranda</a></li>
                        <li><a href="/tentang.blade.php" class="hover:underline">Tentang Kami</a></li>
                        <li><a href="/program.blade.php" class="hover:underline">Program Belajar</a></li>
                        <li><a href="/pendaftaran.blade.php" class="hover:underline">Pendaftaran</a></li>
                        <li><a href="/kontak.blade.php" class="hover:underline">Kontak</a></li>
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
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran</title>
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



    <div class="w-3/4 mb-[100px] mx-auto drop-shadow">
        <a href="">
            <img src="img/photo2.jpg" alt="">
        </a>
        <div class="flex flex-col p-10 bg-white">
            <div class="text-2xl font-bold text-center mb-4 text-gray-800">Pendaftaran Santri Baru TPA Nurul Iman</div>
            <div class="flex flex-wrap justify-center gap-6">
                <div class="container mx-auto ">
                    <h1 class="text-sm font-sm text-center mb-10 text-gray-600">Tingkatkan Iman dan Ilmu Anak Anda di
                        TPA Nurul Iman - Daftar Sekarang dan Tumbuhkan Generasi Cinta Al-Qur'an.</h1>
                    <div class="flex flex-wrap justify-center gap-8">

                        <div class="flex flex-col items-center border-2 p-5">
                            <div class="text-2xl font-bold text-center mb-8  text-gray-800">Formulir Pendaftaran Online
                            </div>
                            <form action="{{ route('pembayaran') }}" class="flex flex-col items-center">
                                <div class="w-full mb-7">
                                    <label for="tempat-lahir" class="block text-sm font-medium mb-4">A. DATA SANTRI
                                    </label>
                                    <input type="text" placeholder="Nama Calon Santri"
                                        class="w-full px-4 bg-gray-100 text-sm font-sm py-3 shadow">
                                </div>

                                <div class="w-full mb-7 text-sm font-sm">
                                    <input type="radio" name="jk" id="jk1" value="Laki-laki">
                                    <label for="jk1">Laki-laki</label>
                                    <input type="radio" name="jk" id="jk2" value="Perempuan">
                                    <label for="jk1">Perempuan</label>
                                </div>
                                <div class="w-full mb-7">

                                    <div class="w-full mb-7">
                                        <input type="text" placeholder="Tempat, Tanggal Lahir"
                                            class="w-full px-4 bg-gray-100 text-sm font-sm py-3 shadow">
                                    </div>

                                    <div class="w-full mb-7">
                                        <input type="text" placeholder="Usia"
                                            class="w-full px-4 bg-gray-100 text-sm font-sm py-3 shadow">
                                    </div>

                                    <div class="w-full mb-7">
                                        <input type="text" placeholder="Kelas"
                                            class="w-full px-4 bg-gray-100 text-sm font-sm py-3 shadow">
                                    </div>

                                    <div class="w-full mb-7">
                                        <textarea name="pesan" id="" placeholder="Alamat"
                                            class="w-full px-4 bg-gray-100 text-sm font-sm py-3 shadow"></textarea>
                                    </div>

                                    <div class="w-full mb-7">
                                        <label for="akta" class="block text-gray-600 font-medium mb-2">Upload Akta
                                            Kelahiran:</label>
                                        <input type="file" id="akta" name="akta" accept="image/*" required
                                            class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-green-500">
                                    </div>

                                    <div class="w-full mb-7">
                                        <label for="kartukeluarga" class="block text-gray-600 font-medium mb-2">Upload
                                            Kartu Keluarga:</label>
                                        <input type="file" id="kartukeluarga" name="kartukeluarga" accept="image/*"
                                            required
                                            class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-green-500">
                                    </div>


                                    <div class="w-full mb-7">
                                        <label for="tempat-lahir" class="block text-sm font-medium mt-10 mb-4">B. ORANG
                                            TUA </label>
                                        <input type="text" placeholder="Nama Orang Tua"
                                            class="w-full px-4 bg-gray-100 text-sm font-sm py-3 shadow">
                                    </div>

                                    <div class="w-full mb-7 text-sm font-sm">
                                        <input type="radio" name="jk" id="jk1" value="Laki-laki">
                                        <label for="jk1">Laki-laki</label>
                                        <input type="radio" name="jk" id="jk2" value="Perempuan">
                                        <label for="jk1">Perempuan</label>
                                    </div>
                                    <div class="w-full mb-7">

                                        <div class="w-full mb-7">
                                            <input type="text" placeholder="Pekerjaan"
                                                class="w-full px-4 bg-gray-100 text-sm font-sm py-3 shadow">
                                        </div>

                                        <div class="w-full mb-7">
                                            <input type="text" placeholder="No Handphone Orang Tua"
                                                class="w-full px-4 bg-gray-100 text-sm font-sm py-3 shadow">
                                        </div>

                                        <div class="w-full mb-7">
                                            <textarea name="pesan" id="" placeholder="Alamat"
                                                class="w-full px-4 bg-gray-100 text-sm font-sm py-3 shadow"></textarea>
                                        </div>




                                        <div class="mb-3 text-sm font-sm text-center">
                                            <p>
                                                Terima kasih telah mengisi formulir! Setelah ini, selesaikan pendaftaran
                                                melalui halaman pembayaran yang aman dan mudah.
                                            </p>
                                        </div>

                                        <div class="w-full">
                                            <button type="submit" class="bg-gradient-to-r from-green-700 to-green-500 text-white text-sm font-medium px-4 py-3 w-full rounded-lg mt-10
                                   shadow-md">
                                                Daftar Sekarang
                                            </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
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
    <!-- Modal Login -->
    <dialog id="modal_login" class="modal backdrop-blur-lg">
        <div class="modal-box font-poppins p-0 w-76 lg:w-96 flex flex-col relative">
            <!-- Bagian atas modal dengan tombol close -->
            <div class="flex items-center bg-green-600 h-24 lg:h-40 relative">
                <h2 class="text-2xl lg:text-5xl font-bold text-center text-white w-full">Login</h2>
                <!-- Tombol close di kanan atas -->
                <button class="absolute top-2 right-4 text-white text-3xl hover:text-gray-300 z-20"
                    onclick="document.getElementById('modal_login').close()">
                    <i class="fa-solid fa-xmark"></i> <!-- Ikon close -->
                </button>
            </div>
            <div class="px-8 pt-4 pb-12">
                <form id="loginForm" action="" class="flex flex-col gap-2">
                    <div class="flex flex-col">
                        <label for="username">Username</label>
                        <input type="text" id="username" placeholder="Masukkan username"
                            class="w-full p-2 rounded-md bg-gray-100 focus:outline-none focus:ring focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div class="flex flex-col">
                        <label for="password">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 right-0 flex items-center px-2">
                                <input class="hidden js-password-toggle" id="toggle" type="checkbox" />
                                <label
                                    class="bg-gray-300 hover:bg-gray-400 rounded px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-password-label"
                                    for="toggle"><i class="fa-solid fa-eye"></i></label>
                            </div>
                            <input type="password" id="password" placeholder="Masukkan password"
                                class="js-password w-full p-2 rounded-md bg-gray-100 focus:outline-none focus:ring focus:ring-green-500 focus:border-green-500">
                        </div>
                        <a id="buttonLupa" onclick="modal_lupa.showModal()"
                            class="mt-1 text-sm text-green-600 hover:text-green-800 text-center hover:underline">Lupa
                            password?</a>
                    </div>
                    <div class="flex flex-col mt-2">
                        <button type="submit"
                            class="p-2 rounded-md bg-green-600 text-white hover:bg-green-700">Login</button>
                    </div>

                    <div class="mt-2 text-center">
                        Belum punya akun? <form method="dialog" class="inline">
                            <button id="buttonSwitchToRegister"
                                class="buttonSwitchToRegister text-green-600 hover:text-green-700 hover:underline"
                                onclick="modal_register.showModal()">Daftar!</button>
                        </form>
                    </div>
            </div>
        </div>
    </dialog>

    <!-- Modal Lupa -->
    <dialog id="modal_lupa" class="modal backdrop-blur-lg">
        <div class="modal-box font-poppins p-0 w-76 lg:w-96 flex flex-col relative">
            <!-- Bagian atas modal dengan tombol close -->
            <div class="flex items-center bg-green-600 h-24 lg:h-40 relative">
                <h2 class="text-2xl lg:text-3xl font-bold text-center text-white w-full">Reset Password</h2>
                <!-- Tombol close di kanan atas -->
                <button class="absolute top-2 right-4 text-white text-3xl hover:text-gray-300 z-20"
                    onclick="document.getElementById('modal_login').close()">
                    <i class="fa-solid fa-xmark"></i> <!-- Ikon close -->
                </button>
            </div>
            <div class="px-8 pt-4 pb-12">
                <form id="loginForm" action="" class="flex flex-col gap-2">
                    <div class="flex flex-col">
                        <label for="username">Email</label>
                        <input type="text" id="username" placeholder="Masukkan username"
                            class="w-full p-2 rounded-md bg-gray-100 focus:outline-none focus:ring focus:ring-green-500 focus:border-green-500">
                    </div>

                    <div class="flex flex-col mt-2">
                        <button type="submit"
                            class="p-2 rounded-md bg-green-600 text-white hover:bg-green-700">Kirim</button>
                    </div>

                    <div class="mt-2 text-center">
                        Kembali ke <form method="dialog" class="inline">
                            <button id="buttonBackToLogin"
                                class="buttonSwitchToRegister text-green-600 hover:text-green-700 hover:underline"
                                onclick="modal_login.showModal()">Login!</button>
                        </form>
                    </div>
            </div>
        </div>
    </dialog>


    <script>
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modal_login');
            if (event.target === modal) {
                modal.close();
            }
        });

        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modal_register');
            if (event.target === modal) {
                modal.close();
            }
        });

        document.addEventListener('click', function (event) {
            const button = document.getElementById('buttonSwitchToLogin');
            const modal = document.getElementById('modal_register');
            if (event.target === button) {
                modal.close();
            }
        });

        document.addEventListener('click', function (event) {
            const button = document.getElementById('buttonSwitchToRegister');
            const modal = document.getElementById('modal_login');
            if (event.target === button) {
                modal.close();
            }
        });

        document.addEventListener('click', function (event) {
            const button = document.getElementById('buttonLupa');
            const modal = document.getElementById('modal_login');
            if (event.target === button) {
                modal.close();
            }
        });

        document.addEventListener('click', function (event) {
            const button = document.getElementById('buttonBackToLogin');
            const modal = document.getElementById('modal_lupa');
            if (event.target === button) {
                modal.close();
            }
        });


    </script>

    <!-- Bagian untuk backdrop blur -->
    <style>
        /* Tambahkan gaya untuk backdrop blur */
        .modal::backdrop {
            backdrop-filter: blur(10px);
            /* Efek blur */
            background-color: rgba(0, 0, 0, 0.5);
            /* Warna latar belakang dengan transparansi */
        }
    </style>


    <!-- Modal Register -->
    <dialog id="modal_register" class="modal backdrop-blur-lg">
        <div class="modal-box font-poppins p-0 w-76 lg:w-96 flex flex-col">
            <div class="flex items-center bg-green-600 h-24 lg:h-40">
                <h2 class="text-2xl lg:text-5xl font-bold text-center text-white w-full">Daftar</h2>
            </div>
            <div class="px-8 pt-4 pb-12">
                <form id="registerForm" action="" class="flex flex-col gap-2">
                    <div class="flex flex-col">
                        <label for="namaRegister">Nama</label>
                        <input type="text" id="namaRegister" placeholder="Masukkan nama"
                            class="w-full p-2 rounded-md bg-gray-100 focus:outline-none focus:ring focus:ring-green-600 focus-border-green-600">
                    </div>
                    <div class="flex flex-col">
                        <label for="username-register">Username</label>
                        <input type="text" id="username-register" placeholder="Masukkan username"
                            class="w-full p-2 rounded-md bg-gray-100 focus:outline-none focus:ring focus:ring-green-600 focus-border-green-600">
                    </div>
                    <div class="flex flex-col">
                        <label for="password-register">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 right-0 flex items-center px-2">
                                <input class="hidden js-password-toggle" id="toggle-register" type="checkbox" />
                                <label
                                    class="bg-gray-300 hover:bg-gray-400 rounded px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-password-label"
                                    for="toggle-register"><i class="fa-solid fa-eye"></i></label>
                            </div>
                            <input type="password" id="password-register" placeholder="Masukkan password"
                                class="js-password w-full p-2 rounded-md bg-gray-100 focus:outline-none focus:ring focus:ring-green-600 focus-border-green-600">
                        </div>
                    </div>
                    <div class="flex flex-col mt-4">
                        <button type="submit"
                            class="p-2 rounded-md bg-green-600 text-white hover:bg-green-800">Daftar</button>
                    </div>
                </form>
                <div class="mt-2 text-center">
                    Sudah punya akun? <form method="dialog" class="inline">
                        <button id="buttonSwitchToLogin"
                            class="buttonSwitchToLogin text-green-600 hover:text-green-800 hover:underline hover:underline-green-800 hover:underline-offset-4"
                            onclick="modal_login.showModal()">Login!</button>
                    </form>
                </div>
            </div>
        </div>
    </dialog>


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


    <section id="hero">
        <!-- Sumber: https://unsplash.com/ -->
        <div class="bg-cover bg-center h-screen relative" style="background-image: url('images/photo-01.png');">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-10">
                <h1 class="text-white text-2xl lg:text-5xl font-poppins font-bold mb-1"
                    style="text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.5);">
                    Selamat Datang di TPA Nurul Iman
                </h1>
                <h1 class="text-white text-lg lg:text-l font-poppins mt-3 mb-6 drop-shadow-2xl"
                    style="text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.5);">
                    Membimbing Generasi Qur’ani, Berilmu dan Berakhlak Mulia
                </h1>
            </div>
        </div>
    </section>


    <div class="mt-20 px-48">
        <div class="flex gap-8">

            <img class="w-60 aspect-square rounded-md" src="images/photo1.jpg" alt="">

            <div class="flex flex-col bg-green-600 p-8 rounded-lg shadow-md gap-4">
                <h1 class="text-2xl font-semibold text-white">Sambutan Kepala Sekolah</h1>
                <p class="text-white text-justify text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit
                    molestias nesciunt debitis magni
                    distinctio placeat. Excepturi sapiente adipisci aut doloremque sint. Fugiat eveniet blanditiis
                    dolore rerum quas sed delectus saepe hic, voluptatum accusamus labore possimus quo, dolorem, tempora
                    ex libero omnis nihil placeat. Nihil consequatur mollitia ullam expedita eos perspiciatis labore
                    earum. Temporibus iure asperiores voluptatum ullam ipsa accusantium minima, dolorum, ad enim sunt
                    atque? Aperiam est itaque quibusdam et consequuntur libero eveniet asperiores totam recusandae non
                    explicabo doloremque laboriosam nihil tempora, sit dolorum amet repellendus impedit atque minus?
                    Tenetur incidunt laudantium vel sequi nemo, culpa soluta aperiam unde beatae!
                </p>
            </div>
        </div>
    </div>


    <div class="container mx-auto mt-16 mb-20">
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
                            <img src="images/photo1.png" alt="Gambar 1" class="w-full h-2/3 object-cover">
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
                            <img src="images/photo1.png" alt="Gambar 2" class="w-full h-2/3 object-cover">
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
                            <img src="images/photo1.png" alt="Gambar 3" class="w-full h-2/3 object-cover">
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
                        TPA Nurul Iman adalah lembaga pendidikan Al-Qur'an yang bertujuan mencetak
                        generasi muda
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
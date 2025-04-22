<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pembayaran</title>
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
                        <a href=""
                            class="mt-1 text-sm text-green-600 hover:text-green-800 text-center mt-4 hover:underline">Lupa
                            password?</a>
                    </div>
                    <div class="flex flex-col mt-2">
                        <button type="submit"
                            class="p-2 rounded-md bg-green-600 text-white hover:bg-green-700">Login</button>
                    </div>

                    <div class="mt-2 text-center">
                        Belum punya akun? <form method="dialog" class="inline">
                            <button
                                class="buttonSwitchToLoginOrRegister text-green-600 hover:text-green-700 hover:underline"
                                onclick="modal_register.showModal()">Daftar!</button>
                        </form>
                    </div>
            </div>
        </div>
    </dialog>

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
            <div class="flex items-center bg-[#047D00] rounded-t-lg h-24 lg:h-40">
                <h2 class="text-2xl lg:text-5xl font-bold text-center text-white w-full">Daftar</h2>
            </div>
            <div class="px-8 pt-4 pb-12">
                <form id="registerForm" action="" class="flex flex-col gap-2">
                    <div class="flex flex-col">
                        <label for="namaRegister">Nama</label>
                        <input type="text" id="namaRegister" placeholder="Masukkan nama"
                            class="w-full p-2 rounded-md bg-gray-100 focus:outline-none focus:ring focus:ring-[#047D00] focus-border-[#047D00]">
                    </div>
                    <div class="flex flex-col">
                        <label for="username-register">Username</label>
                        <input type="text" id="username-register" placeholder="Masukkan username"
                            class="w-full p-2 rounded-md bg-gray-100 focus:outline-none focus:ring focus:ring-[#047D00] focus-border-[#047D00]">
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
                                class="js-password w-full p-2 rounded-md bg-gray-100 focus:outline-none focus:ring focus:ring-[#047D00] focus-border-[#047D00]">
                        </div>
                    </div>
                    <div class="flex flex-col mt-4">
                        <button type="submit"
                            class="p-2 rounded-md bg-[#047D00] text-white hover:bg-[#035700]">Daftar</button>
                    </div>
                </form>
                <div class="divider">atau daftar dengan</div>
                <button class="custom-button" onclick="modal_register.showModal()">
                    <svg class="w-8 aspect-square" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" id="Capa_1" version="1.1" viewBox="0 0 150 150"
                        xml:space="preserve">
                        <g>
                            <path class="st14"
                                d="M120,76.1c0-3.1-0.3-6.3-0.8-9.3H75.9v17.7h24.8c-1,5.7-4.3,10.7-9.2,13.9l14.8,11.5   C115,101.8,120,90,120,76.1L120,76.1z" />
                            <path class="st15"
                                d="M75.9,120.9c12.4,0,22.8-4.1,30.4-11.1L91.5,98.4c-4.1,2.8-9.4,4.4-15.6,4.4c-12,0-22.1-8.1-25.8-18.9   L34.9,95.6C42.7,111.1,58.5,120.9,75.9,120.9z" />
                            <path class="st12"
                                d="M50.1,83.8c-1.9-5.7-1.9-11.9,0-17.6L34.9,54.4c-6.5,13-6.5,28.3,0,41.2L50.1,83.8z" />
                            <path class="st13"
                                d="M75.9,47.3c6.5-0.1,12.9,2.4,17.6,6.9L106.6,41C98.3,33.2,87.3,29,75.9,29.1c-17.4,0-33.2,9.8-41,25.3   l15.2,11.8C53.8,55.3,63.9,47.3,75.9,47.3z" />
                        </g>
                    </svg>
                    Google
                </button>
                <div class="mt-2 text-center">
                    Sudah punya akun? <form method="dialog" class="inline">
                        <button
                            class="buttonSwitchToLoginOrRegister text-[#047D00] hover:text-[#035700] hover:underline hover:underline-[#035700] hover:underline-offset-4"
                            onclick="modal_login.showModal()">Login!</button>
                    </form>
                </div>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
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



    <div class="w-3/4 mb-[100px] mx-auto drop-shadow">
        <a href="">
            <img src="images/photo2.jpg" alt="">
        </a>
        <div class="flex flex-col p-10 bg-white">
            <div
                class="card flex bg-white shadow-sm rounded-lg overflow-hidden w-full md:w-full border border-gray-300">
                <div class="bg-white rounded-lg p-6 w-full">
                    <!-- Header -->
                    <h1 class="text-xl font-bold text-gray-800 mb-6 text-center">Instruksi Pembayaran</h1>
                    <p class="text-sm text-gray-600 mb-4">Lakukan transfer ke</p>

                    <!-- Informasi Virtual Account -->
                    <div
                        class="flex items-center justify-between bg-gray-100 border border-gray-300 rounded-lg p-4 mb-4 w-full">
                        <div class="flex items-center space-x-2">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5b/BCA_logo.svg/1200px-BCA_logo.svg.png"
                                alt="BCA" class="h-6">
                            <p class="text-gray-700 font-semibold">BCA Virtual Account</p>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-between bg-gray-50 border border-gray-300 rounded-lg p-4 mb-4 w-full">
                        <span class="text-gray-800 font-mono text-lg">3901089670522489</span>
                        <button class="text-blue-600 hover:underline"
                            onclick="navigator.clipboard.writeText('3901089670522489')">
                            Salin
                        </button>
                    </div>

                    <!-- Total Pembayaran -->
                    <div class="mb-6">
                        <p class="text-sm text-gray-600">Total Pembayaran</p>
                        <p class="text-2xl font-bold text-gray-800">Rp444.000</p>
                    </div>

                    <!-- Cara Membayar -->
                    <h2 class="text-base font-semibold text-gray-800 mb-2">Cara Membayar</h2>
                    <div class="space-y-2 mb-6">
                        <!-- Transfer melalui ATM -->
                        <details class="bg-gray-50 border border-gray-300 text-gray-700 p-3 rounded-lg">
                            <summary class="cursor-pointer font-semibold">Transfer melalui ATM</summary>
                            <ul class="text-sm text-gray-600 mt-2 space-y-2 list-decimal list-inside">
                                <li>Input kartu ATM dan PIN Anda.</li>
                                <li>Pilih Menu Transaksi Lainnya.</li>
                                <li>Pilih Transfer.</li>
                                <li>Pilih Ke Rekening BCA Virtual Account.</li>
                                <li>Input Nomor Virtual Account, yaitu <strong>3901089670522489</strong>.</li>
                                <li>Pilih Benar.</li>
                                <li>Pilih Ya.</li>
                                <li>Ambil bukti bayar Anda.</li>
                                <li>Selesai.</li>
                            </ul>
                        </details>

                        <!-- Transfer melalui Internet Banking -->
                        <details class="bg-gray-50 border border-gray-300 text-gray-700 p-3 rounded-lg">
                            <summary class="cursor-pointer font-semibold">Transfer melalui Internet Banking</summary>
                            <ul class="text-sm text-gray-600 mt-2 space-y-2 list-decimal list-inside">
                                <li>Login Internet Banking.</li>
                                <li>Pilih Transfer Dana.</li>
                                <li>Pilih Transfer ke BCA Virtual Account.</li>
                                <li>Input Nomor Virtual Account, yaitu <strong>3901089670522489</strong> sebagai No.
                                    Virtual
                                    Account.</li>
                                <li>Klik Lanjutkan.</li>
                                <li>Input Respon KeyBCA Appli 1.</li>
                                <li>Klik Kirim.</li>
                                <li>Bukti bayar ditampilkan.</li>
                                <li>Selesai.</li>
                            </ul>
                        </details>

                        <!-- Transfer melalui Mobile Banking -->
                        <details class="bg-gray-50 border border-gray-300 text-gray-700 p-3 rounded-lg">
                            <summary class="cursor-pointer font-semibold">Transfer melalui Mobile Banking</summary>
                            <ul class="text-sm text-gray-600 mt-2 space-y-2 list-decimal list-inside">
                                <li>Login Mobile Banking.</li>
                                <li>Pilih m-Transfer.</li>
                                <li>Pilih BCA Virtual Account.</li>
                                <li>Input Nomor Virtual Account, yaitu <strong>3901089670522489</strong> sebagai No.
                                    Virtual
                                    Account.</li>
                                <li>Klik Send.</li>
                                <li>Informasi Virtual Account akan ditampilkan.</li>
                                <li>Klik OK.</li>
                                <li>Input PIN Mobile Banking.</li>
                                <li>Bukti bayar ditampilkan.</li>
                                <li>Selesai.</li>
                            </ul>
                        </details>
                    </div>

                    <!-- Upload Bukti Pembayaran -->
                    <h2 class="text-base font-semibold text-gray-800 mb-2">Upload Bukti Pembayaran</h2>
                    <form id="paymentUploadForm" action="/upload" method="post" enctype="multipart/form-data"
                        class="space-y-4">
                        <div>
                            <label for="paymentProof" class="block text-gray-600 font-medium mb-2">Pilih File Bukti
                                Pembayaran:</label>
                            <input type="file" id="paymentProof" name="paymentProof" accept="image/*" required
                                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-green-500">
                        </div>
                        <div>
                            <label for="paymentDescription" class="block text-gray-600 font-medium mb-2">Deskripsi
                                (Opsional):</label>
                            <textarea id="paymentDescription" name="paymentDescription" rows="3"
                                placeholder="Tambahkan deskripsi atau catatan"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-green-500"></textarea>
                        </div>
                        <div class="">
                            <button type="submit"
                                class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Upload</button>
                        </div>
                    </form>
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
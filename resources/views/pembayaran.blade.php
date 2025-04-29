@extends('layouts.berandaly')

    <div class="w-3/4 mb-[100px] mx-auto drop-shadow">
        <a href="">
            <img src="img/bannerpendaftaran.png" alt="">
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

@extends('layouts.footerly')
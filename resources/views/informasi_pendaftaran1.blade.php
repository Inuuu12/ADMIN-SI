@extends('layouts.berandaly')

    <div class="container mx-auto py-10 px-6 mb-10">
        <h1 class="text-2xl font-bold text-center mb-6 text-gray-800">Informasi Pendaftaran</h1>
        <p class="text-sm text-center mb-10 text-gray-600">Staf pengajar TPQ Nurul Iman siap mendampingi anak Anda dalam
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
                            <li>Mengisi Formulir Pendaftaran Santri</li>
                            <li>Mengupload Fotokopi kartu keluarga (KK).</li>
                            <li>Mengupload Fotokopi Akte Kelahiran </li>
                            <li>Mengisi Formulir Pendaftaran SWali Santri</li>
                            <li>Melakukan Pembayaran</li>
                
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

@extends('layouts.footerly')
@extends('layouts.berandaly')

    <div class="w-3/4 mb-[100px] mx-auto drop-shadow">
        <a href="">
            <img src="img/bannerpendaftaran1.png" alt="">
        </a>
        
        <div class="flex flex-col p-10 bg-white">
            <div class="text-2xl font-bold text-center mb-4 text-gray-800">Pendaftaran Santri Baru TPQ Nurul Iman</div>
            <div class="flex flex-wrap justify-center gap-6">
                <div class="container mx-auto ">
                    <h1 class="text-sm font-sm text-center mb-10 text-gray-600">Tingkatkan Iman dan Ilmu Anak Anda di
                        TPQ Nurul Iman - Daftar Sekarang dan Tumbuhkan Generasi Cinta Al-Qur'an.</h1>
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

@extends('layouts.footerly')
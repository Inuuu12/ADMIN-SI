@extends('layouts.app')

@section('content')
<div class="p-6 bg-[#F8F9FD] w-full">
    <!-- Header Section dengan notifikasi dan profil -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-[#2B3674]">Panduan</h1>

        <div class="flex items-center gap-4">
            <!-- Search Bar -->
            <form action="{{ route('search') }}" method="GET" class="relative">
                <input type="text" name="query" placeholder="Search here..."
                    class="w-full pl-10 pr-4 py-2 text-gray-500 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
            </div>
            </form>
            
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 font-medium">
                    HF
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Start Guide -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl" x-data="{ showModal: false }">
        <div class="flex items-center gap-4 mb-4">
            <div class="bg-emerald-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </div>
            <h2 class="text-lg font-semibold">Mulai Cepat</h2>
        </div>
        <p class="text-gray-600">Pelajari dasar-dasar penggunaan sistem dalam 5 menit</p>
        <button @click="showModal = true" class="mt-4 text-emerald-500 font-medium">Lihat Panduan →</button>

        <!-- Modal Popup -->
        <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-full sm:w-1/2 lg:w-1/3">
                <h3 class="text-xl font-semibold mb-4">Panduan Penggunaan</h3>
                <p>Isi panduan lengkap ditampilkan di sini...</p>
                <button @click="showModal = false" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Video Tutorial Card -->
    <div class="bg-white p-6 rounded-xl" x-data="{ showVideoModal: false }">
        <div class="flex items-center gap-4 mb-4">
            <div class="bg-amber-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
            </div>
            <h2 class="text-lg font-semibold">Video Tutorial</h2>
        </div>
        <p class="text-gray-600">Tonton video panduan lengkap penggunaan sistem</p>
        <button @click="showVideoModal = true" class="mt-4 text-emerald-500 font-medium">Lihat Video →</button>

        <!-- Modal Video Popup -->
        <div x-show="showVideoModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-full sm:w-1/2 lg:w-1/3">
                <h3 class="text-xl font-semibold mb-4">Video Panduan</h3>
                <iframe class="w-full h-64" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
                <button @click="showVideoModal = false" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Tutup</button>
            </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl" x-data="{ showVideoModal: false }">
        <div class="flex items-center gap-4 mb-4">
            <div class="bg-amber-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
            </div>
            <h2 class="text-lg font-semibold">Video Tutorial</h2>
        </div>
        <p class="text-gray-600">Tonton video panduan lengkap penggunaan sistem</p>
        <button @click="showVideoModal = true" class="mt-4 text-emerald-500 font-medium">Lihat Video →</button>

        <!-- Modal Video Popup -->
        <div x-show="showVideoModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-full sm:w-1/2 lg:w-1/3">
                <h3 class="text-xl font-semibold mb-4">Video Panduan</h3>
                <iframe class="w-full h-64" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
                <button @click="showVideoModal = false" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Tutup</button>
            </div>
        </div>
    </div>
</div>
    <div class="bg-white rounded-xl p-6">
        <h2 class="text-2xl font-semibold mb-6">Pertanyaan yang Sering Diajukan</h2>
        <div class="space-y-4" x-data="{ active: null }">

            <!-- FAQ Item 1 -->
            <div class="border rounded-lg">
                <button class="w-full px-4 py-3 flex justify-between items-center"
                        @click="active = active === 1 ? null : 1">
                    <span class="font-medium">Bagaimana cara mendaftarkan siswa baru?</span>
                    <svg class="w-5 h-5 transform transition-transform"
                         :class="{ 'rotate-180': active === 1 }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="px-4 py-3 border-t" x-show="active === 1" x-collapse>
                    <p class="text-gray-600">
                        1. Klik menu "Pendaftaran" di sidebar<br>
                        2. Pilih "Tambah Siswa Baru"<br>
                        3. Isi formulir dengan data lengkap<br>
                        4. Upload dokumen yang diperlukan<br>
                        5. Klik "Simpan" untuk menyelesaikan pendaftaran
                    </p>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="border rounded-lg">
                <button class="w-full px-4 py-3 flex justify-between items-center"
                        @click="active = active === 2 ? null : 2">
                    <span class="font-medium">Bagaimana cara melakukan pembayaran SPP?</span>
                    <svg class="w-5 h-5 transform transition-transform"
                         :class="{ 'rotate-180': active === 2 }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="px-4 py-3 border-t" x-show="active === 2" x-collapse>
                    <p class="text-gray-600">
                        1. Klik menu "SPP" di sidebar<br>
                        2. Pilih siswa yang akan membayar<br>
                        3. Masukkan nominal pembayaran<br>
                        4. Upload bukti pembayaran<br>
                        5. Tunggu verifikasi dari admin
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Add Alpine.js for FAQ accordion functionality
document.addEventListener('alpine:init', () => {
    Alpine.data('accordion', () => ({
        active: null
    }))
})
</script>
@endsection

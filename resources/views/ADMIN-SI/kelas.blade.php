@extends('layouts.app')

@section('content')
<!-- Tambahkan ini di <head> -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<div class="flex justify-between items-center mb-8">
    <h1 class="text-2xl font-bold text-[#2B3674]">Daftar Kelas</h1>
    <input type="text" placeholder="Cari Kelas..."
        class="w-64 px-4 py-2 rounded-full border focus:outline-none focus:ring-2 focus:ring-blue-500">
</div>

<div class="p-6 bg-[#F8F9FD] min-h-screen">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <!-- Card Kelas A -->
        <div class="mt-8 bg-white rounded-xl shadow-md overflow-hidden flex flex-col max-w-sm w-full">
            <div class="relative bg-emerald-500 p-4 flex items-center justify-between">
                <div class="space-y-1">
                    <h2 class="text-white text-2xl font-bold leading-tight">KELAS A</h2>
                    <p class="text-white text-sm">Moh. Rofi Julian, S. T.</p>
                </div>
                <div class="w-24 h-24">
                    <img class="w-full h-full rounded-full border-4 border-white object-cover" src="/img/photo1.jpg" alt="Guru">
                </div>
            </div>
            <div class="border-t mt-auto py-3 px-4">
                <a href="/kelas/a" class="text-emerald-500 font-semibold text-left block">Daftar Siswa</a>
            </div>
        </div>

        <!-- Card Kelas B -->
        <div class="mt-8 bg-white rounded-xl shadow-md overflow-hidden flex flex-col max-w-sm w-full">
            <div class="relative bg-emerald-500 p-4 flex items-center justify-between">
                <div class="space-y-1">
                    <h2 class="text-white text-2xl font-bold leading-tight">KELAS B</h2>
                    <p class="text-white text-sm">Moh. Rofi Julian, S. T.</p>
                </div>
                <div class="w-24 h-24">
                    <img class="w-full h-full rounded-full border-4 border-white object-cover" src="/img/photo1.jpg" alt="Guru">
                </div>
            </div>
            <div class="border-t mt-auto py-3 px-4">
                <a href="/kelas/b" class="text-emerald-500 font-semibold text-left block">Daftar Siswa</a>
            </div>
        </div>

        <!-- Tambah kelas C, D, E, F secara manual jika perlu -->

    </div>
</div>

@if(session('error'))
    <div id="popup-error" class="popup-alert">
        {{ session('error') }}
    </div>
@endif

<style>
    .popup-alert {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #f44336; /* Merah untuk error */
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        z-index: 9999;
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
    }
</style>

<script>
    setTimeout(() => {
        const popup = document.getElementById('popup-error');
        if (popup) {
            popup.style.opacity = '0';
            setTimeout(() => popup.remove(), 500);
        }
    }, 3000);
</script>
@endsection

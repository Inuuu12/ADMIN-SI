@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-8">
    <h1 class="text-2xl font-bold text-[#2B3674]">Daftar Kelas</h1>
    <input type="text" x-model="searchQuery" placeholder="Cari Kelas..."
        class="w-64 px-4 py-2 rounded-full border focus:outline-none focus:ring-2 focus:ring-blue-500">
</div>

<div class="p-6 bg-[#F8F9FD] min-h-screen">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <!-- Card Kelas -->
        @foreach (['A', 'B', 'C', 'D', 'E', 'F'] as $kelas)
        <div class="mt-8 bg-white rounded-xl shadow-md overflow-hidden flex flex-col max-w-sm w-full">

            <!-- Header -->
            <div class="relative bg-emerald-500 p-4 flex items-center justify-between">
                <div class="space-y-1">
                    <h2 class="text-white text-2xl font-bold leading-tight">KELAS {{ $kelas }}</h2>
                    <p class="text-white text-sm">Moh. Rofi Julian, S. T.</p>
                </div>

                <!-- Profile Picture -->
                <div class="w-24 h-24">
                    <img class="w-full h-full rounded-full border-4 border-white object-cover" src="C:\laragon\www\ProyekSIadmin\public\img\photo1.jpg" alt="Guru">
                </div>
            </div>

            <!-- Footer -->
            <div class="border-t mt-auto py-3 px-4">
                <a href="{{ url('/kelas/' . strtolower($kelas)) }}" class="text-emerald-500 font-semibold text-left block">
                    Lihat Detail
                </a>
            </div>

        </div>
        @endforeach

    </div>
</div>

@endsection

@extends('layouts.berandaly')

<div class="max-w-4xl mx-auto mt-12 bg-white shadow-lg rounded-xl overflow-hidden">
    <div class="p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-4">Profil Pengguna</h1>
        <div class="grid gap-4 text-gray-700 text-lg">
            <div class="flex items-center">
                <span class="w-40 font-semibold">Nama:</span>
                <span>{{ auth()->user()->name }}</span>
            </div>
            <div class="flex items-center">
                <span class="w-40 font-semibold">Email:</span>
                <span>{{ auth()->user()->email }}</span>
            </div>
            <!-- Tambahkan informasi lain di sini jika diperlukan -->
        </div>
    </div>
</div>
@include('layouts.footerly')

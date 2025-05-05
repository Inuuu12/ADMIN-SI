@extends('layouts.berandaly')

<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white p-10 rounded-xl shadow-lg max-w-lg text-center animate-fadeIn">
        <h1 class="text-3xl font-extrabold mb-4 text-gray-800">Pembayaran Berhasil!</h1>
        <p class="text-gray-600 mb-6 text-lg">
            Terima kasih! Tim TPQ akan menghubungi Anda dalam 1x24 jam untuk informasi selanjutnya.
        </p>
        <a href="{{ route('beranda') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300">
            Kembali ke Beranda
        </a>
    </div>
</div>

@extends('layouts.footerly')

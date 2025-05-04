@extends('layouts.berandaly')

<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white p-10 rounded-xl shadow-lg max-w-lg text-center animate-fadeIn">
        <svg class="mx-auto mb-6 w-20 h-20 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4-4" />
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none" />
        </svg>
        <h1 class="text-3xl font-extrabold mb-4 text-gray-800">Terima kasih telah mendaftar!</h1>
        <p class="text-gray-600 mb-6 text-lg">
            Pendaftaran Anda telah berhasil kami terima. Silakan tunggu proses verifikasi selama 2x24 jam.
        </p>
        <a href="{{ route('beranda') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300">
            Kembali ke Beranda
        </a>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.8s ease forwards;
    }
</style>

@extends('layouts.footerly')

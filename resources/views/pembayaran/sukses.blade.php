@extends('layouts.berandaly')

    <div class="w-3/4 mb-[100px] mx-auto drop-shadow">
        <a href="">
            <img src="{{ asset('img/bannerpendaftaran.png') }}" alt="">
        </a>
        <div class="flex flex-col p-10 bg-white">
            <div class="card flex bg-white shadow-sm rounded-lg overflow-hidden w-full md:w-full border border-gray-300">
                <div class="bg-white rounded-lg p-6 w-full">
                    <h1 class="text-xl font-bold text-gray-800 mb-6 text-center">Pembayaran Sukses</h1>
                    <div class="mb-6">
                        <p class="text-sm text-gray-600">Terima kasih, pembayaran Anda berhasil!</p>
                        <p class="text-2xl font-bold text-gray-800">Status Pembayaran: {{ $pendaftaran->status_pembayaran }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@extends('layouts.footerly')

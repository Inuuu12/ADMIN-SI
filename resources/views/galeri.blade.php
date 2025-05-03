@extends('layouts.berandaly')

<div class="container mx-auto py-10">
    <h1 class="text-2xl font-bold text-center mb-8 text-gray-800">Dokumentasi Kegiatan</h1>
    <div class="container mx-auto">
        <h1 class="text-sm font-sm text-center mb-6 text-gray-600">
            Dokumentasi berbagai kegiatan dan program unggulan yang telah kami selenggarakan.
        </h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2 justify-items-center">
            @foreach ($galeris as $galeri)
            <div class="border border-gray-300 shadow-md rounded-lg overflow-hidden w-80 min-h-[360px] flex flex-col transition-shadow hover:shadow-lg mb-4">
                <img src="{{ asset('gambar/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}" class="w-full h-2/3 object-cover" />
                <div class="p-4 flex flex-col flex-1">
                    <h2 class="text-lg font-semibold text-gray-800 text-center mt-3">{{ $galeri->judul }}</h2>
                    <p class="text-sm text-gray-600 mt-2 flex-grow text-center">{{ $galeri->deskripsi }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


@extends('layouts.footerly')


@extends('layouts.app')

@section('content')

<div class="p-6 bg-[#F8F9FD] min-h-screen">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md p-8">
        <h1 class="text-3xl font-bold text-emerald-600 mb-6">Detail Kelas {{ strtoupper($kelas) }}</h1>

        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-2">Guru Pengajar</h2>
            <p class="text-lg text-gray-600">{{ $guru }}</p>
        </div>

        <div>
            <h2 class="text-2xl font-semibold text-gray-700 mb-2">Daftar Siswa</h2>
            <ul class="list-disc list-inside space-y-2 text-gray-600">
                @foreach ($siswa as $nama)
                    <li>{{ $nama }}</li>
                @endforeach
            </ul>
        </div>

        <div class="mt-8">
            <a href="{{ url('/kelas') }}" class="inline-block bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>
    </div>
</div>

@endsection

@extends('layouts.app')

@section('content')
    <div x-data="{ showTambah: false, showEdit: false }" class="p-6 bg-[#F8F9FD] min-h-screen">

    <!-- Title and Search -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#2B3674]">Santri</h1>
        <form method="GET" action="{{ url('/admin/santri') }}" class="relative w-64">
            <input type="text" name="search" id="searchNama" placeholder="Cari Nama Santri..." class="w-full pl-10 pr-4 py-2 text-gray-500 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ request('search') }}" onkeydown="if(event.key === 'Enter'){ this.form.submit(); }" />
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-4.35-4.35M17 10a7 7 0 1 0-7 7 7 7 0 0 0 7-7z" />
            </svg>
        </form>
    </div>

    <!-- Total Santri Card -->
    <div class="bg-white p-6 rounded-xl flex items-center gap-4 shadow-md mb-6 max-w-xs">
        <div class="bg-emerald-100 p-4 rounded-full">
            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-gray-500">Total Santri</p>
            <h3 id="totalSantriCount" class="text-2xl font-bold">{{ $santris->count() }}</h3>
        </div>
    </div>

    <!-- Filter & Sorting Controls and Tambah Santri Button -->
    <form method="GET" action="{{ url('/admin/santri') }}" class="flex justify-between mb-6">
        <input type="hidden" name="search" value="{{ request('search') }}">
        <div class="bg-white p-2 rounded-xl flex items-center shadow gap-6 max-w-md">
            <select name="jenis_kelamin" id="filterJenisKelamin" class="border rounded-lg px-3 py-2 text-base" onchange="this.form.submit()">
                <option value="" {{ request('jenis_kelamin') == '' ? 'selected' : '' }}>Semua Jenis Kelamin</option>
                <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            <select name="sort_by" id="sortBy" class="border rounded-lg px-3 py-2 text-base" onchange="this.form.submit()">
                <option value="terbaru" {{ request('sort_by') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                <option value="terlama" {{ request('sort_by') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                <option value="nama_asc" {{ request('sort_by') == 'nama_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                <option value="nama_desc" {{ request('sort_by') == 'nama_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
            </select>
        </div>

        <button type="button" @click="showTambah = true" class="bg-emerald-500 text-white px-4 py-3 text-lg rounded-lg shadow-md hover:bg-emerald-600 whitespace-nowrap">
            Tambah Santri Baru
        </button>
    </form>
 

    <!-- Tabel Santri -->
    <div class="bg-white rounded-md overflow-x-auto shadow-md">
        <table class="w-full text-sm text-left border-collapse" id="santriTable">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-center text-gray-600 whitespace-nowrap">No</th>
                    <th class="px-6 py-3 text-center text-gray-600 whitespace-nowrap">NIS</th>
                    <th class="px-6 py-3 text-center text-gray-600 whitespace-nowrap">Nama Santri</th>
                    <th class="px-6 py-3 text-center text-gray-600 whitespace-nowrap">Usia</th>
                    <th class="px-6 py-3 text-center text-gray-600 whitespace-nowrap">Jenis Kelamin</th>
                    <th class="px-6 py-3 text-center text-gray-600 whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($santris as $index => $santri)
                <tr class="border-b hover:bg-gray-50" data-index="{{ $index }}" data-tanggal="{{ $santri->tanggal_lahir }}">
                    <td class="px-6 py-3 text-center">{{ $santris->firstItem() + $index }}</td>
                    <td class="px-6 py-3 text-center">{{ $santri->nis }}</td>
                    <td class="px-6 py-3 text-center">{{ $santri->nama_santri }}</td>
                    <td class="px-6 py-3 text-center">
                        @php
                            $birthDate = \Carbon\Carbon::parse($santri->tanggal_lahir);
                            $age = $birthDate->age;
                        @endphp
                        {{ $age }} tahun
                    </td>
                    <td class="px-6 py-3 text-center">
                        {{ $santri->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki' }}
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div class="flex flex-col md:flex-row gap-2 justify-center">
                            <button type="button" onclick="showDetail({{ $index }})" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">Detail</button>
                            <button type="button" onclick="showEdit({{ $index }})" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Edit</button>
                            <form method="POST" action="{{ url('/admin/santri/' . $santri->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus santri ini?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div x-show="showTambah" x-transition class="fixed inset-0 z-50 flex justify-center items-center bg-black/50 backdrop-blur-sm px-4 overflow-auto">
        <div @click.away="showTambah = false" class="bg-white w-full max-w-2xl rounded-lg shadow-lg p-8 animate-scaleIn overflow-y-auto max-h-[80vh] space-y-6">
            <h3 class="text-2xl font-semibold text-center mb-4">Form Tambah Santri Baru</h3>
            <form id="tambahSiswaForm" class="space-y-4" enctype="multipart/form-data">
                <div>
                    <label class="block font-medium mb-1">Nama Santri:</label>
                    <input type="text" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="tambahNama" placeholder="Nama Santri" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Jenis Kelamin:</label>
                    <div class="flex gap-4">
                        <label><input type="radio" name="tambahJenisKelamin" value="L" required> Laki-laki</label>
                        <label><input type="radio" name="tambahJenisKelamin" value="P" required> Perempuan</label>
                    </div>
                </div>
                <div>
                    <label class="block font-medium mb-1">Tempat Lahir:</label>
                    <input type="text" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="tambahTempatLahir" placeholder="Tempat Lahir" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Tanggal Lahir:</label>
                    <input type="date" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="tambahTanggalLahir" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Upload Akta Kelahiran (PDF):</label>
                    <input type="file" class="w-full border rounded-md focus:ring focus:ring-emerald-300" id="tambahAktaKelahiran" accept="application/pdf" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Upload Kartu Keluarga (PDF):</label>
                    <input type="file" class="w-full border rounded-md focus:ring focus:ring-emerald-300" id="tambahKartuKeluarga" accept="application/pdf" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Nama Orang Tua:</label>
                    <input type="text" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="tambahNamaOrangTua" placeholder="Nama Orang Tua" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">No HP:</label>
                    <input type="text" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="tambahNoHp" placeholder="No Handphone" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Alamat:</label>
                    <textarea class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="tambahAlamat" placeholder="Alamat" required></textarea>
                </div>
                <button type="button" class="w-full py-2 px-4 bg-emerald-500 text-white rounded-md hover:bg-emerald-600" onclick="saveTambahSiswa()">Simpan</button>
            </form>
            <button class="w-full py-2 bg-red-500 text-white rounded-md hover:bg-red-600" @click="showTambah = false">Tutup</button>
        </div>
    </div>

    <!-- Modal Edit -->
    <div x-show="showEdit" x-transition @open-edit-modal.window="showEdit = true" class="fixed inset-0 z-50 flex justify-center items-center bg-black/50 backdrop-blur-sm px-4 overflow-auto" x-data>
        <div @click.away="showEdit = false" class="bg-white w-full max-w-2xl rounded-lg shadow-lg p-8 animate-scaleIn overflow-y-auto max-h-[80vh] space-y-6">
            <h3 class="text-2xl font-semibold text-center mb-4">Form Edit Santri</h3>
            <form id="editSiswaForm" class="space-y-4" enctype="multipart/form-data" @submit.prevent="submitEditSiswa">
                <input type="hidden" id="editId">
                <div>
                    <label class="block font-medium mb-1">Nama Santri:</label>
                    <input type="text" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="editNama" placeholder="Nama Santri" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Jenis Kelamin:</label>
                    <div class="flex gap-4">
                        <label><input type="radio" name="editJenisKelamin" value="L" required> Laki-laki</label>
                        <label><input type="radio" name="editJenisKelamin" value="P" required> Perempuan</label>
                    </div>
                </div>
                <div>
                    <label class="block font-medium mb-1">Tempat Lahir:</label>
                    <input type="text" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="editTempatLahir" placeholder="Tempat Lahir" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Tanggal Lahir:</label>
                    <input type="date" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="editTanggalLahir" required>
                </div>
                <div class="mb-8">
                    <label class="block font-medium mb-1">Upload Akta Kelahiran (PDF):</label>
                    <input type="file" class="w-full border rounded-md focus:ring focus:ring-emerald-300 mb-4" id="editAktaKelahiran" accept="application/pdf">
                    <label class="block font-medium mb-1">Akta Kelahiran Saat Ini</label>
                    <div id="currentEditAktaKelahiran" class="w-full border rounded bg-gray-100 p-4 text-gray-800 h-60 overflow-auto">
                        <iframe id="iframeEditAktaKelahiran" class="w-full h-full" frameborder="0"></iframe>
                        <a id="linkEditAktaKelahiran" href="#" target="_blank" class="text-blue-600 underline mt-2 block">Lihat Akta Kelahiran</a>
                    </div>
                </div>
                <div class="mb-8">
                    <label class="block font-medium mb-1">Upload Kartu Keluarga (PDF):</label>
                    <input type="file" class="w-full border rounded-md focus:ring focus:ring-emerald-300 mb-4" id="editKartuKeluarga" accept="application/pdf">
                    <label class="block font-medium mb-1">Kartu Keluarga Saat Ini</label>
                    <div id="currentEditKartuKeluarga" class="w-full border rounded bg-gray-100 p-4 text-gray-800 h-60 overflow-auto">
                        <iframe id="iframeEditKartuKeluarga" class="w-full h-full" frameborder="0"></iframe>
                        <a id="linkEditKartuKeluarga" href="#" target="_blank" class="text-blue-600 underline mt-2 block">Lihat Kartu Keluarga</a>
                    </div>
                </div>
                <div>
                    <label class="block font-medium mb-1">Nama Orang Tua:</label>
                    <input type="text" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="editNamaOrangTua" placeholder="Nama Orang Tua" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">No HP:</label>
                    <input type="text" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="editNoHp" placeholder="No Handphone" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Alamat:</label>
                    <textarea class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="editAlamat" placeholder="Alamat" required></textarea>
                </div>
                <button type="submit" class="w-full py-2 px-4 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">Simpan Perubahan</button>
            </form>
            <button class="w-full py-2 bg-red-500 text-white rounded-md hover:bg-red-600" @click="showEdit = false">Tutup</button>
        </div>
    </div>
</div>
@endsection

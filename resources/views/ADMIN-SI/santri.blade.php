@extends('layouts.app')

@section('content')
<div x-data="{ showTambah: false, showEdit: false }" class="p-6 bg-[#F8F9FD] min-h-screen">

    <!-- Title and Search -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-2 gap-4">
        <h1 class="text-2xl font-bold text-[#2B3674]">Santri</h1>
        <input type="text" id="searchNama" placeholder="Cari Nama Santri..." class="border rounded-lg px-4 py-3 text-base w-48" oninput="renderTable()">
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
            <h3 class="text-2xl font-bold">{{ $totalSantri ?? 0 }}</h3>
        </div>
    </div>

    <div class="flex justify-between mb-6">
        <!-- Filter & Sorting Controls -->
        <div class="bg-white p-2 rounded-xl flex items-center shadow gap-6 max-w-md">
            <select id="filterJenisKelamin" class="border rounded-lg px-3 py-2 text-base" onchange="renderTable()">
                <option value="">Semua Jenis Kelamin</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
            <select id="sortBy" class="border rounded-lg px-3 py-2 text-base" onchange="renderTable()">
                <option value="terbaru">Terbaru</option>
                <option value="terlama">Terlama</option>
                <option value="nama_asc">Nama (A-Z)</option>
                <option value="nama_desc">Nama (Z-A)</option>
            </select>
        </div>

        <!-- Tambah Santri Button -->
        <button @click="showTambah = true" class="bg-emerald-500 text-white px-4 py-3 text-lg rounded-lg shadow-md hover:bg-emerald-600 whitespace-nowrap">
            Tambah Santri Baru
        </button>
    </div>

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
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4 text-center">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-center">{{ $santri->nis }}</td>
                    <td class="px-6 py-4 text-center">{{ $santri->nama_santri }}</td>
                    <td class="px-6 py-4 text-center">
                        @php
                            $birthDate = \Carbon\Carbon::parse($santri->tanggal_lahir);
                            $age = $birthDate->age;
                        @endphp
                        {{ $age }} tahun
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $santri->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki' }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex flex-col md:flex-row gap-2 justify-center">
                            <button type="button" onclick="showDetail({{ $index }})" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">Detail</button>
                            <button type="button" onclick="showEdit({{ $index }})" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Edit</button>
                            <form method="POST" action="{{ url('/santri/' . $santri->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus santri ini?');" class="inline">
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

    <!-- Modal Detail -->
    <div id="modalDetail" class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-3xl p-8 overflow-y-auto max-h-[80vh] space-y-6">
            <h2 class="text-2xl font-bold text-center text-emerald-600 mb-4">Detail Santri</h2>
            <!-- Detail isi -->
            <template x-for="(field, label) in {
                'Nama Santri': 'detailNama',
                'Jenis Kelamin': 'detailJenisKelamin',
                'Usia': 'detailUsia',
                'Nama Orang Tua': 'detailNamaOrangTua',
                'Tempat Lahir': 'detailTempatLahir',
                'Tanggal Lahir': 'detailTanggalLahir',
                'No HP': 'detailNoHp',
                'Alamat': 'detailAlamat'
            }" :key="label">
                <div>
                    <label class="block font-medium text-gray-700 mb-1" x-text="label"></label>
                    <div :id="field" class="w-full border rounded px-4 py-2 bg-gray-100 text-gray-800"></div>
                </div>
            </template>

            <!-- Akta -->
            <div>
                <label class="block font-medium text-gray-700 mb-1">Akta Kelahiran</label>
                <div id="aktaPreviewContainer" class="w-full border rounded bg-gray-100 p-2 text-gray-800 flex flex-col h-[60vh]">
                    <iframe id="detailAktaKelahiran" class="w-full flex-grow hidden" frameborder="0"></iframe>
                    <a id="aktaLink" href="#" target="_blank" class="text-blue-600 underline mt-2">Lihat Akta Kelahiran</a>
                </div>
            </div>
            <!-- KK -->
            <div>
                <label class="block font-medium text-gray-700 mb-1">Kartu Keluarga</label>
                <div id="kkPreviewContainer" class="w-full border rounded bg-gray-100 p-2 text-gray-800 flex flex-col h-[60vh]">
                    <iframe id="detailKartuKeluarga" class="w-full flex-grow hidden" frameborder="0"></iframe>
                    <a id="kkLink" href="#" target="_blank" class="text-blue-600 underline mt-2">Lihat Kartu Keluarga</a>
                </div>
            </div>

            <button onclick="closeDetail()" class="mt-6 w-full py-2 bg-rose-500 hover:bg-rose-600 text-white rounded-lg">Tutup</button>
        </div>
    </div>
</div>

<script>
    const santris = @json($santris);

    document.addEventListener('DOMContentLoaded', () => {
        const today = new Date();

        const maxAge = 5;
        const minAge = 12;

        const maxDate = new Date(today.getFullYear() - maxAge, today.getMonth(), today.getDate());
        const minDate = new Date(today.getFullYear() - minAge, today.getMonth(), today.getDate());

        const formatDate = (date) => {
            const y = date.getFullYear();
            const m = String(date.getMonth() + 1).padStart(2, '0');
            const d = String(date.getDate()).padStart(2, '0');
            return `${y}-${m}-${d}`;
        };

        const tambahTanggalInput = document.getElementById('tambahTanggalLahir');
        if (tambahTanggalInput) {
            tambahTanggalInput.min = formatDate(minDate);
            tambahTanggalInput.max = formatDate(maxDate);
        }

        const editTanggalInput = document.getElementById('editTanggalLahir');
        if (editTanggalInput) {
            editTanggalInput.min = formatDate(minDate);
            editTanggalInput.max = formatDate(maxDate);
        }
    });

    function renderTable() {
        const searchInput = document.getElementById('searchNama').value.toLowerCase();
        const filterGender = document.getElementById('filterJenisKelamin').value;
        const sortBy = document.getElementById('sortBy').value;

        const table = document.getElementById('santriTable');
        const rows = Array.from(table.getElementsByTagName('tbody')[0].getElementsByTagName('tr'));

        // Filter rows
        let filteredRows = rows.filter(row => {
            const nameCell = row.getElementsByTagName('td')[2];
            const genderCell = row.getElementsByTagName('td')[4];
            const name = nameCell.textContent.toLowerCase();
            const gender = genderCell.textContent.toLowerCase();

            const matchesName = name.includes(searchInput);
            const matchesGender = filterGender === '' || (filterGender.toLowerCase() === 'l' && gender === 'laki-laki') || (filterGender.toLowerCase() === 'p' && gender === 'perempuan');

            return matchesName && matchesGender;
        });

        // Sort rows
        filteredRows.sort((a, b) => {
            if (sortBy === 'nama_asc') {
                return a.getElementsByTagName('td')[2].textContent.localeCompare(b.getElementsByTagName('td')[2].textContent);
            } else if (sortBy === 'nama_desc') {
                return b.getElementsByTagName('td')[2].textContent.localeCompare(a.getElementsByTagName('td')[2].textContent);
            } else if (sortBy === 'terbaru') {
                // Assuming the latest santri are at the end, so reverse order
                return b.rowIndex - a.rowIndex;
            } else if (sortBy === 'terlama') {
                return a.rowIndex - b.rowIndex;
            }
            return 0;
        });

        // Clear table body and append filtered and sorted rows
        const tbody = table.getElementsByTagName('tbody')[0];
        tbody.innerHTML = '';
        filteredRows.forEach(row => tbody.appendChild(row));

        // Update total santri count
        const totalSantriCountElem = document.getElementById('totalSantriCount');
        if (totalSantriCountElem) {
            totalSantriCountElem.textContent = filteredRows.length;
        }
    }

    // The rest of the JS functions remain unchanged (showDetail, showEdit, submitEditSiswa, etc.)
</script>
@endsection

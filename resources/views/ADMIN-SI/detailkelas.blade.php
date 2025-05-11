@extends('layouts.app')

@section('content')
<div x-data="{ showTambah: false }" class="p-6 bg-[#F8F9FD] min-h-screen">

    <!-- Title and Search -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-2 gap-4">
        <h1 class="text-2xl font-bold text-[#2B3674]">Kelas: {{ $kelas->kelas }}</h1>
        <input type="text" id="searchSantri" placeholder="Cari Nama Santri..." class="border rounded-lg px-4 py-3 text-base w-48" oninput="filterAndSortSantri()">
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

    <div class="flex justify-between mb-6">
        <!-- Filter & Sorting Controls -->
        <div class="bg-white p-2 rounded-xl flex items-center shadow gap-6 max-w-md">
            <select id="filterJenisKelamin" class="border rounded-lg px-4 py-3 text-base" onchange="filterAndSortSantri()">
                <option value="">Semua Jenis Kelamin</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
            <select id="sortBy" class="border rounded-lg px-4 py-3 text-base" onchange="filterAndSortSantri()">
                <option value="terbaru">Terbaru</option>
                <option value="terlama">Terlama</option>
                <option value="nama_asc">Nama (A-Z)</option>
                <option value="nama_desc">Nama (Z-A)</option>
            </select>
        </div>

        <!-- Add and Delete Buttons -->
        <div class="flex items-center gap-4">
            <form method="POST" action="{{ route('kelas.hapusSemuaSantri', ['kelasId' => $kelas->id]) }}" onsubmit="return confirm('Yakin ingin menghapus semua santri dari kelas ini?');">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 whitespace-nowrap">Hapus Semua</button>
            </form>
            <button @click="showTambah = true" class="bg-emerald-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-emerald-600 whitespace-nowrap">
                Tambah
            </button>
        </div>
    </div>

    <!-- Modal Add Santri -->
    <div x-show="showTambah" x-transition class="fixed inset-0 z-50 flex justify-center items-center bg-black/50 backdrop-blur-sm px-4 overflow-auto">
        <div @click.away="showTambah = false" class="bg-white w-full max-w-2xl rounded-lg shadow-lg p-8 animate-scaleIn overflow-y-auto max-h-[80vh] space-y-6">
            <h3 class="text-2xl font-semibold text-center mb-4">Tambah Santri ke Kelas</h3>
            <form method="POST" action="{{ route('kelas.tambahSantri', ['id' => $kelas->id]) }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-96 overflow-y-auto border p-4 rounded">
                    @forelse ($santriNullKelas as $santri)
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="santri_ids[]" value="{{ $santri->id }}" class="form-checkbox">
                        <span>{{ $santri->nama_santri }} (NIS: {{ $santri->nis }})</span>
                    </label>
                    @empty
                    <p class="whitespace-nowrap">Tidak ada santri yang belum memiliki kelas.</p>
                    @endforelse
                </div>
                <div class="mt-4 flex justify-between">
                    @if($santriNullKelas->isNotEmpty())
                        <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded hover:bg-emerald-600">Konfirmasi</button>
                    @endif
                    <button type="button" @click="showTambah = false" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Santri Table -->
    <div class="bg-white rounded-md overflow-x-auto shadow-md">
        <table class="w-full text-sm text-left border-collapse" id="santriTable">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-center text-gray-600 whitespace-nowrap">No</th>
                    <th class="px-6 py-3 text-center text-gray-600 whitespace-nowrap">NIS</th>
                    <th class="px-6 py-3 text-center text-gray-600 whitespace-nowrap">Nama Santri</th>
                    <th class="px-6 py-3 text-center text-gray-600 whitespace-nowrap">Umur</th>
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
                    <td class="px-6 py-4 text-center">{{ $santri->umur }}</td>
                    <td class="px-6 py-4 text-center">
                        @if(strtolower($santri->jenis_kelamin) == 'l')
                            Laki-laki
                        @elseif(strtolower($santri->jenis_kelamin) == 'p')
                            Perempuan
                        @else
                            {{ $santri->jenis_kelamin }}
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <form method="POST" action="{{ route('kelas.hapusSantri', ['kelasId' => $kelas->id, 'santriId' => $santri->id]) }}" onsubmit="return confirm('Yakin ingin menghapus santri ini dari kelas?');">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<script>
    function filterAndSortSantri() {
        const searchInput = document.getElementById('searchSantri').value.toLowerCase();
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
        document.getElementById('totalSantriCount').textContent = filteredRows.length;
    }
</script>
@endsection

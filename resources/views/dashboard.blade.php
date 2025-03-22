@extends('layouts.app')

@section('content')
<div class="p-6 bg-[#F8F9FD]">
    <!-- Wrapper -->
    <div class="flex flex-col mb-8">

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <h1 class="text-2xl font-bold text-[#2B3674]">Dashboard</h1>
            <div class="flex items-center gap-3 w-full md:w-auto">

                <!-- Search Bar -->
                <form action="{{ route('search') }}" method="GET" class="relative flex-1 md:flex-none w-full md:w-64">
                    <input type="text" name="query" placeholder="Search Siswa Baru..."
                        class="w-full pl-10 pr-4 py-2 text-gray-500 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                </form>

                <!-- Notifikasi -->
                <div x-data="{ showModal: false, notifications: [{ id: 1, message: 'Siswa baru telah ditambahkan.', time: '2 menit yang lalu' }, { id: 2, message: 'Pendaftaran ditutup.', time: '5 menit yang lalu' }] }" class="relative">
                    <button @click="showModal = true" class="text-gray-600 focus:outline-none relative">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.002 2.002 0 0018 14V10a6 6 0 00-12 0v4c0 .795-.316 1.513-.832 2.005L3 17h5"/>
                        </svg>
                        <span x-show="notifications.length > 0" class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full px-1">
                            <span x-text="notifications.length"></span>
                        </span>
                    </button>

                    <!-- Modal Popup -->
                    <div x-show="showModal" x-transition class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 px-4">
                        <div class="bg-white w-full max-w-2xl rounded-lg shadow-lg">
                            <!-- Modal Header -->
                            <div class="flex justify-between items-center px-6 py-4 border-b">
                                <h3 class="text-lg font-semibold">Notifikasi</h3>
                                <button @click="showModal = false" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                            </div>

                            <!-- Modal Body -->
                            <div class="p-6 overflow-x-auto max-h-80 overflow-y-auto">
                                <template x-if="notifications.length === 0">
                                    <p class="text-center text-gray-500">Tidak ada notifikasi baru.</p>
                                </template>
                                <template x-if="notifications.length > 0">
                                    <table class="min-w-full text-left text-sm text-gray-600">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="px-4 py-2">Pesan</th>
                                                <th class="px-4 py-2">Waktu</th>
                                                <th class="px-4 py-2 text-right">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="notification in notifications" :key="notification.id">
                                                <tr class="hover:bg-gray-50 border-b">
                                                    <td class="px-4 py-2" x-text="notification.message"></td>
                                                    <td class="px-4 py-2 text-xs" x-text="notification.time"></td>
                                                    <td class="px-4 py-2 text-right">
                                                        <button @click.stop="notifications = notifications.filter(n => n.id !== notification.id)" class="text-red-500 hover:underline text-xs">Hapus</button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </template>
                            </div>
                            <!-- Modal Footer -->
                            <div class="flex justify-end px-6 py-4 border-t">
                                <button @click="showModal = false" class="bg-emerald-500 text-white px-4 py-2 rounded hover:bg-emerald-600">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile -->
                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 font-medium">
                    HF
                </div>
            </div>
        </div>
    </div>

    <!-- Wrapper Alpine -->
    <div x-data="{ showTambah: false }" class="mb-8">

        <!-- Tombol Tambah -->
        <div class="flex justify-end">
            <button @click="showTambah = true" class="bg-emerald-500 text-white px-4 py-2 rounded-lg flex items-center gap-2 shadow-md hover:bg-emerald-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Siswa Baru
            </button>
        </div>

        <!-- Modal Tambah Siswa -->
        <div x-show="showTambah" x-transition class="fixed inset-0 z-20 flex justify-center items-center bg-black bg-opacity-50 px-4">
            <div @click.away="showTambah = false" class="bg-white p-6 rounded-md w-full max-w-md shadow-lg">
                <h3 class="text-2xl font-semibold mb-4 text-center">Form Tambah Siswa Baru</h3>
                <form id="tambahSiswaForm" class="space-y-4">
                    <!-- Nama -->
                    <div>
                        <label class="block mb-1 font-medium">Nama:</label>
                        <input type="text" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="tambahNama" placeholder="Nama Siswa">
                    </div>

                    <!-- Sekolah -->
                    <div>
                        <label class="block mb-1 font-medium">Sekolah:</label>
                        <input type="text" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="tambahSekolah" placeholder="Sekolah Asal">
                    </div>

                    <!-- Usia -->
                    <div>
                        <label class="block mb-1 font-medium">Usia:</label>
                        <input type="number" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="tambahUsia" placeholder="Usia">
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block mb-1 font-medium">Status:</label>
                        <select class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="tambahStatus">
                            <option value="">Pilih Status</option>
                            <option value="Diterima">Diterima</option>
                            <option value="Menunggu">Menunggu</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>

                    <!-- Tombol Simpan -->
                    <button type="button" class="w-full py-2 px-4 bg-emerald-500 text-white rounded-md hover:bg-emerald-600" onclick="saveTambahSiswa()">Simpan</button>
                </form>
                <!-- Tombol Tutup -->
                <button class="mt-4 w-full py-2 bg-red-500 text-white rounded-md hover:bg-red-600" @click="showTambah = false">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Pendaftar -->
        <div class="bg-white p-6 rounded-xl flex items-center gap-4">
            <div class="bg-emerald-100 p-4 rounded-full">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-gray-500">Total Pendaftar</p>
                <h3 class="text-2xl font-bold">128</h3>
            </div>
        </div>

        <!-- Diterima -->
        <div class="bg-white p-6 rounded-xl flex items-center gap-4">
            <div class="bg-green-100 p-4 rounded-full">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-gray-500">Diterima</p>
                <h3 class="text-2xl font-bold">72</h3>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-white p-6 rounded-xl flex items-center gap-4">
            <div class="bg-yellow-100 p-4 rounded-full">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-gray-500">Pending</p>
                <h3 class="text-2xl font-bold">45</h3>
            </div>
        </div>

        <!-- Ditolak -->
        <div class="bg-white p-6 rounded-xl flex items-center gap-4">
            <div class="bg-red-100 p-4 rounded-full">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-gray-500">Ditolak</p>
                <h3 class="text-2xl font-bold">11</h3>
            </div>
        </div>
    </div>

    <!-- Filter & Sorting Section -->
    <div class="bg-white p-6 rounded-md mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <!-- Filter Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status Pendaftaran</label>
                <select class="w-full border rounded-lg px-3 py-2">
                    <option value="">Semua Status</option>
                    <option value="diterima">Diterima</option>
                    <option value="pending">Pending</option>
                    <option value="ditolak">Ditolak</option>
                </select>
            </div>

            <!-- Filter Sekolah -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sekolah Asal</label>
                <select class="w-full border rounded-lg px-3 py-2">
                    <option value="">Semua Sekolah</option>
                    <option value="sdn">SD Negeri</option>
                    <option value="sds">SD Swasta</option>
                    <option value="mi">MI</option>
                </select>
            </div>

            <!-- Filter Usia -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rentang Usia</label>
                <select class="w-full border rounded-lg px-3 py-2">
                    <option value="">Semua Usia</option>
                    <option value="11-12">11-12 tahun</option>
                    <option value="13-14">13-14 tahun</option>
                    <option value="15">15+ tahun</option>
                </select>
            </div>

            <!-- Sorting -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Urutkan</label>
                <select class="w-full border rounded-lg px-3 py-2">
                    <option value="terbaru">Terbaru</option>
                    <option value="terlama">Terlama</option>
                    <option value="nama_asc">Nama (A-Z)</option>
                    <option value="nama_desc">Nama (Z-A)</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modal" class="hidden fixed inset-0 z-10 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-md w-full max-w-md">
            <h3 id="modalTitle" class="text-2xl font-semibold mb-4">Form Edit Siswa</h3>
            <div id="modalContent"></div>
            <button class="mt-4 px-4 py-2 bg-red-500 text-white rounded-md" onclick="closeModal()">Tutup</button>
        </div>
    </div>

    <!-- Modal Detail -->
    <div id="detailModal" class="hidden fixed inset-0 z-10 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white p-8 rounded-lg w-full max-w-lg space-y-6 shadow-lg">
            <h3 class="text-2xl font-semibold text-center text-[#2B3674] mb-4">Detail Siswa</h3>
            <div class="space-y-4">
                <div class="flex justify-between">
                    <span class="font-medium text-gray-700">Nama:</span>
                    <span class="text-lg text-gray-900" id="detailNama">Budi Santoso</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-700">Sekolah:</span>
                    <span class="text-lg text-gray-900" id="detailSekolah">SMA 1 Jakarta</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-700">Usia:</span>
                    <span class="text-lg text-gray-900" id="detailUsia">17 Tahun</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-700">Status:</span>
                    <span class="text-lg text-gray-900" id="detailStatus">Diterima</span>
                </div>
            </div>
            <div class="flex justify-center gap-4 mt-6">
                <button onclick="closeDetailModal()" class="px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="container mx-auto mt-8">
        <h1 class="text-1xl font-semibold text-center mb-4">Data Siswa</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-md">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm text-gray-600">No</th>
                        <th class="px-6 py-3 text-left text-sm text-gray-600">Nama</th>
                        <th class="px-6 py-3 text-left text-sm text-gray-600">Sekolah</th>
                        <th class="px-6 py-3 text-left text-sm text-gray-600">Usia</th>
                        <th class="px-6 py-3 text-left text-sm text-gray-600">Status</th>
                        <th class="px-6 py-3 text-left text-sm text-gray-600 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="siswaTable">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.js"></script>
<script>
    // Data siswa
    let siswa = [
        { nama: "Budi Santoso", sekolah: "SMA 1 Jakarta", usia: 17, status: "Diterima" },
        { nama: "Rina Putri", sekolah: "SMA 2 Bandung", usia: 16, status: "Menunggu" },
        { nama: "Andi Wijaya", sekolah: "SMA 3 Surabaya", usia: 18, status: "Ditolak" },
    ];

    // Render tabel
    function renderTable() {
        let tableBody = document.getElementById('siswaTable');
        tableBody.innerHTML = '';  // Mengosongkan tabel sebelum di-render ulang

        siswa.forEach((data, index) => {
            tableBody.innerHTML += `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-500">${index + 1}</td>
                    <td class="px-6 py-4 break-words">${data.nama}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">${data.sekolah}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">${data.usia} tahun</td>
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
                            data.status === "Diterima" ? "bg-green-100 text-green-800" :
                            data.status === "Menunggu" ? "bg-yellow-100 text-yellow-800" :
                            "bg-red-100 text-red-800"
                        }">${data.status}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <button onclick="openEdit(${index})" class="flex-1 px-3 py-1 bg-yellow-400 text-white rounded-md text-sm">Edit</button>
                            <button onclick="deleteSiswa(${index})" class="flex-1 px-3 py-1 bg-red-500 text-white rounded-md text-sm">Hapus</button>
                            <button onclick="viewDetail(${index})" class="flex-1 px-3 py-1 bg-emerald-500 text-white rounded-md text-sm">Detail</button>
                        </div>
                    </td>
                </tr>
            `;
        });
    }

    // Fungsi untuk membuka modal edit
    function openEdit(index) {
        let student = siswa[index];

        let content = `
            <form>
                <label class="block">Nama:</label>
                <input type="text" class="w-full mb-4 p-2 border rounded-md" value="${student.nama}" id="editNama">
                <label class="block">Sekolah:</label>
                <input type="text" class="w-full mb-4 p-2 border rounded-md" value="${student.sekolah}" id="editSekolah">
                <label class="block">Usia:</label>
                <input type="number" class="w-full mb-4 p-2 border rounded-md" value="${student.usia}" id="editUsia">
                <label class="block">Status:</label>
                <select class="w-full mb-4 p-2 border rounded-md" id="editStatus">
                    <option value="Diterima" ${student.status === "Diterima" ? "selected" : ""}>Diterima</option>
                    <option value="Menunggu" ${student.status === "Menunggu" ? "selected" : ""}>Menunggu</option>
                    <option value="Ditolak" ${student.status === "Ditolak" ? "selected" : ""}>Ditolak</option>
                </select>
                <button type="button" class="w-full py-2 px-4 bg-yellow-500 text-white rounded-md" onclick="saveEdit(${index})">Simpan</button>
            </form>
        `;
        openModal('Edit Siswa', content);
    }

    // Fungsi untuk menyimpan hasil edit
    function saveEdit(index) {
        let updatedNama = document.getElementById('editNama').value;
        let updatedSekolah = document.getElementById('editSekolah').value;
        let updatedUsia = document.getElementById('editUsia').value;
        let updatedStatus = document.getElementById('editStatus').value;

        siswa[index] = { nama: updatedNama, sekolah: updatedSekolah, usia: updatedUsia, status: updatedStatus };
        renderTable();
        closeModal();
    }

    // Fungsi untuk menghapus siswa
    function deleteSiswa(index) {
        siswa.splice(index, 1);
        renderTable();
    }

    // Modal Edit
    function openModal(title, content) {
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalContent').innerHTML = content;
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    // Modal Detail
    function viewDetail(index) {
        let student = siswa[index];

        document.getElementById('detailNama').innerText = student.nama;
        document.getElementById('detailSekolah').innerText = student.sekolah;
        document.getElementById('detailUsia').innerText = student.usia + " tahun";
        document.getElementById('detailStatus').innerText = student.status;

        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    // Render tabel pertama kali saat halaman dimuat
    renderTable();

    // Fungsi untuk menyimpan data siswa baru
    function saveTambahSiswa() {
        // Ambil data dari form
        let nama = document.getElementById('tambahNama').value;
        let sekolah = document.getElementById('tambahSekolah').value;
        let usia = document.getElementById('tambahUsia').value;
        let status = document.getElementById('tambahStatus').value;

        // Validasi sederhana (bisa ditambah dengan validasi lain)
        if (!nama || !sekolah || !usia || !status) {
            alert("Semua kolom harus diisi.");
            return;
        }

        // Menambah siswa baru ke array (bisa diganti dengan logic untuk menyimpan ke database)
        siswa.push({ nama, sekolah, usia, status });

        // Render ulang tabel
        renderTable();

        // Tutup modal
        closeTambahSiswaModal();

        // Reset form
        document.getElementById('tambahSiswaForm').reset();
    }
</script>
@endsection

@extends('layouts.app')

@section('content')
<style>
  @keyframes scaleIn {
    0% { transform: scale(0.9); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
  }

  .animate-scaleIn {
    animation: scaleIn 0.3s ease-out forwards;
  }
</style>

<script>
  // Hide content initially to prevent flicker
  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('mainContent').style.visibility = 'visible';
  });
</script>

<div id="mainContent" class="p-6 bg-[#F8F9FD]" style="visibility: hidden;">
    <!-- Wrapper -->
    <div class="flex flex-col mb-8">

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <h1 class="text-2xl font-bold text-[#2B3674]">Dashboard</h1>
            <div class="flex items-center gap-3 w-full md:w-auto">

                <!-- Search Bar -->
                <form onsubmit="event.preventDefault(); renderTable();" class="relative flex-1 md:flex-none w-full md:w-64">
                <input type="text" id="searchQuery" placeholder="Cari Santri Baru..."
                    class="w-full pl-10 pr-4 py-2 text-gray-500 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                </form>

                <!-- Notifikasi -->
<<<<<<< HEAD
<div x-data="{ showModal: false, notifications: [] }" x-init="notifications = JSON.parse('{{ addslashes(json_encode($notifications)) }}')" class="relative">
    <button @click="showModal = true" class="text-gray-600 focus:outline-none relative">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.002 2.002 0 0018 14V10a6 6 0 00-12 0v4c0 .795-.316 1.513-.832 2.005L3 17h5"/>
        </svg>
        <span x-show="notifications.length > 0" class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full px-1">
            <span x-text="notifications.length"></span>
        </span>
    </button>
=======
                <div x-data="{ showModal: false, notifications: [{ id: 1, message: 'Santri baru telah ditambahkan.', time: '2 menit yang lalu' }, { id: 2, message: 'Pendaftaran ditutup.', time: '5 menit yang lalu' }] }" class="relative">
                    <button @click="showModal = true" class="text-gray-600 focus:outline-none relative">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.002 2.002 0 0018 14V10a6 6 0 00-12 0v4c0 .795-.316 1.513-.832 2.005L3 17h5"/>
                        </svg>
                        <span x-show="notifications.length > 0" class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full px-1">
                            <span x-text="notifications.length"></span>
                        </span>
                    </button>
>>>>>>> 71b2eb0 (payment midtrans)

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
                                                    <td class="px-4 py-2" x-text="notification.data.message"></td>
                                                    <td class="px-4 py-2 text-xs" x-text="new Date(notification.created_at).toLocaleString()"></td>
                                                    <td class="px-4 py-2 text-right">
                                                        <button @click.stop="markAsRead(notification.id)" class="text-blue-500 hover:underline text-xs">Sudah Dibaca</button>
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

<script>
    function markAsRead(notificationId) {
        fetch('/admin/notifications/' + notificationId + '/read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                // Redirect to admin dashboard after marking as read
                window.location.href = '{{ route("dashboard") }}';
            } else {
                alert('Gagal menandai notifikasi sebagai sudah dibaca.');
            }
        }).catch(() => {
            alert('Terjadi kesalahan saat menghubungi server.');
        });
    }
</script>

                <!-- Profile -->
                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 font-medium">
                    HF
                </div>
            </div>
        </div>
    </div>

    <!-- Wrapper Alpine -->
    <div x-data="{ showTambah: false }">

        <!-- Tombol Tambah -->
        <div class="flex justify-end mb-6">
            <button @click="showTambah = true" class="bg-emerald-500 text-white px-4 py-2 rounded-lg flex items-center gap-2 shadow-md hover:bg-emerald-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Santri Baru
            </button>
        </div>

        <!-- Modal Tambah Santri -->
        <div x-show="showTambah" x-transition class="fixed inset-0 z-20 flex justify-center items-center bg-black/50 backdrop-blur-sm px-4">
    <div @click.away="showTambah = false" class="bg-white p-6 rounded-md w-full max-w-md shadow-lg">
        <h3 class="text-2xl font-semibold mb-4 text-center">Form Tambah Santri Baru</h3>
        <form id="tambahSiswaForm" class="space-y-4">
            <!-- Nama -->
            <div>
                <label class="block mb-1 font-medium">Nama:</label>
                <input type="text" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="tambahNama" placeholder="Nama Santri">
            </div>

            <!-- Jenis Kelamin -->
            <div>
                <label class="block mb-1 font-medium">Jenis Kelamin:</label>
                <input type="text" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="tambahJenisKelamin" placeholder="Jenis Kelamin">
            </div>

            <!-- Usia -->
            <div>
                <label class="block mb-1 font-medium">Usia:</label>
                <input type="number" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="tambahUsia" placeholder="Usia">
            </div>

            <!-- Orang Tua -->
            <div>
                <label class="block mb-1 font-medium">Orang Tua:</label>
                <input type="number" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="tambahOrtu" placeholder="Usia">
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
                <h3 class="text-2xl font-bold">{{ $totalPendaftar }}</h3>
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
                <h3 class="text-2xl font-bold">{{ $diterimaCount }}</h3>
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
                <p class="text-gray-500">Menunggu</p>
                <h3 class="text-2xl font-bold">{{ $menungguCount }}</h3>
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
                <h3 class="text-2xl font-bold">{{ $ditolakCount }}</h3>
            </div>
        </div>
    </div>

    <!-- Filter & Sorting Section -->
    <div class="bg-white p-6 rounded-md mb-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <!-- Filter Status -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status Pendaftaran</label>
            <select id="filterStatus" onchange="renderTable()" class="w-full border rounded-lg px-3 py-2">
                <option value="">Semua Status</option>
                <option value="Diterima">Diterima</option>
                <option value="Menunggu">Menunggu</option>
                <option value="Ditolak">Ditolak</option>
            </select>
        </div>

        <!-- Filter Usia -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Rentang Usia</label>
            <select id="filterUsia" onchange="renderTable()" class="w-full border rounded-lg px-3 py-2">
                <option value="">Semua Usia</option>
                <option value="11-12">11-12 tahun</option>
                <option value="13-14">13-14 tahun</option>
                <option value="15+">15+ tahun</option>
            </select>
        </div>

        <!-- Sorting -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Urutkan</label>
            <select id="sortBy" onchange="renderTable()" class="w-full border rounded-lg px-3 py-2">
                <option value="terbaru">Terbaru</option>
                <option value="terlama">Terlama</option>
                <option value="nama_asc">Nama (A-Z)</option>
                <option value="nama_desc">Nama (Z-A)</option>
            </select>
        </div>

    </div>
</div>

<!-- Tailwind CSS styled table for dynamic rendering -->
<div class="container mx-auto mt-8 px-4">
  <div class="w-full overflow-x-auto rounded-md">
    <table class="min-w-full bg-white shadow-md text-sm">
      <thead class="bg-gray-200">
      <tr>
        <th class="px-6 py-3 text-center text-gray-600 whitespace-">No</th>
        <th class="px-6 py-3 text-center text-gray-600 whitespace-">Nama Santri</th>
        <th class="px-6 py-3 text-center text-gray-600 whitespace-">Jenis Kelamin</th>
        <th class="px-6 py-3 text-center text-gray-600 whitespace-">Usia</th>
        <th class="px-6 py-3 text-center text-gray-600 whitespace-">Orang Tua</th>
        <th class="px-6 py-3 text-center text-gray-600 whitespace-">Status</th>
        <th class="px-6 py-3 text-center text-gray-600 whitespace-">Aksi</th>
      </tr>
    </thead>
    <tbody id="siswaTable">
      <!-- Rows will be dynamically rendered here by JavaScript -->
    </tbody>
  </table>
  </div>
</div>

<!-- Modal Detail -->
<div id="modalDetail" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center transition-opacity duration-300 px-4">
  <div class="bg-white rounded-xl shadow-xl w-full max-w-3xl p-8 animate-scaleIn overflow-y-auto max-h-[80vh] space-y-6">
    <h2 class="text-2xl font-bold text-center text-emerald-600 mb-4">Detail Santri</h2>
    <div>
      <label class="block font-medium text-gray-700 mb-1">Nama Santri</label>
      <div id="detailNama" class="w-full border rounded px-4 py-2 bg-gray-100 text-gray-800"></div>
    </div>
    <div>
      <label class="block font-medium text-gray-700 mb-1">Jenis Kelamin</label>
      <div id="detailJenisKelamin" class="w-full border rounded px-4 py-2 bg-gray-100 text-gray-800"></div>
    </div>
    <div>
      <label class="block font-medium text-gray-700 mb-1">Usia</label>
      <div id="detailUsia" class="w-full border rounded px-4 py-2 bg-gray-100 text-gray-800"></div>
    </div>
    <div>
      <label class="block font-medium text-gray-700 mb-1">Nama Orang Tua</label>
      <div id="detailNamaOrangTua" class="w-full border rounded px-4 py-2 bg-gray-100 text-gray-800"></div>
    </div>
    <div>
      <label class="block font-medium text-gray-700 mb-1">Tempat Lahir</label>
      <div id="detailTempatLahir" class="w-full border rounded px-4 py-2 bg-gray-100 text-gray-800"></div>
    </div>
    <div>
      <label class="block font-medium text-gray-700 mb-1">Tanggal Lahir</label>
      <div id="detailTanggalLahir" class="w-full border rounded px-4 py-2 bg-gray-100 text-gray-800"></div>
    </div>
    <div>
      <label class="block font-medium text-gray-700 mb-1">No HP</label>
      <div id="detailNoHp" class="w-full border rounded px-4 py-2 bg-gray-100 text-gray-800"></div>
    </div>
    <div>
      <label class="block font-medium text-gray-700 mb-1">Alamat</label>
      <div id="detailAlamat" class="w-full border rounded px-4 py-2 bg-gray-100 text-gray-800"></div>
    </div>
    <div>
      <label class="block font-medium text-gray-700 mb-1">Akta Kelahiran</label>
    <div id="aktaPreviewContainer" class="w-full border rounded bg-gray-100 p-2 text-gray-800 flex flex-col" style="height: 60vh;">
      <iframe id="detailAktaKelahiran" class="w-full flex-grow" style="display: none;" frameborder="0"></iframe>
      <a id="aktaLink" href="#" target="_blank" class="text-blue-600 underline mt-2">Lihat Akta Kelahiran</a>
    </div>
  </div>
    <div>
  <label class="block font-medium text-gray-700 mb-1">Kartu Keluarga</label>
    <div id="kkPreviewContainer" class="w-full border rounded bg-gray-100 p-2 text-gray-800 flex flex-col" style="height: 60vh;">
      <iframe id="detailKartuKeluarga" class="w-full flex-grow" style="display: none;" frameborder="0"></iframe>
      <a id="kkLink" href="#" target="_blank" class="text-blue-600 underline mt-2">Lihat Kartu Keluarga</a>
    </div>
  </div>
    <button onclick="closeDetail()" class="mt-6 w-full py-2 bg-rose-500 hover:bg-rose-600 text-white rounded-lg">Tutup</button>
  </div>
</div>

<!-- Modal Diterima -->
<div id="modalApprove" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center transition-opacity duration-300 px-4">
  <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 animate-scaleIn">
    <h2 class="text-xl font-semibold text-center text-yellow-600 mb-4">Konfirmasi Diterima</h2>
    <input type="hidden" id="approveIndex">
    <p class="text-center text-gray-700 mb-6">Setujui status Santri <strong id="approveNama"></strong> menjadi <strong>Diterima</strong>?</p>
    <div class="flex gap-3 justify-center">
      <button onclick="confirmApprove()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">Ya, Setujui</button>
      <button onclick="closeApprove()" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-md">Batal</button>
    </div>
  </div>
</div>

<!-- Modal Hapus -->
<div id="modalHapus" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center transition-opacity duration-300 px-4">
  <div class="bg-white rounded-xl shadow-xl w-full max-w-sm p-6 animate-scaleIn text-center">
    <h2 class="text-2xl font-bold text-red-600 mb-2">Konfirmasi Hapus</h2>
    <p class="text-gray-700 mb-4" id="hapusNama"></p>
    <div class="flex flex-col sm:flex-row justify-center gap-4">
      <button onclick="confirmDelete()" class="flex-1 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">Ya, Hapus</button>
      <button onclick="closeHapus()" class="flex-1 bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg">Batal</button>
    </div>
  </div>
</div>

<!-- Modal Ditolak -->
<div id="modalDitolak" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center transition-opacity duration-300 px-4">
  <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 animate-scaleIn">
    <h2 class="text-xl font-semibold text-center text-red-600 mb-4">Konfirmasi Tolak</h2>
    <input type="hidden" id="ditolakIndex">
    <p class="text-center text-gray-700 mb-6">Tolak status Santri <strong id="ditolakNama"></strong>?</p>
    <div class="flex gap-3 justify-center">
      <button onclick="confirmDitolak()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">Ya, Tolak</button>
      <button onclick="closeDitolak()" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-md">Batal</button>
    </div>
  </div>
</div>

@if(session('error'))
    <div id="popup-error" class="popup-alert">
        {{ session('error') }}
    </div>
@endif

<style>
    .popup-alert {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #f44336; /* Merah untuk error */
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        z-index: 9999;
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
    }
</style>


<script>
setTimeout(() => {
        const popup = document.getElementById('popup-error');
        if (popup) {
            popup.style.opacity = '0';
            setTimeout(() => popup.remove(), 500);
        }
    }, 3000);

  let pendaftaran = @json($pendaftaran);

  let deleteIndex = null;

  function renderTable() {
    const filterStatus = document.getElementById("filterStatus").value;
    const filterUsia = document.getElementById("filterUsia").value;
    const sortBy = document.getElementById("sortBy").value;
    const searchQuery = document.getElementById("searchQuery").value.toLowerCase();

    let filtered = pendaftaran
      .map((s, idx) => ({ ...s, originalIndex: idx }))
      .filter(s => {
        if (filterStatus && s.status !== filterStatus) return false;
        if (filterUsia === "11-12" && !(s.usia >= 11 && s.usia <= 12)) return false;
        if (filterUsia === "13-14" && !(s.usia >= 13 && s.usia <= 14)) return false;
        if (filterUsia === "15+" && s.usia < 15) return false;
        if (!s.nama_santri.toLowerCase().includes(searchQuery)) return false;
        return true;
      });

    if (sortBy === "nama_asc") {
      filtered.sort((a, b) => a.nama_santri.localeCompare(b.nama_santri));
    } else if (sortBy === "nama_desc") {
      filtered.sort((a, b) => b.nama_santri.localeCompare(a.nama_santri));
    } else if (sortBy === "terbaru") {
      filtered.reverse();
    }

    const tbody = document.getElementById("siswaTable");
    tbody.innerHTML = "";

    if (filtered.length === 0) {
      tbody.innerHTML = `<tr><td colspan="6" class="text-center py-4 text-gray-500">Data tidak ditemukan</td></tr>`;
      return;
    }

    filtered.forEach(function(s, i) {
      var actionButtons = '<button onclick="showDetail(' + s.originalIndex + ')" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">Detail</button>';
      if (s.status !== "Ditolak" && s.status !== "Diterima") {
        actionButtons += '<button onclick="showApprove(' + s.originalIndex + ')" class="bg-emerald-500 text-white px-3 py-1 rounded text-sm">Diterima</button>';
        actionButtons += '<button onclick="showDitolak(' + s.originalIndex + ')" class="bg-red-600 text-white px-3 py-1 rounded text-sm">Ditolak</button>';
      }
      actionButtons += '<button onclick="deleteSiswa(' + s.originalIndex + ')" class="bg-red-500 text-white px-3 py-1 rounded text-sm">Hapus</button>';

      tbody.innerHTML += '<tr>' +
        '<td class="px-6 py-4">' + (i + 1) + '</td>' +
        '<td class="px-6 py-4">' + s.nama_santri + '</td>' +
        '<td class="px-6 py-4">' + s.jenis_kelamin + '</td>' +
        '<td class="px-6 py-4">' + s.usia + '</td>' +
        '<td class="px-6 py-4">' + s.nama_orang_tua + '</td>' +
        '<td class="px-6 py-4">' + s.status + '</td>' +
        '<td class="px-6 py-4">' +
          '<div class="flex flex-col md:flex-row gap-2 justify-center">' +
            actionButtons +
          '</div>' +
        '</td>' +
      '</tr>';
    });
  }

  function showDetail(i) {
    var s = pendaftaran[i];
    document.getElementById("detailNama").innerText = s.nama_santri;
    document.getElementById("detailJenisKelamin").innerText = s.jenis_kelamin;
    document.getElementById("detailUsia").innerText = s.usia;
    document.getElementById("detailNamaOrangTua").innerText = s.nama_orang_tua;
    document.getElementById("detailTempatLahir").innerText = s.tempat_lahir;
    document.getElementById("detailTanggalLahir").innerText = s.tanggal_lahir;
    document.getElementById("detailNoHp").innerText = s.no_hp;
    document.getElementById("detailAlamat").innerText = s.alamat;

    var aktaPath = '/gambar/akta_kelahiran/' + s.akta_kelahiran;
    var kkPath = '/gambar/kartu_keluarga/' + s.kartu_keluarga;

    var aktaIframe = document.getElementById("detailAktaKelahiran");
    var kkIframe = document.getElementById("detailKartuKeluarga");
    var aktaLink = document.getElementById("aktaLink");
    var kkLink = document.getElementById("kkLink");

    if (s.akta_kelahiran) {
      aktaIframe.style.display = "block";
      aktaIframe.src = aktaPath;
      aktaLink.href = aktaPath;
      aktaLink.style.display = "inline";
    } else {
      aktaIframe.style.display = "none";
      aktaLink.style.display = "none";
    }

    if (s.kartu_keluarga) {
      kkIframe.style.display = "block";
      kkIframe.src = kkPath;
      kkLink.href = kkPath;
      kkLink.style.display = "inline";
    } else {
      kkIframe.style.display = "none";
      kkLink.style.display = "none";
    }

    document.getElementById("modalDetail").classList.remove("hidden");
  }

  function closeDetail() {
    document.getElementById("modalDetail").classList.add("hidden");
  }

  function showApprove(i) {
    const s = pendaftaran[i];
    document.getElementById("approveIndex").value = i;
    document.getElementById("approveNama").innerText = s.nama_santri;
    document.getElementById("modalApprove").classList.remove("hidden");
  }

  function closeApprove() {
    document.getElementById("modalApprove").classList.add("hidden");
  }

  // New functions for Ditolak action
  function showDitolak(i) {
    const s = pendaftaran[i];
    document.getElementById("ditolakIndex").value = i;
    document.getElementById("ditolakNama").innerText = s.nama_santri;
    document.getElementById("modalDitolak").classList.remove("hidden");
  }

  function closeDitolak() {
    document.getElementById("modalDitolak").classList.add("hidden");
  }

  function showLoading() {
    document.getElementById('loadingOverlay').classList.remove('hidden');
  }

  function hideLoading() {
    document.getElementById('loadingOverlay').classList.add('hidden');
  }

  function confirmDitolak() {
    showLoading();
    const i = document.getElementById("ditolakIndex").value;
    const id = pendaftaran[i].id;

    fetch(`/admin/pendaftaran/${id}/reject`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ status: 'rejected' })
    })
    .then(response => {
      if (!response.ok) {
        hideLoading();
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      // pendaftaran[i].status = "Ditolak";
      closeDitolak();
      // renderTable();
      window.location.href = '{{ route("dashboard") }}';
    })
    .catch(error => {
      hideLoading();
      alert('Gagal mengubah status: ' + error.message);
    });
  }

  function confirmApprove() {
    showLoading();
    const i = document.getElementById("approveIndex").value;
    const id = pendaftaran[i].id;

    fetch(`/admin/pendaftaran/${id}/approve`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    })
    .then(response => {
      if (!response.ok) {
        hideLoading();
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      // pendaftaran[i].status = "Diterima";
      closeApprove();
      // renderTable();
      window.location.href = '{{ route("dashboard") }}';
    })
    .catch(error => {
      hideLoading();
      alert('Gagal mengubah status: ' + error.message);
    });
  }

  function deleteSiswa(i) {
    deleteIndex = i;
    document.getElementById("modalHapus").classList.remove("hidden");
  }

  function closeHapus() {
    document.getElementById("modalHapus").classList.add("hidden");
    deleteIndex = null;
  }

  function confirmDelete() {
    if (deleteIndex !== null) {
      showLoading();
      const id = pendaftaran[deleteIndex].id;
      fetch(`/admin/pendaftaran/${id}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      })
      .then(response => {
        if (!response.ok) {
          hideLoading();
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        // pendaftaran.splice(deleteIndex, 1);
        deleteIndex = null;
        // renderTable();
        // closeHapus();
        window.location.href = '{{ route("dashboard") }}';
      })
      .catch(error => {
        hideLoading();
        alert('Gagal menghapus data: ' + error.message);
      });
    }
  }

  document.addEventListener("DOMContentLoaded", renderTable);
</script>

<div id="loadingOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center z-50">
  <!-- Spinner Hijau -->
  <div class="w-16 h-16 border-4 border-green-500 border-t-transparent rounded-full animate-spin"></div>

  <!-- Tulisan Loading -->
  <p class="mt-4 text-white font-medium text-base animate-pulse">Memuat... Mohon tunggu</p>
</div>



<style>
  .loader {
    border-top-color: #22c55e;
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    to { transform: rotate(360deg); }
  }
</style>

@endsection

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

<div class="p-6 bg-[#F8F9FD]" x-data="siswaApp()">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-[#2B3674]">Data Santri</h1>
        <div class="flex gap-4">
            <input type="text" x-model="query" placeholder="Cari santri..." class="w-full pl-10 pr-4 py-2 text-gray-500 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    </div>
    
    <!-- Tabel -->
    <div class="bg-white rounded-md overflow-x-auto shadow">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">NIS</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <template x-for="(siswa, index) in filteredSiswaList" :key="siswa.id">
                    <tr class="hover:bg-gray-50 animate-scaleIn">
                        <td class="px-6 py-4 text-sm text-gray-500 text-center" x-text="index + 1"></td>
                        <td class="px-6 py-4 text-center" x-text="siswa.nama"></td>
                        <td class="px-6 py-4 text-center" x-text="siswa.email"></td>
                        <td class="px-6 py-4 text-center" x-text="siswa.nis"></td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2 justify-center">
                                <button @click="deleteSiswa(siswa.id)" class="px-3 py-1 bg-red-500 text-white rounded-md text-sm">Hapus</button>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
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
  function siswaApp() {
    return {
      query: '',
      siswaList: [
        { id: 1, nama: 'Ahmad Ramadhan',email: 'ahmad@gmail.com', nis: '12001' },
        { id: 2, nama: 'Siti Nurhaliza',email: 'siti@gmail.com', nis: '12002' },
        { id: 3, nama: 'Budi Santoso',email: 'budi@gmail.com', nis: '12003' },
        { id: 4, nama: 'Rina Amelia',email: 'rina@gmail.com', nis: '12004' },
        { id: 5, nama: 'Dewi Sartika', email: 'reni@gmail.com', nis: '12005' }
      ],
      get filteredSiswaList() {
        return this.siswaList.filter(s =>
          s.nama.toLowerCase().includes(this.query.toLowerCase())
        );
      },
      deleteSiswa(id) {
        if (confirm('Yakin ingin menghapus siswa ini?')) {
          this.siswaList = this.siswaList.filter(s => s.id !== id);
        }
      }
    };
  }
</script>
@endsection

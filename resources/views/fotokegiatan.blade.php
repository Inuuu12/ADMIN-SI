@extends('layouts.app')

@section('content')
<div x-data="{
    showModal: false,
    modalType: '',
    modalTitle: '',
    form: { id: '', judul: '', kategori: '', tanggal: '', gambar: '' },
    kegiatanList: [
        {id: 1, judul: 'Kegiatan Mengaji', kategori: 'Kegiatan Harian', tanggal: '2024-03-15', gambar: 'img/kegiatan/mengaji.jpeg'},
        {id: 2, judul: 'Gotong Royong', kategori: 'Kegiatan Sosial', tanggal: '2024-03-10', gambar: 'img/kegiatan/gotongroyong.jpeg'},
        {id: 3, judul: 'Senam Pagi', kategori: 'Kegiatan Olahraga', tanggal: '2024-03-05', gambar: 'img/kegiatan/senam.jpeg'}
    ],
    filteredKegiatan: [],
    selectedCategory: 'Semua Kategori',

    openModal(type, kegiatan = null) {
        this.modalType = type;
        this.form = kegiatan ? { ...kegiatan } : { id: '', judul: '', kategori: '', tanggal: '', gambar: '' };
        this.modalTitle = type === 'tambah' ? 'Tambah Kegiatan' :
                          type === 'edit' ? 'Edit Kegiatan' :
                          type === 'detail' ? 'Detail Kegiatan' : 'Konfirmasi Hapus';
        this.showModal = true;
    },
    closeModal() {
        this.showModal = false;
    },
    filterKegiatan() {
        if (this.selectedCategory === 'Semua Kategori') {
            this.filteredKegiatan = this.kegiatanList;
        } else {
            this.filteredKegiatan = this.kegiatanList.filter(kegiatan => kegiatan.kategori === this.selectedCategory);
        }
    },
    handleFileUpload(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                this.form.gambar = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    },
    simpanData() {
        if (this.modalType === 'tambah') {
            this.form.id = Date.now();
            this.kegiatanList.push({ ...this.form });
        } else if (this.modalType === 'edit') {
            const index = this.kegiatanList.findIndex(k => k.id === this.form.id);
            if (index !== -1) {
                this.kegiatanList[index] = { ...this.form };
            }
        }
        this.filterKegiatan();
        this.closeModal();
    }
}"
x-init="filterKegiatan()"
class="p-6 bg-[#F8F9FD]">

    <!-- Header -->
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-[#2B3674]">Foto Kegiatan</h1>
        <div class="flex items-center gap-4">
            <form action="#" method="GET" class="relative w-full max-w-xs">
                <input type="text" name="query" placeholder="Cari Kegiatan..."
                    class="w-full pl-10 pr-4 py-2 text-gray-500 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            </form>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 font-medium">
                    HF
                </div>
            </div>
        </div>
    </div>

    <!-- Kategori dan Tambah Button -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4">
        <div class="w-full sm:w-auto">
            <select x-model="selectedCategory" @change="filterKegiatan" class="border rounded-lg px-3 py-2 w-full sm:w-48 text-sm">
                <option value="Semua Kategori">Semua Kategori</option>
                <option value="Kegiatan Harian">Kegiatan Harian</option>
                <option value="Kegiatan Sosial">Kegiatan Sosial</option>
                <option value="Kegiatan Olahraga">Kegiatan Olahraga</option>
            </select>
        </div>
        <div class="w-full sm:w-auto flex justify-end">
            <button @click="openModal('tambah')" class="bg-emerald-500 text-white px-3 py-2 rounded-lg flex items-center gap-1 shadow-md hover:bg-emerald-600 text-sm w-full sm:w-auto justify-center sm:justify-start">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-md overflow-x-auto shadow-md">
        <table class="w-full text-sm text-left border-collapse min-w-max">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 text-center">No.</th>
                    <th class="px-4 py-3 text-center">Judul</th>
                    <th class="px-4 py-3 text-center">Kategori</th>
                    <th class="px-4 py-3 text-center">Tanggal</th>
                    <th class="px-4 py-3 text-center">Preview</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <template x-for="(kegiatan, index) in filteredKegiatan" :key="kegiatan.id">
                    <tr class="hover:bg-gray-50 text-center">
                        <td class="px-4 py-4 text-gray-500" x-text="index + 1"></td>
                        <td class="px-4 py-4" x-text="kegiatan.judul"></td>
                        <td class="px-4 py-4" x-text="kegiatan.kategori"></td>
                        <td class="px-4 py-4" x-text="kegiatan.tanggal"></td>
                        <td class="px-4 py-4">
                            <img :src="kegiatan.gambar" class="h-16 w-24 object-cover rounded-lg shadow-md">
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex justify-center gap-2">
                                <button @click="openModal('detail', kegiatan)" class="px-3 py-1 bg-blue-500 text-white rounded-md text-sm">Detail</button>
                                <button @click="openModal('edit', kegiatan)" class="px-3 py-1 bg-yellow-400 text-white rounded-md text-sm">Edit</button>
                                <button @click="openModal('hapus', kegiatan)" class="px-3 py-1 bg-red-500 text-white rounded-md text-sm">Hapus</button>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black/50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-xl font-bold mb-4" x-text="modalTitle"></h2>
            <template x-if="modalType !== 'hapus'">
                <div>
                    <label class="block text-sm font-medium">Judul</label>
                    <input type="text" class="border p-2 w-full mb-2 rounded-lg" x-model="form.judul" :readonly="modalType === 'detail'">

                    <label class="block text-sm font-medium">Kategori</label>
                    <input type="text" class="border p-2 w-full mb-2 rounded-lg" x-model="form.kategori" :readonly="modalType === 'detail'">

                    <label class="block text-sm font-medium">Tanggal</label>
                    <input type="date" class="border p-2 w-full mb-2 rounded-lg" x-model="form.tanggal" :readonly="modalType === 'detail'">

                    <template x-if="modalType === 'tambah' || modalType === 'edit'">
                        <div>
                            <label class="block text-sm font-medium">Gambar</label>
                            <input type="file" @change="e => handleFileUpload(e)" class="border p-2 w-full mb-2 rounded-lg">

                            <template x-if="form.gambar">
                                <img :src="form.gambar" class="w-full h-48 object-cover rounded-lg shadow-md mt-2">
                            </template>
                        </div>
                    </template>

                    <template x-if="modalType === 'detail'">
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Gambar</label>
                            <img :src="form.gambar" class="w-full h-48 object-cover rounded-lg shadow-md">
                        </div>
                    </template>
                </div>
            </template>
            <template x-if="modalType === 'hapus'">
                <p class="text-center text-gray-700">Apakah Anda yakin ingin menghapus kegiatan ini?</p>
            </template>

            <div class="flex justify-end gap-2 mt-4">
                <button @click="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Batal</button>
                <template x-if="modalType === 'hapus'">
                    <button @click="() => { kegiatanList = kegiatanList.filter(k => k.id !== form.id); filterKegiatan(); closeModal(); }" class="px-4 py-2 bg-red-500 text-white rounded-lg">Hapus</button>
                </template>
                <template x-if="modalType === 'tambah' || modalType === 'edit'">
                    <button @click="simpanData()" class="px-4 py-2 bg-emerald-500 text-white rounded-lg">Simpan</button>
                </template>
            </div>
        </div>
    </div>
</div>
@endsection

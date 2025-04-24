@extends('layouts.app')

@section('content')
<style>
  @keyframes scaleIn {
    0% { transform: scale(0.95); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
  }

  .animate-scaleIn {
    animation: scaleIn 0.3s ease-out forwards;
  }

  .guru-card {
    max-width: 420px;
    width: 100%;
    padding: 2rem;
    border-radius: 1.25rem;
    background-color: white;
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.06);
    display: flex;
    flex-direction: column;
    align-items: center;
    overflow: hidden;
  }

  .guru-card h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #2B3674;
    margin-bottom: 0.5rem;
  }

  .guru-card p {
    color: #4B5563;
    margin-bottom: 0.25rem;
  }
</style>

<div x-data="guruApp()" class="p-6 bg-[#F8F9FD] w-full min-h-screen flex flex-col">
  <!-- Header -->
  <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
    <h1 class="text-2xl font-bold text-[#2B3674]">Guru</h1>
    <div class="flex items-center gap-4">
      <div class="relative w-full max-w-xs">
        <input type="text" x-model="searchQuery" placeholder="Mencari guru..."
          class="w-full pl-10 pr-4 py-2 text-gray-500 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
          fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-4.35-4.35M17 10a7 7 0 1 0-7 7 7 7 0 0 0 7-7z" />
        </svg>
      </div>
    </div>
  </div>

  <!-- Add Guru -->
  <div class="mb-4 flex justify-end">
    <button @click="openModal('tambah')" class="bg-emerald-500 text-white px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-md hover:bg-emerald-600">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      Tambah Guru
    </button>
  </div>

  <!-- Guru Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
    <template x-for="guru in filteredgurus()" :key="guru.id">
      <div class="guru-card">
        <!-- Gambar -->
        <div class="w-full flex justify-center mb-4">
          <img :src="guru.gambar ? gambarBaseUrl + guru.gambar : defaultImageUrl" alt="guru Picture"
            class="w-24 h-24 rounded-full object-cover border-4 border-emerald-500">
        </div>

        <!-- Nama -->
        <div class="mt-4 flex gap-3 justify-center">
          <h3 x-text="guru.nama" class="text-left"></h3>
        </div>

        <!-- Konten align left -->
        <div class="w-full text-left px-2">
          <p><strong>NIP:</strong> <span x-text="guru.nip"></span></p>
          <p><strong>Jabatan:</strong> <span x-text="guru.jabatan"></span></p>
          <p><strong>Pengalaman:</strong> <span x-text="guru.pengalaman + ' tahun'"></span></p>
          <p><strong>Pendidikan:</strong> <span x-text="guru.pendidikan_terakhir"></span></p>
          <p><strong>Mata Pelajaran:</strong> <span x-text="guru.mata_pelajaran"></span></p>
        </div>

        <!-- Tombol di tengah -->
        <div class="mt-4 flex gap-3 justify-center">
          <button @click="openModal('edit', guru)" class="px-5 py-2 bg-yellow-400 text-white rounded-md text-sm">Edit</button>
          <button type="button" @click="openDeleteModal(guru)"
            class="px-5 py-2 bg-red-500 text-white rounded-md text-sm">Delete</button>
        </div>
      </div>
    </template>
  </div>

  <!-- Modal -->
  <div x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md animate-scaleIn max-h-[80vh] overflow-y-auto">
      <h2 class="text-xl font-bold mb-4 text-gray-700" x-text="modalTitle"></h2>

      <form :action="form.id ? `/guru/${form.id}` : '{{ route('guru.store') }}'" method="POST" enctype="multipart/form-data" x-ref="modalForm" novalidate>
        @csrf
        <template x-if="form.id">
          <input type="hidden" name="_method" value="PUT" />
        </template>

        <!-- Nama -->
        <label class="block text-sm font-medium">Nama</label>
        <input type="text" name="nama" x-model="form.nama" :class="{'mb-4': !showModal || !errors.nama, 'mb-1': showModal && errors.nama}" class="border p-2 w-full rounded-lg">
        @error('nama')
          <div class="text-red-500 text-sm mt-0.5 mb-4">{{ $message }}</div>
        @enderror

        <!-- NIP -->
        <label class="block text-sm font-medium">NIP</label>
        <input type="text" name="nip" x-model="form.nip" :class="{'mb-4': !showModal || !errors.nip, 'mb-1': showModal && errors.nip}" class="border p-2 w-full rounded-lg" >
        @error('nip')
          <div class="text-red-500 text-sm mt-0.5 mb-4">{{ $message }}</div>
        @enderror

        <!-- Jabatan -->
        <label class="block text-sm font-medium">Jabatan</label>
        <input type="text" name="jabatan" x-model="form.jabatan" :class="{'mb-4': !showModal || !errors.jabatan, 'mb-1': showModal && errors.jabatan}" class="border p-2 w-full rounded-lg" >
        @error('jabatan')
          <div class="text-red-500 text-sm mt-0.5 mb-4">{{ $message }}</div>
        @enderror

        <!-- Pengalaman -->
        <label class="block text-sm font-medium">Pengalaman (tahun)</label>
        <input type="number" name="pengalaman" x-model="form.pengalaman" min="0" step="1" @input="sanitizePengalamanInput()" :class="{'mb-4': !showModal || !errors.pengalaman, 'mb-1': showModal && errors.pengalaman}" class="border p-2 w-full rounded-lg" >
        @error('pengalaman')
          <div class="text-red-500 text-sm mt-0.5 mb-4">{{ $message }}</div>
        @enderror

        <!-- Pendidikan Terakhir -->
        <label class="block text-sm font-medium">Pendidikan Terakhir</label>
        <input type="text" name="pendidikan_terakhir" x-model="form.pendidikan_terakhir" :class="{'mb-4': !showModal || !errors.pendidikan_terakhir, 'mb-1': showModal && errors.pendidikan_terakhir}" class="border p-2 w-full rounded-lg">
        @error('pendidikan_terakhir')
          <div class="text-red-500 text-sm mt-0.5 mb-4">{{ $message }}</div>
        @enderror

        <!-- Mata Pelajaran -->
        <label class="block text-sm font-medium">Mata Pelajaran</label>
        <input type="text" name="mata_pelajaran" x-model="form.mata_pelajaran" :class="{'mb-4': !showModal || !errors.mata_pelajaran, 'mb-1': showModal && errors.mata_pelajaran}" class="border p-2 w-full rounded-lg" required>
        @error('mata_pelajaran')
          <div class="text-red-500 text-sm mt-0.5 mb-4">{{ $message }}</div>
        @enderror

        <!-- Gambar -->
        <label class="block text-sm font-medium">Gambar</label>
        <input type="file" name="gambar" accept="image/*" class="border p-2 w-full mb-0.5 rounded-lg">
        @error('gambar')
          <div class="text-red-500 text-sm mt-0.5 mb-4">{{ $message }}</div>
        @enderror

        <div class="flex justify-end gap-2 mt-4">
          <button type="button" @click="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Cancel</button>
          <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded-lg">Save</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div x-show="showDeleteModal" x-transition.opacity class="fixed inset-0 z-50 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm animate-scaleIn text-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-red-500 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
      <h3 class="text-lg font-semibold text-gray-800 mb-2">Apakah kamu yakin?</h3>
      <p class="text-sm text-gray-600 mb-4">Tindakan ini akan menghapus data guru secara permanen.</p>

      <div class="flex justify-center gap-3 mt-4">
        <button @click="showDeleteModal = false" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>
        <form :action="`/guru/${guruToDelete.id}`" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  const gambarBaseUrl = '{{ asset('gambar') }}/';
  const defaultImageUrl = '{{ asset('img/dashboard/teacher.png') }}';

  function guruApp() {
    return {
      showModal: {{ $errors->any() ? 'true' : 'false' }},
      showDeleteModal: false,
      modalTitle: '{{ $errors->any() ? (old('id') ? "Edit Guru" : "Tambah Guru") : "" }}',
      form: {
        id: {{ old('id') ? old('id') : 'null' }},
        nama: {!! json_encode(old('nama', '')) !!},
        nip: {!! json_encode(old('nip', '')) !!},
        jabatan: {!! json_encode(old('jabatan', '')) !!},
        pengalaman: {!! json_encode(old('pengalaman', '')) !!},
        pendidikan_terakhir: {!! json_encode(old('pendidikan_terakhir', '')) !!},
        mata_pelajaran: {!! json_encode(old('mata_pelajaran', '')) !!},
        gambar: null
      },
      guruToDelete: {},
      searchQuery: '',
      gurus: @json($gurus), // Menambahkan data gurus ke dalam state

      openModal(mode, guru = null) {
        if (mode === 'edit') {
          this.modalTitle = 'Edit Guru';
          this.form = { ...guru }; // Salin data guru ke form
        } else {
          this.modalTitle = 'Tambah Guru';
          this.form = { id: null, nama: '', nip: '', jabatan: '', pengalaman: '', pendidikan_terakhir: '', mata_pelajaran: '', gambar: null };
        }
        this.showModal = true;
      },

      closeModal() {
        this.showModal = false;
      },

      openDeleteModal(guru) {
        this.guruToDelete = guru;
        this.showDeleteModal = true;
      },

      filteredgurus() {
        return this.gurus.filter(guru => guru.nama.toLowerCase().includes(this.searchQuery.toLowerCase()));
      },

      sanitizePengalamanInput() {
        if (this.form.pengalaman !== null && this.form.pengalaman !== '') {
          let val = this.form.pengalaman.toString();
          // Remove all non-digit characters
          val = val.replace(/[^0-9]/g, '');
          // Remove leading zeros except if the value is zero
          val = val.replace(/^0+(?=\d)/, '');
          this.form.pengalaman = val === '' ? '' : Number(val);
        }
      }
    };
  }
</script>
@endsection

@extends('layouts.app')

@section('content')
<!-- Tambahkan ini di <head> -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<div x-data="{ showTambah: false }" class="p-6 bg-[#F8F9FD] min-h-screen">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-[#2B3674]">Daftar Kelas</h1>
        <div class="flex gap-4">
            <input type="text" placeholder="Cari Kelas..."
                class="w-64 px-4 py-2 rounded-full border focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button @click="showTambah = true" class="bg-emerald-500 text-white px-4 py-2 rounded-lg flex items-center gap-2 shadow-md hover:bg-emerald-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Kelas
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach ($kelas as $kelasItem)
        <div x-data="{ showEdit: false, editNamaKelas: '{{ $kelasItem->kelas }}' }" class="mt-8 bg-white rounded-xl shadow-md overflow-hidden flex flex-col max-w-sm w-full">
            <div class="relative bg-emerald-500 p-4 flex items-center justify-between">
                <div>
                    <h2 class="text-white text-2xl font-bold leading-tight">{{ $kelasItem->kelas }}</h2>
                    <!-- Removed <p> tag for teacher name as requested -->
                </div>
                <!-- <div class="w-24 h-24">
                    @if($kelasItem->foto_guru)
                    <img class="w-full h-full rounded-full border-4 border-white object-cover" src="/gambar/{{ $kelasItem->foto_guru }}" alt="Guru">
                    @else
                    <img class="w-full h-full rounded-full border-4 border-white object-cover" src="/img/photo1.jpg" alt="Guru">
                    @endif
                </div> -->
            </div>
            <div class="border-t mt-auto py-3 px-4 flex justify-between items-center gap-2">
                <a href="{{ route('kelas.detail', ['id' => $kelasItem->id]) }}" class="text-emerald-500 font-semibold text-left block hover:text-emerald-700">Daftar Siswa</a>
                <div class="flex gap-4 text-white">
                    <span @click="showEdit = true" class="cursor-pointer text-yellow-500 font-semibold hover:text-yellow-700">Edit</span>
                    <form method="POST" action="{{ route('kelas.destroy', ['id' => $kelasItem->id]) }}" onsubmit="return confirm('Yakin ingin menghapus kelas ini?');" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-transparent border-none p-0 m-0 cursor-pointer text-red-500 font-semibold hover:text-red-700">Hapus</button>
                    </form>
                </div>
            </div>

            <!-- Edit Modal -->
            <div x-show="showEdit" x-transition class="fixed inset-0 z-50 flex justify-center items-center bg-black/50 backdrop-blur-sm px-4 overflow-auto">
                <div @click.away="showEdit = false" class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 animate-scaleIn">
                    <h3 class="text-xl font-semibold mb-4">Edit Nama Kelas</h3>
                    <form method="POST" action="{{ route('kelas.update', ['id' => $kelasItem->id]) }}">
                        @csrf
                        <input type="text" name="nama_kelas" x-model="editNamaKelas" class="w-full p-2 border rounded mb-4" required>
                        <div class="flex justify-end gap-2">
                            <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded hover:bg-emerald-600">Simpan</button>
                            <button type="button" @click="showEdit = false" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Modal Tambah Kelas -->
    <div x-show="showTambah" x-transition class="fixed inset-0 z-50 flex justify-center items-center bg-black/50 backdrop-blur-sm px-4 overflow-auto">
        <div @click.away="showTambah = false" class="bg-white w-full max-w-2xl rounded-lg shadow-lg p-8 animate-scaleIn overflow-y-auto max-h-[80vh] space-y-6">
            <h3 class="text-2xl font-semibold text-center mb-4">Form Tambah Kelas Baru</h3>
            <form id="tambahKelasForm" class="space-y-4" enctype="multipart/form-data" onsubmit="saveTambahKelas(event)">
                <div>
                    <label class="block font-medium mb-1">Nama Kelas:</label>
                    <input type="text" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="tambahNamaKelas" placeholder="Nama Kelas" required>
                </div>
                <!-- <div>
                    <label class="block font-medium mb-1">Nama Guru:</label>
                    <input type="text" class="w-full p-2 border rounded-md focus:ring focus:ring-emerald-300" id="tambahNamaGuru" placeholder="Nama Guru" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Foto Guru (JPG/PNG):</label>
                    <input type="file" class="w-full border rounded-md focus:ring focus:ring-emerald-300" id="tambahFotoGuru" accept="image/jpeg,image/png" required>
                </div> -->
                <button type="submit" class="w-full py-2 px-4 bg-emerald-500 text-white rounded-md hover:bg-emerald-600">Simpan</button>
            </form>
            <button class="w-full py-2 bg-red-500 text-white rounded-md hover:bg-red-600" @click="showTambah = false">Tutup</button>
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

    function saveTambahKelas(event) {
        event.preventDefault();

        const namaKelas = document.getElementById('tambahNamaKelas').value;

        if (!namaKelas) {
            alert('Nama Kelas harus diisi.');
            return;
        }

        const formData = new FormData();
        formData.append('nama_kelas', namaKelas);

        fetch('{{ route("kelas.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Gagal menyimpan data kelas.');
            }
            return response.json();
        })
        .then(data => {
            alert(data.message);
            window.location.reload();
        })
        .catch(error => {
            alert(error.message);
        });
    }
</script>
@endsection

@extends('layouts.app')

@section('content')
<div x-data="{
    showModal: false,
    showDeleteConfirm: false,
    modalTitle: '',
    form: { id: '', name: '', subject: '' },
    deleteIndex: null,
    teachers: [
        { id: 1, name: 'Tom Housenburg', subject: 'Science' },
        { id: 2, name: 'Jack Sally', subject: 'Physics' },
        { id: 3, name: 'Sarah Doe', subject: 'Mathematics' },
        { id: 4, name: 'John Smith', subject: 'History' }
    ],
    filteredTeachers: [],

    openModal(type, teacher = null) {
        this.modalTitle = type === 'tambah' ? 'Add Teacher' : 'Edit Teacher';
        this.form = teacher ? { ...teacher } : { id: '', name: '', subject: '' };
        this.showModal = true;
    },
    closeModal() {
        this.showModal = false;
    },
    confirmDelete(index) {
        this.deleteIndex = index;
        this.showDeleteConfirm = true;
    },
    deleteTeacher() {
        this.teachers.splice(this.deleteIndex, 1);
        this.showDeleteConfirm = false;
    }
}" class="p-6 bg-[#F8F9FD] w-full min-h-screen flex flex-col">

    <!-- Header Section -->
    <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
        <h1 class="text-2xl font-bold text-[#2B3674]">Teachers</h1>
        <div class="flex items-center gap-4">
            <!-- Search Bar -->
            <form action="{{ route('search') }}" method="GET" class="relative w-full max-w-xs">
                <input type="text" name="query" placeholder="Search teacher..."
                    class="w-full pl-10 pr-4 py-2 text-gray-500 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 1 0-7 7 7 7 0 0 0 7-7z"/>
                </svg>
            </form>

            <!-- Profile -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 font-medium">
                    HF
                </div>
            </div>
        </div>
    </div>

    <!-- Add Teacher Button -->
    <div class="mb-4 flex justify-end">
        <button @click="openModal('tambah')" class="bg-emerald-500 text-white px-4 py-2 rounded-lg flex items-center gap-2 shadow-md hover:bg-emerald-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Teacher
        </button>
    </div>

    <!-- Teachers Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <template x-for="(teacher, index) in teachers" :key="teacher.id">
            <div class="bg-white p-6 rounded-2xl shadow-lg flex flex-col items-center text-center">
                <!-- Teacher Photo -->
                <img src="{{ asset('img/dashboard/teacher/OIP.jpeg') }}" alt="Teacher Picture"
                    class="w-24 h-24 rounded-full object-cover border-4 border-emerald-500 mx-auto">

                <h3 class="text-lg font-semibold text-[#2B3674] mt-4" x-text="teacher.name"></h3>
                <p class="text-gray-500" x-text="teacher.subject"></p>

                <!-- Action Buttons -->
                <div class="mt-4 flex gap-2">
                    <button @click="openModal('edit', teacher)" class="px-4 py-1 bg-yellow-400 text-white rounded-md text-sm">Edit</button>
                    <button @click="confirmDelete(index)" class="px-4 py-1 bg-red-500 text-white rounded-md text-sm">Delete</button>
                </div>
            </div>
        </template>
    </div>

    <!-- Add Teacher Modal -->
    <div x-show="showModal" x-transition.opacity.scale.95 class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-xl font-bold mb-4 text-gray-700" x-text="modalTitle"></h2>

            <form @submit.prevent="showModal = false">
                <label class="block text-sm font-medium">Name</label>
                <input type="text" class="border p-2 w-full mb-4 rounded-lg" x-model="form.name" placeholder="Enter teacher name">

                <label class="block text-sm font-medium">Subject</label>
                <input type="text" class="border p-2 w-full mb-4 rounded-lg" x-model="form.subject" placeholder="Enter subject">

                <div class="flex justify-end gap-2 mt-4">
                    <button @click="showModal = false" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded-lg">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteConfirm" x-transition.opacity.scale.95 class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-xl font-bold mb-4 text-gray-700">Confirm Deletion</h2>
            <p class="mb-4">Are you sure you want to delete this teacher?</p>
            <div class="flex justify-end gap-2">
                <button @click="showDeleteConfirm = false" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Cancel</button>
                <button @click="deleteTeacher; showDeleteConfirm = false" class="px-4 py-2 bg-red-500 text-white rounded-lg">Delete</button>
            </div>
        </div>
    </div>

</div>
@endsection

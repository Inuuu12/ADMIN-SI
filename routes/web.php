<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}

// Route::get('/', function () {
//     return redirect()->route('dashboard');
// });

// Route User
Route::get('/', function () {
    return redirect()->route('beranda');
});

Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');

Route::get('/galeri', function () {
    return view('galeri');
})->name('galeri');

Route::get('/informasi_pendaftaran', function () {
    return view('informasi_pendaftaran1');
})->name('informasi_pendaftaran');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/pembayaran', function () {
    return view('pembayaran');
})->name('pembayaran');

Route::get('/pendaftaran', function () {
    return view('pendaftaran');
})->name('pendaftaran');

Route::get('/pengajar', function () {
    return view('pengajar');
})->name('pengajar');

Route::get('/program', function () {
    return view('program');
})->name('program');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');



// Route Admin
Route::get('/dashboard', function () {
    return view('ADMIN-SI.dashboard');
})->name('dashboard');

Route::get('/pendaftaran', function () {
    return view('ADMIN-SI.pendaftaran');
})->name('pendaftaran');

use App\Http\Controllers\GuruController;

Route::get('/akademik', [GuruController::class, 'webIndex'])->name('akademik');
Route::get('/guru/create', [GuruController::class, 'webCreate'])->name('guru.create');
Route::post('/guru', [GuruController::class, 'webStore'])->name('guru.store');
Route::get('/guru/{guru}', [GuruController::class, 'webShow'])->name('guru.show');
Route::get('/guru/{guru}/edit', [GuruController::class, 'webEdit'])->name('guru.edit');
Route::put('/guru/{guru}', [GuruController::class, 'webUpdate'])->name('guru.update');
Route::delete('/guru/{guru}', [GuruController::class, 'webDestroy'])->name('guru.destroy');

Route::resource('galeri', GaleriController::class);

Route::get('/fotokegiatan', [GaleriController::class, 'fotokegiatan'])->name('fotokegiatan');

Route::resource('galeri', GaleriController::class);

Route::get('/aduan', function () {
    return view('ADMIN-SI.aduan');
})->name('aduan');

Route::get('/panduan', function () {
    return view('ADMIN-SI.panduan');
})->name('panduan');

Route::get('/search', function () {
    return view('search');
})->name('search');

use App\Http\Controllers\GaleriController;

Route::get('/fotokegiatan', [GaleriController::class, 'fotokegiatan'])->name('fotokegiatan');

Route::get('/spp', function () {
    return view('ADMIN-SI.spp');
})->name('spp');

Route::get('/kelas', function () {
    return view('ADMIN-SI.kelas');
})->name('kelas');

Route::get('/profil', function () {
    return view('ADMIN-SI.profil');
})->name('profil');

Route::get('/login', function () {
    return view('layouts.login');
})->name('login');

Route::get('/register', function () {
    return view('layouts.register');
})->name('register');

Route::get('/kelas/{kelas}', function ($kelas) {
    $guru = 'Moh. Rofi Julian, S. T.';
    $siswa = [
        'Siswa 1',
        'Siswa 2',
        'Siswa 3',
        'Siswa 4',
    ];

    // Mengirim data kelas, guru, dan siswa ke view kelasa
    return view('ADMIN-SI.kelasa', compact('kelas', 'guru', 'siswa'));
});











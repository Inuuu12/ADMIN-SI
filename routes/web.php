<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\GaleriController;

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

Route::get('/pengajar', [GuruController::class, 'webPengajar'])->name('pengajar');

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
    return view('pendaftaran');
})->name('pendaftaran');

Route::get('/akademik', [GuruController::class, 'webIndex'])->name('akademik');
Route::get('/guru/create', [GuruController::class, 'webCreate'])->name('guru.create');
Route::post('/guru', [GuruController::class, 'webStore'])->name('guru.store');
Route::get('/guru/{guru}', [GuruController::class, 'webShow'])->name('guru.show');
Route::get('/guru/{guru}/edit', [GuruController::class, 'webEdit'])->name('guru.edit');
Route::put('/guru/{guru}', [GuruController::class, 'webUpdate'])->name('guru.update');
Route::delete('/guru/{guru}', [GuruController::class, 'webDestroy'])->name('guru.destroy');

Route::get('/fotokegiatan', [GaleriController::class, 'fotokegiatan'])->name('fotokegiatan');

Route::get('/galeri/create', [GaleriController::class, 'webCreate'])->name('galeri.create');
Route::post('/galeri', [GaleriController::class, 'webStore'])->name('galeri.store');
Route::get('/galeri/{galeri}', [GaleriController::class, 'webShow'])->name('galeri.show');
Route::get('/galeri/{galeri}/edit', [GaleriController::class, 'webEdit'])->name('galeri.edit');
Route::put('/galeri/{galeri}', [GaleriController::class, 'webUpdate'])->name('galeri.update');
Route::delete('/galeri/{galeri}', [GaleriController::class, 'webDestroy'])->name('galeri.destroy');

Route::get('/aduan', function () {
    return view('ADMIN-SI.aduan');
})->name('aduan');

Route::get('/panduan', function () {
    return view('ADMIN-SI.panduan');
})->name('panduan');

Route::get('/search', function () {
    return view('search');
})->name('search');

Route::get('/fotokegiatan', [GaleriController::class, 'fotokegiatan'])->name('fotokegiatan');

Route::get('/spp', function () {
    return view('ADMIN-SI.spp');
})->name('spp');

Route::get('/profil', function () {
    return view('ADMIN-SI.profil');
})->name('profil');

Route::get('/login', function () {
    return view('layouts.login');
})->name('login');










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

Route::get('/akademik', function () {
    return view('ADMIN-SI.akademik');
})->name('akademik');

Route::get('/aduan', function () {
    return view('ADMIN-SI.aduan');
})->name('aduan');

Route::get('/panduan', function () {
    return view('ADMIN-SI.panduan');
})->name('panduan');

Route::get('/search', function () {
    return view('search');
})->name('search');

Route::get('/fotokegiatan', function () {
    return view('ADMIN-SI.fotokegiatan');
})->name('fotokegiatan');

Route::get('/spp', function () {
    return view('ADMIN-SI.spp');
})->name('spp');

Route::get('/profil', function () {
    return view('ADMIN-SI.profil');
})->name('profil');

Route::get('/login', function () {
    return view('layouts.login');
})->name('login');










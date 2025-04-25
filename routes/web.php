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

Route::get('/', function () {
    return redirect()->route('beranda');
});

Route::get('/dashboard', function () {
    return view('ADMIN-SI.dashboard');
})->name('dashboard');

Route::get('/pendaftaran', function () {
    return view('ADMIN-SI.pendaftaran');
})->name('pendaftaran');

Route::get('/akademik', [GuruController::class, 'index'])->name('akademik');
Route::resource('guru', GuruController::class);

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

Route::get('/profil', function () {
    return view('ADMIN-SI.profil');
})->name('profil');

Route::get('/login', function () {
    return view('layouts.login');
})->name('login');










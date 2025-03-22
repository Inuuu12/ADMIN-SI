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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/pendaftaran', function () {
    return view('pendaftaran');
})->name('pendaftaran');

Route::get('/akademik', function () {
    return view('akademik');
})->name('akademik');

Route::get('/aduan', function () {
    return view('aduan');
})->name('aduan');

Route::get('/panduan', function () {
    return view('panduan');
})->name('panduan');

Route::get('/search', function () {
    return view('search');
})->name('search');

Route::get('/fotokegiatan', function () {
    return view('fotokegiatan');
})->name('fotokegiatan');

Route::get('/spp', function () {
    return view('spp');
})->name('spp');

Route::get('/profil', function () {
    return view('profil');
})->name('profil');

Route::get('/login', function () {
    return view('layouts.login');
})->name('login');










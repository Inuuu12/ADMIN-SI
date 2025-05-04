<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\DashboardController;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PembayaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public Routes
Route::get('/', function () {
    return redirect()->route('beranda');
});

Route::view('/beranda', 'beranda')->name('beranda');

Route::get('/galeri', [GaleriController::class, 'webGaleri'])->name('galeri');

Route::view('/informasi_pendaftaran', 'informasi_pendaftaran1')->name('informasi_pendaftaran');

Route::view('/kontak', 'kontak')->name('kontak');

Route::view('/pembayaran', 'pembayaran')->name('pembayaran');

Route::get('/pengajar', [GuruController::class, 'webPengajar'])->name('pengajar');

Route::view('/program', 'program')->name('program');

Route::view('/tentang', 'tentang')->name('tentang');


// Route::get('/pendaftaran', function () {
//     return view('pendaftaran');
// })->name('pendaftaran');

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

Route::get('/kelas', function () {
    return view('ADMIN-SI.kelas');
})->name('kelas');

Route::get('/profil', function () {
    return view('ADMIN-SI.profil');
})->name('profil');

Route::get('/siswa', function () {
    return view('ADMIN-SI.siswa');
})->name('siswa');

//login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticating']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'createUser']);
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::get('/resend-email', [AuthController::class, 'showResendEmailForm'])->name('resend.email.form');
Route::post('/resend-email', [AuthController::class, 'handleResendEmail'])->name('resend.email.submit');

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('layouts.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/login');
})->middleware(['signed'])->name('verification.verify');

Route::middleware(['auth', 'verified'])->group(function () {

Route::get('/pendaftaran', function () {
    $user = auth()->user();
    if (!$user || $user->isUser() === false) {
        abort(403, 'Unauthorized');
    }
    return view('pendaftaran');
})->name('pendaftaran');

Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.post');

Route::get('/pendaftaran/success', function () {
    return view('pendaftaran_success');
})->name('pendaftaran.success');

Route::get('/pembayaran', function () {
    $user = auth()->user();
    if (!$user || $user->isUser() === false) {
        abort(403, 'Unauthorized');
    }
    return view('pembayaran');
})->name('pembayaran');

    Route::post('/pembayaran', [AuthController::class, 'postPembayaran'])->name('pembayaran.post');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'web'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
        $user = auth()->user();
        if (!$user || $user->isAdmin() === false) {
            abort(403, 'Unauthorized');
        }
        return view('ADMIN-SI.aduan');
    })->name('aduan');

    Route::get('/panduan', function () {
        $user = auth()->user();
        if (!$user || $user->isAdmin() === false) {
            abort(403, 'Unauthorized');
        }
        return view('ADMIN-SI.panduan');
    })->name('panduan');

    Route::get('/search', function () {
        $user = auth()->user();
        if (!$user || $user->isAdmin() === false) {
            abort(403, 'Unauthorized');
        }
        return view('search');
    })->name('search');

    Route::get('/spp', function () {
        $user = auth()->user();
        if (!$user || $user->isAdmin() === false) {
            abort(403, 'Unauthorized');
        }
        return view('ADMIN-SI.spp');
    })->name('spp');

    Route::get('/kelas', function () {
        $user = auth()->user();
        if (!$user || $user->isAdmin() === false) {
            abort(403, 'Unauthorized');
        }
        return view('ADMIN-SI.kelas');
    })->name('kelas');

    Route::get('/profil', function () {
        $user = auth()->user();
        if (!$user || $user->isAdmin() === false) {
            abort(403, 'Unauthorized');
        }
        return view('ADMIN-SI.profil');
    })->name('profil');

    Route::post('/pendaftaran/{id}/reject', [DashboardController::class, 'reject'])->name('dashboard.pendaftaran.reject');
    Route::delete('/pendaftaran/{id}', [DashboardController::class, 'destroy'])->name('dashboard.pendaftaran.destroy');
});

//Login Admin
Route::get('/login-admin', [AuthController::class, 'login_admin'])->name('login-admin');
Route::post('/login-admin', [AuthController::class, 'authenticating_admin'])->name('login-admin.post');

//Pembayaran 
Route::get('/bayar/{id}', [PembayaranController::class, 'formBayar']);
Route::post('/bayar/process', [PembayaranController::class, 'processBayar']);

// Route with parameter
Route::get('/kelas/{kelas}', function ($kelas) {
    $guru = 'Moh. Rofi Julian, S. T.';
    $siswa = [
        'Siswa 1',
        'Siswa 2',
        'Siswa 3',
        'Siswa 4',
    ];
    return view('ADMIN-SI.kelasa', compact('kelas', 'guru', 'siswa'));
});

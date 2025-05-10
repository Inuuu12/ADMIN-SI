<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\SantriRejected;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user || $user->isAdmin() === false) {
            Session::flash('error', 'Anda tidak memiliki akses ke halaman ini.');

            // Redirect ke beranda instead of back to prevent redirect loop
            return redirect()->route('beranda');
        }

        $totalPendaftar = Pendaftaran::count();
        $diterimaCount = Pendaftaran::where('status', 'accepted')->count();
        $menungguCount = Pendaftaran::where('status', 'pending')->count();
        $ditolakCount = Pendaftaran::where('status', 'rejected')->count();

        $pendaftaran = Pendaftaran::all()->map(function ($item) {
            $tanggalLahir = Carbon::parse($item->tanggal_lahir);
            $usia = $tanggalLahir->age; // Calculate age from tanggal_lahir

            return [
                'id' => $item->id,
                'nama_santri' => $item->nama_santri,
                'tempat_lahir' => $item->tempat_lahir,
                'tanggal_lahir' => $item->tanggal_lahir,
                'jenis_kelamin' => $item->jenis_kelamin === 'L' ? 'Laki-laki' : ($item->jenis_kelamin === 'P' ? 'Perempuan' : $item->jenis_kelamin),
                'usia' => $usia,
                'nama_orang_tua' => $item->nama_orang_tua,
                'no_hp' => $item->no_hp,
                'alamat' => $item->alamat,
                'akta_kelahiran' => $item->akta_kelahiran,
                'kartu_keluarga' => $item->kartu_keluarga,
                'status' => $item->status === 'pending' ? 'Menunggu' : ($item->status === 'accepted' ? 'Diterima' : ($item->status === "rejected" ? "Ditolak" : $item->status)),
            ];
        });

        $notifications = $user->unreadNotifications()->get();

        return view('ADMIN-SI.dashboard', compact('pendaftaran', 'totalPendaftar', 'diterimaCount', 'menungguCount', 'ditolakCount', 'notifications'));
    }

    public function reject($id)
    {
        $user = Auth::user();
        if (!$user || $user->isAdmin() === false) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $pendaftaran = Pendaftaran::find($id);
        if (!$pendaftaran) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $pendaftaran->status = 'rejected';
        $pendaftaran->save();

        // Send rejection email
        if ($pendaftaran->user && $pendaftaran->user->email) {
            Mail::to($pendaftaran->user->email)->send(new SantriRejected($pendaftaran));
        }

        return response()->json(['message' => 'Status updated to rejected']);
    }

    public function approve($id)
    {
        $user = Auth::user();
        if (!$user || $user->isAdmin() === false) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $pendaftaran = Pendaftaran::find($id);
        if (!$pendaftaran) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $pendaftaran->status = 'accepted';
        $pendaftaran->save();

        // Send approval email with payment link
        if ($pendaftaran->user && $pendaftaran->user->email) {
            \Illuminate\Support\Facades\Mail::to($pendaftaran->user->email)->send(new \App\Mail\SantriApproved($pendaftaran));
        }

        return response()->json(['message' => 'Status updated to accepted']);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user || $user->isAdmin() === false) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $pendaftaran = Pendaftaran::find($id);
        if (!$pendaftaran) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $pendaftaran->delete();

        return response()->json(['message' => 'Data deleted successfully']);
    }
}

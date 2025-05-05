<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user || $user->isAdmin() === false) {
            Session::flash('error', 'Anda tidak memiliki akses ke halaman ini.');

            // Redirect ke halaman sebelumnya
            return redirect()->back();
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

        return view('ADMIN-SI.dashboard', compact('pendaftaran', 'totalPendaftar', 'diterimaCount', 'menungguCount', 'ditolakCount'));
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

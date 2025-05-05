<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SantriApproved;

class PendaftaranController extends Controller
{

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'user') {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login sebagai user untuk melakukan pendaftaran.']);
        }

        $validatedData = $request->validate([
            'nama_santri' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:L,P',
            'alamat' => 'required|string',
            'nama_orang_tua' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'akta_kelahiran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kartu_keluarga' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Simpan file akta_kelahiran
        if ($request->hasFile('akta_kelahiran')) {
            $aktaFile = $request->file('akta_kelahiran');
            $aktaName = time() . '_akta.' . $aktaFile->getClientOriginalExtension();
            $aktaFile->move(public_path('gambar/akta_kelahiran'), $aktaName);
            $validatedData['akta_kelahiran'] = $aktaName;
        }

        // Simpan file kartu_keluarga
        if ($request->hasFile('kartu_keluarga')) {
            $kkFile = $request->file('kartu_keluarga');
            $kkName = time() . '_kk.' . $kkFile->getClientOriginalExtension();
            $kkFile->move(public_path('gambar/kartu_keluarga'), $kkName);
            $validatedData['kartu_keluarga'] = $kkName;
        }

        $validatedData['user_id'] = Auth::id();
        $validatedData['status'] = 'pending';

        Pendaftaran::create($validatedData);

        return redirect()->route('pendaftaran.success');
    }

    public function approve($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status = 'Diterima';
        $pendaftaran->save();

        // Kirim email ke santri atau wali
        Mail::to($pendaftaran->email)->send(new SantriApproved($pendaftaran));

        return response()->json(['success' => true]);
    }
}

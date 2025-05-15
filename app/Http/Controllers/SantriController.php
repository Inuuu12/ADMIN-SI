<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Santri;

class SantriController extends Controller
{
    public function index(Request $request)
    {
        $query = Santri::query();

        // Search by nama_santri
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_santri', 'like', '%' . $search . '%');
        }

        // Filter by jenis_kelamin
        if ($request->has('jenis_kelamin') && $request->jenis_kelamin != '') {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Sorting
        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'nama_asc':
                    $query->orderBy('nama_santri', 'asc');
                    break;
                case 'nama_desc':
                    $query->orderBy('nama_santri', 'desc');
                    break;
                case 'terlama':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'terbaru':
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $santris = $query->paginate(10);
        $totalSantri = $santris->total();

        if ($request->ajax()) {
            return response()->json([
                'santris' => $santris,
                'totalSantri' => $totalSantri,
            ]);
        }

        return view('ADMIN-SI.santri', compact('santris', 'totalSantri'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_santri' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:1',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nama_orang_tua' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'akta_kelahiran' => 'required|file|mimes:pdf|max:2048',
            'kartu_keluarga' => 'required|file|mimes:pdf|max:2048',
        ]);

        $aktaKelahiranFileName = null;
        if ($request->hasFile('akta_kelahiran')) {
            $aktaKelahiranFile = $request->file('akta_kelahiran');
            $aktaKelahiranFileName = time() . '_akta.' . $aktaKelahiranFile->getClientOriginalExtension();
            $aktaKelahiranFile->move(public_path('gambar/akta_kelahiran'), $aktaKelahiranFileName);
        }

        $kartuKeluargaFileName = null;
        if ($request->hasFile('kartu_keluarga')) {
            $kartuKeluargaFile = $request->file('kartu_keluarga');
            $kartuKeluargaFileName = time() . '_kk.' . $kartuKeluargaFile->getClientOriginalExtension();
            $kartuKeluargaFile->move(public_path('gambar/kartu_keluarga'), $kartuKeluargaFileName);
        }

        $santri = new Santri();
        $santri->nama_santri = $validated['nama_santri'];
        $santri->jenis_kelamin = $validated['jenis_kelamin'];
        $santri->tempat_lahir = $validated['tempat_lahir'];
        $santri->tanggal_lahir = $validated['tanggal_lahir'];
        $santri->nama_orang_tua = $validated['nama_orang_tua'];
        $santri->no_hp = $validated['no_hp'];
        $santri->alamat = $validated['alamat'];
        $santri->akta_kelahiran = $aktaKelahiranFileName;
        $santri->kartu_keluarga = $kartuKeluargaFileName;
        $santri->save();

        return response()->json(['message' => 'Santri berhasil ditambahkan'], 201);
    }

    public function edit($id)
    {
        $santri = Santri::find($id);
        if (!$santri) {
            return response()->json(['message' => 'Santri tidak ditemukan'], 404);
        }
        return response()->json($santri);
    }

    public function update(Request $request, $id)
    {
        $santri = Santri::find($id);
        if (!$santri) {
            return response()->json(['message' => 'Santri tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama_santri' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:1',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nama_orang_tua' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'akta_kelahiran' => 'nullable|file|mimes:pdf|max:2048',
            'kartu_keluarga' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('akta_kelahiran')) {
            $aktaKelahiranFile = $request->file('akta_kelahiran');
            $aktaKelahiranFileName = time() . '_akta.' . $aktaKelahiranFile->getClientOriginalExtension();
            $aktaKelahiranFile->move(public_path('gambar/akta_kelahiran'), $aktaKelahiranFileName);
            $santri->akta_kelahiran = $aktaKelahiranFileName;
        }

        if ($request->hasFile('kartu_keluarga')) {
            $kartuKeluargaFile = $request->file('kartu_keluarga');
            $kartuKeluargaFileName = time() . '_kk.' . $kartuKeluargaFile->getClientOriginalExtension();
            $kartuKeluargaFile->move(public_path('gambar/kartu_keluarga'), $kartuKeluargaFileName);
            $santri->kartu_keluarga = $kartuKeluargaFileName;
        }

        $santri->nama_santri = $validated['nama_santri'];
        $santri->jenis_kelamin = $validated['jenis_kelamin'];
        $santri->tempat_lahir = $validated['tempat_lahir'];
        $santri->tanggal_lahir = $validated['tanggal_lahir'];
        $santri->nama_orang_tua = $validated['nama_orang_tua'];
        $santri->no_hp = $validated['no_hp'];
        $santri->alamat = $validated['alamat'];
        $santri->save();

        return response()->json(['message' => 'Santri berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $santri = Santri::find($id);
        if (!$santri) {
            return response()->json(['message' => 'Santri tidak ditemukan'], 404);
        }

        $santri->delete();

        return response()->json(['message' => 'Santri berhasil dihapus']);
    }
}

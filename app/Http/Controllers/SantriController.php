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

        $santris = $query->paginate(5);
        $totalSantri = $santris->total();

        // Get total count of all santri regardless of filters
        $totalSantriAll = Santri::count();

        if ($request->ajax()) {
            return response()->json([
                'santris' => $santris,
                'totalSantri' => $totalSantri,
                'totalSantriAll' => $totalSantriAll,
            ]);
        }

        return view('ADMIN-SI.santri', compact('santris', 'totalSantri', 'totalSantriAll'));
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

        // Generate NIS: 2 digits year of registration + 6 digits date of birth (ddmmyy) + 3 digits random number ensuring uniqueness
        $year = date('y'); // current year two digits
        $dob = date('dmy', strtotime($validated['tanggal_lahir'])); // date of birth in ddmmyy format

        $prefix = $year . $dob;

        // Generate 3 random digits and ensure uniqueness
        do {
            $randomDigits = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $nis = $prefix . $randomDigits;
            $exists = Santri::where('nis', $nis)->exists();
        } while ($exists);

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
        $santri->nis = $nis;
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
        \Log::info('SantriController@update called with id: ' . $id);
        $santri = Santri::find($id);
        if (!$santri) {
            \Log::warning('Santri not found with id: ' . $id);
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

        \Log::info('Santri updated successfully: ' . $santri->id);

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

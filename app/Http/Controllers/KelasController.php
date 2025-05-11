<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\Storage;

use App\Models\Santri;
use Carbon\Carbon;

class KelasController extends Controller
{
    /**
     * Store a newly created kelas in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50',
            // 'nama_guru' => 'required|string|max:255',
            // 'foto_guru' => 'required|image|mimes:jpeg,png|max:2048',
        ]);

        // Save kelas data
        $kelas = new Kelas();
        $kelas->kelas = $request->input('nama_kelas');
        $kelas->save();

        return response()->json(['message' => 'Kelas berhasil ditambahkan']);
    }

    /**
     * Show the detail kelas page with santri list.
     */
    public function detail($id)
    {
        $kelas = Kelas::findOrFail($id);
        $santris = Santri::where('id_kelas', $id)->get();

        // Calculate age for each santri
        $santris->transform(function ($santri) {
            $birthDate = Carbon::parse($santri->tanggal_lahir);
            $santri->umur = $birthDate->age;
            return $santri;
        });

        // Get santri with null id_kelas for tambah checkbox list
        $santriNullKelas = Santri::whereNull('id_kelas')->get();

        return view('ADMIN-SI.detailkelas', compact('kelas', 'santris', 'santriNullKelas'));
    }

    /**
     * Update santri kelas assignment.
     */
    public function updateSantriKelas(Request $request, $id)
    {
        $request->validate([
            'santri_ids' => 'required|array',
            'santri_ids.*' => 'exists:tblsantri,id',
        ]);

        $santriIds = $request->input('santri_ids');

        Santri::whereIn('id', $santriIds)->update(['id_kelas' => $id]);

        return redirect()->route('kelas.detail', ['id' => $id])->with('success', 'Santri berhasil ditambahkan ke kelas.');
    }

    /**
     * Remove santri from kelas by setting id_kelas to null.
     */
    public function removeSantriFromKelas($kelasId, $santriId)
    {
        $santri = Santri::where('id', $santriId)->where('id_kelas', $kelasId)->firstOrFail();
        $santri->id_kelas = null;
        $santri->save();

        return redirect()->route('kelas.detail', ['id' => $kelasId])->with('success', 'Santri berhasil dihapus dari kelas.');
    }

    /**
     * Remove all santri from kelas by setting id_kelas to null.
     */
    public function removeAllSantriFromKelas($kelasId)
    {
        Santri::where('id_kelas', $kelasId)->update(['id_kelas' => null]);

        return redirect()->route('kelas.detail', ['id' => $kelasId])->with('success', 'Semua santri berhasil dihapus dari kelas.');
    }

    /**
     * Update the specified kelas in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->kelas = $request->input('nama_kelas');
        $kelas->save();

        return redirect()->route('kelas')->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified kelas from storage.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        // Set id_kelas to null for related santri before deleting kelas
        Santri::where('id_kelas', $id)->update(['id_kelas' => null]);

        $kelas->delete();

        return redirect()->route('kelas')->with('success', 'Kelas berhasil dihapus.');
    }
}

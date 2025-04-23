<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;


class GuruController extends Controller
{
    // Tampilkan semua data guru
    public function index()
    {
        $gurus = Guru::all(); // ambil semua data dari tabel tblguru
        return view('ADMIN-SI.akademik', compact('gurus'));
    }

    // Tampilkan form tambah guru
    public function create()
    {
        return view('guru.create');
    }

    // Simpan data guru baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:tblguru,nip',
            'alamat' => 'required',
            'no_hp' => 'nullable',
            'email' => 'nullable|email',
            'pendidikan_terakhir' => 'nullable',
            'mata_pelajaran' => 'required',
        ]);

        Guru::create($request->all());
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    // Tampilkan detail satu guru
    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.show', compact('guru'));
    }

    // Tampilkan form edit guru
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.edit', compact('guru'));
    }

    // Update data guru
    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:tblguru,nip,' . $id,
            'alamat' => 'required',
            'no_hp' => 'nullable',
            'email' => 'nullable|email',
            'pendidikan_terakhir' => 'nullable',
            'mata_pelajaran' => 'required',
        ]);

        $guru->update($request->all());
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    // Hapus guru
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}

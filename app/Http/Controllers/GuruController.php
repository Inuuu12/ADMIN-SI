<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;

class GuruController extends Controller
{
    // Tampilkan semua data guru
    public function index(Request $request)
    {
        $search = $request->query('q');
        if ($search) {
            $gurus = Guru::where('nama', 'like', '%' . $search . '%')->get();
        } else {
            $gurus = Guru::all();
        }
        return view('ADMIN-SI.akademik', compact('gurus', 'search'));
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
            'nama' => 'required|max:100',
            'nip' => 'required|max:20|unique:tblguru,nip',
            'jabatan' => 'required|max:50',
            'mata_pelajaran' => 'required',
            'pengalaman' => 'required|integer',
            'pendidikan_terakhir' => 'required|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.max' => 'NIP maksimal 20 karakter.',
            'nip.unique' => 'NIP sudah digunakan.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'jabatan.max' => 'Jabatan maksimal 50 karakter.',
            'mata_pelajaran.required' => 'Mata pelajaran wajib diisi.',
            'pengalaman.required' => 'Pengalaman wajib diisi.',
            'pengalaman.integer' => 'Pengalaman harus berupa angka.',
            'pendidikan_terakhir.required' => 'Pendidikan terakhir wajib diisi.',
            'pendidikan_terakhir.max' => 'Pendidikan terakhir maksimal 100 karakter.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('gambar'), $imageName);
            $data['gambar'] = $imageName;
        }

        Guru::create($data);
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
            'nama' => 'required|max:100',
            'nip' => 'required|max:20|unique:tblguru,nip,' . $id,
            'jabatan' => 'required|max:50',
            'mata_pelajaran' => 'required',
            'pengalaman' => 'required|integer',
            'pendidikan_terakhir' => 'required|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.max' => 'NIP maksimal 20 karakter.',
            'nip.unique' => 'NIP sudah digunakan.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'jabatan.max' => 'Jabatan maksimal 50 karakter.',
            'mata_pelajaran.required' => 'Mata pelajaran wajib diisi.',
            'pengalaman.required' => 'Pengalaman wajib diisi.',
            'pengalaman.integer' => 'Pengalaman harus berupa angka.',
            'pendidikan_terakhir.required' => 'Pendidikan terakhir wajib diisi.',
            'pendidikan_terakhir.max' => 'Pendidikan terakhir maksimal 100 karakter.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('gambar'), $imageName);
            $data['gambar'] = $imageName;
        }

        $guru->update($data);
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

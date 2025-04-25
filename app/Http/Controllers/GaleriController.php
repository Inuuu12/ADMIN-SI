<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeris = Galeri::all();
        return view('galeri', compact('galeris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:30',
            'deskripsi' => 'required|string|max:75',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('gambar'), $imageName);
            $validated['gambar'] = $imageName;
        }

        Galeri::create($validated);

        return response()->json(['message' => 'Galeri created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Galeri $galeri)
    {
        return response()->json($galeri);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        return view('galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:30',
            'deskripsi' => 'required|string|max:75',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('gambar'), $imageName);
            $validated['gambar'] = $imageName;
        }

        $galeri->update($validated);

        return response()->json(['message' => 'Galeri updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        $galeri->delete();

        return response()->json(['message' => 'Galeri deleted successfully.']);
    }

    /**
     * Display the foto kegiatan page with galeri data.
     */
    public function fotokegiatan(Request $request)
    {
        $sort = $request->query('sort');
        $search = $request->query('search');

        $query = Galeri::query();

        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%');
        }

        if ($sort === 'judul_asc') {
            $query->orderBy('judul', 'asc');
        } elseif ($sort === 'judul_desc') {
            $query->orderBy('judul', 'desc');
        } elseif ($sort === 'tanggal_asc') {
            $query->orderBy('tanggal', 'asc');
        } elseif ($sort === 'tanggal_desc') {
            $query->orderBy('tanggal', 'desc');
        }

        $galeris = $query->get();

        return view('ADMIN-SI.fotokegiatan', compact('galeris'));
    }
}

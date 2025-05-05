<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $artikels = Artikel::latest()->get();

            return DataTables::of($artikels)
                ->addColumn('gambar', function ($row) {
                    if ($row->gambar) {
                        return '<img src="' . asset('storage/' . $row->gambar) . '" width="80">';
                    }
                    return '<span class="text-muted">Tidak ada</span>';
                })
                ->addColumn('aksi', function ($row) {
                    return view('backend.pages.Artikel.action', compact('row'));
                })
                ->rawColumns(['gambar', 'aksi']) // kolom yang mengandung HTML
                ->make(true);
        }

        return view('backend.pages.Artikel.index');
    }

    public function create()
    {
        return view('backend.pages.Artikel.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('uploads/artikels', 'public');
        }

        Artikel::create($validated);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dibuat!');
    }

    public function edit(Artikel $artikel)
    {
        return view('backend.pages.Artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('uploads/artikels', 'public');
        }

        $artikel->update($validated);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Artikel $artikel)
    {
        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }

    public function detail($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('pages.artikel.detail', compact('artikel'));
    }

    public function list()
    {
        $artikels = Artikel::latest()->take(5)->get(); // Ambil 5 artikel terbaru
        return view('pages.artikel.list', compact('artikels'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\SektorPekerjaan;

class SektorPekerjaanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SektorPekerjaan::select(['id', 'nama']);
            return DataTables::of($data)
                ->addColumn('aksi', function ($row) {
                    $editUrl = route('sektor-pekerjaan.edit', $row->id);
                    $deleteForm = '<form id="delete-form-' . $row->id . '" action="' . route('sektor-pekerjaan.destroy', $row->id) . '" method="POST" style="display:none;">'
                        . csrf_field()
                        . method_field('DELETE')
                        . '</form>';
                    return
                        '<a href="' . $editUrl . '" class="btn btn-sm btn-warning">Edit</a> ' .
                        '<button onclick="confirmDelete(' . $row->id . ')" class="btn btn-sm btn-danger">Hapus</button>'
                        . $deleteForm;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('backend.pages.sektor_pekerjaan.index');
    }

    public function create()
    {
        return view('backend.pages.sektor_pekerjaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:sektor_pekerjaan',
        ], [
            'nama.required' => 'Nama sektor pekerjaan wajib diisi.',
            'nama.unique' => 'Nama sektor pekerjaan sudah ada.',
        ]);

        SektorPekerjaan::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('sektor-pekerjaan.index')->with('success', 'Data sektor pekerjaan berhasil ditambahkan.');
    }

    public function edit(SektorPekerjaan $sektorPekerjaan)
    {
        return view('backend.pages.sektor_pekerjaan.edit', compact('sektorPekerjaan'));
    }

    public function update(Request $request, SektorPekerjaan $sektorPekerjaan)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:sektor_pekerjaan,nama,' . $sektorPekerjaan->id,
        ], [
            'nama.required' => 'Nama sektor pekerjaan wajib diisi.',
            'nama.unique' => 'Nama sektor pekerjaan sudah ada.',
        ]);

        $sektorPekerjaan->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('sektor-pekerjaan.index')->with('success', 'Data sektor pekerjaan berhasil diperbarui.');
    }

    public function destroy(SektorPekerjaan $sektorPekerjaan)
    {
        $sektorPekerjaan->delete();

        return redirect()->route('sektor-pekerjaan.index')->with('success', 'Data sektor pekerjaan berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use App\Models\SektorPekerjaan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PekerjaanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pekerjaan::with('sektor')->select('id', 'sektor_id', 'nama', 'jumlah');
            return DataTables::of($data)
                ->addColumn('sektor', function($row) {
                    return $row->sektor ? $row->sektor->nama : '-';
                })
                ->addColumn('aksi', function ($row) {
                    $editUrl = route('pekerjaan.edit', $row->id);
                    $deleteForm = '<form id="delete-form-'.$row->id.'" action="'.route('pekerjaan.destroy', $row->id).'" method="POST" style="display:none;">'
                        . csrf_field()
                        . method_field('DELETE')
                        . '</form>';
                    return
                        '<a href="'.$editUrl.'" class="btn btn-sm btn-warning">Edit</a> '.
                        '<button onclick="confirmDelete('.$row->id.')" class="btn btn-sm btn-danger">Hapus</button>'
                        . $deleteForm;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('backend.pages.pekerjaan.index');
    }

    public function create()
    {
        $sektors = SektorPekerjaan::all();
        return view('backend.pages.pekerjaan.create', compact('sektors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sektor_id' => 'required|exists:sektor_pekerjaan,id',
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
        ]);

        Pekerjaan::create($request->only('sektor_id', 'nama', 'jumlah'));

        return redirect()->route('pekerjaan.index')->with('success', 'Data pekerjaan berhasil ditambahkan.');
    }

    public function edit(Pekerjaan $pekerjaan)
    {
        $sektors = SektorPekerjaan::all();
        return view('backend.pages.pekerjaan.edit', compact('pekerjaan', 'sektors'));
    }

    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        $request->validate([
            'sektor_id' => 'required|exists:sektor_pekerjaan,id',
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
        ]);

        $pekerjaan->update($request->only('sektor_id', 'nama', 'jumlah'));

        return redirect()->route('pekerjaan.index')->with('success', 'Data pekerjaan berhasil diperbarui.');
    }

    public function destroy(Pekerjaan $pekerjaan)
    {
        $pekerjaan->delete();

        return redirect()->route('pekerjaan.index')->with('success', 'Data pekerjaan berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\PendudukStat;
use Spatie\SimpleExcel\SimpleExcelWriter;

class PendudukController extends Controller
{
    public function export()
    {
        $data = PendudukStat::select('tahun', 'laki_laki', 'perempuan')
            ->get()
            ->map(function ($item) {
                return [
                    'Tahun' => $item->tahun,
                    'Laki-laki' => $item->laki_laki,
                    'Perempuan' => $item->perempuan,
                    'Total' => $item->laki_laki + $item->perempuan,
                ];
            });

        $fileName = 'statistik_penduduk_' . now()->format('Ymd_His') . '.csv';
        $filePath = storage_path("app/public/{$fileName}");

        SimpleExcelWriter::create($filePath)->addRows($data);

        return response()->download($filePath)->deleteFileAfterSend();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PendudukStat::select(['id', 'tahun', 'laki_laki', 'perempuan']);
            return DataTables::of($data)
                ->addColumn('aksi', function($row){
                    $editUrl = route('penduduk.edit', $row->id);
                    $deleteForm = '<form id="delete-form-'.$row->id.'" action="'.route('penduduk.destroy', $row->id).'" method="POST" style="display: none;">'
                                . csrf_field()
                                . method_field('DELETE')
                                . '</form>';
                    return '
                        <a href="'.$editUrl.'" class="btn btn-sm btn-warning">Edit</a>
                        <button onclick="confirmDelete('.$row->id.')" class="btn btn-sm btn-danger">Hapus</button>'
                        . $deleteForm;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('backend.pages.Penduduk.index');
    }

    public function create()
    {
        return view('backend.pages.Penduduk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'laki_laki' => 'required|integer|min:0',
            'perempuan' => 'required|integer|min:0',
            'tahun' => 'required|digits:4',
        ], [
            'laki_laki.required' => 'Jumlah laki-laki wajib diisi.',
            'laki_laki.integer' => 'Jumlah laki-laki harus berupa angka.',
            'laki_laki.min' => 'Jumlah laki-laki minimal 0.',

            'perempuan.required' => 'Jumlah perempuan wajib diisi.',
            'perempuan.integer' => 'Jumlah perempuan harus berupa angka.',
            'perempuan.min' => 'Jumlah perempuan minimal 0.',

            'tahun.required' => 'Tahun wajib diisi.',
            'tahun.digits' => 'Tahun harus terdiri dari 4 angka.',
        ]);

        PendudukStat::create($request->only('laki_laki', 'perempuan', 'tahun'));

        return redirect()->route('penduduk.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(PendudukStat $penduduk)
    {
        return view('backend.pages.Penduduk.edit', compact('penduduk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'laki_laki' => 'required|integer|min:0',
            'perempuan' => 'required|integer|min:0',
            'tahun' => 'required|digits:4',
        ], [
            'laki_laki.required' => 'Jumlah laki-laki wajib diisi.',
            'laki_laki.integer' => 'Jumlah laki-laki harus berupa angka.',
            'laki_laki.min' => 'Jumlah laki-laki minimal 0.',

            'perempuan.required' => 'Jumlah perempuan wajib diisi.',
            'perempuan.integer' => 'Jumlah perempuan harus berupa angka.',
            'perempuan.min' => 'Jumlah perempuan minimal 0.',

            'tahun.required' => 'Tahun wajib diisi.',
            'tahun.digits' => 'Tahun harus terdiri dari 4 angka.',
        ]);

        $penduduk = PendudukStat::findOrFail($id);
        $penduduk->update($request->only('laki_laki', 'perempuan', 'tahun'));

        return redirect()->route('penduduk.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function show($id)
    {
        abort(404);
    }



    public function destroy(PendudukStat $penduduk)
    {
        $penduduk->delete();

        return redirect()->route('penduduk.index')->with('success', 'Data berhasil dihapus.');
    }
}

@extends('backend.master')

@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Dashboard</div>
                <h2 class="page-title pb-2">Laporan Rekap Surat</h2>
            </div>
        </div>
    </div>
</div>

<div class="container-xl mt-4">
    <div class="row row-deck row-cards">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Filter Laporan</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('rekap') }}" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Jenis Surat</label>
                        <select name="jenis" class="form-select">
                            <option value="semua" {{ request('jenis') == 'semua' ? 'selected' : '' }}>Semua</option>
                            <option value="surat_keterangan_tidak_mampu" {{ request('jenis') == 'surat_keterangan_tidak_mampu' ? 'selected' : '' }}>Tidak Mampu</option>
                            <option value="surat_keterangan_miskin" {{ request('jenis') == 'surat_keterangan_miskin' ? 'selected' : '' }}>Miskin</option>
                            <option value="surat_keterangan_usaha" {{ request('jenis') == 'surat_keterangan_usaha' ? 'selected' : '' }}>Usaha</option>
                            <option value="surat_keterangan_akta_nikah" {{ request('jenis') == 'surat_keterangan_akta_nikah' ? 'selected' : '' }}>Akta Nikah</option>
                            <option value="surat_pengantar_ijin_keramaian" {{ request('jenis') == 'surat_pengantar_ijin_keramaian' ? 'selected' : '' }}>Izin Keramaian</option>
                            <option value="surat_pindah_perusahaan" {{ request('jenis') == 'surat_pindah_perusahaan' ? 'selected' : '' }}>Pindah Perusahaan</option>
                            <option value="surat_beda_data" {{ request('jenis') == 'surat_beda_data' ? 'selected' : '' }}>Beda Data</option>
                            <option value="surat_bekerja_luar_negeri" {{ request('jenis') == 'surat_bekerja_luar_negeri' ? 'selected' : '' }}>Kerja Luar Negeri</option>
                            <option value="surat_keterangan_kematian" {{ request('jenis') == 'surat_keterangan_kematian' ? 'selected' : '' }}>Kematian</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Rentang Waktu</label>
                        <select name="rentang" class="form-select">
                            <option value="1bulan" {{ request('rentang') == '1bulan' ? 'selected' : '' }}>1 Bulan</option>
                            <option value="3bulan" {{ request('rentang') == '3bulan' ? 'selected' : '' }}>3 Bulan</option>
                            <option value="6bulan" {{ request('rentang') == '6bulan' ? 'selected' : '' }}>6 Bulan</option>
                            <option value="1tahun" {{ request('rentang') == '1tahun' ? 'selected' : '' }}>1 Tahun</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary w-50">Tampilkan</button>
                        <a href="{{ route('rekap.export', ['jenis' => request('jenis', 'semua'), 'rentang' => request('rentang', '1bulan')]) }}" class="btn btn-success w-50">
                            <i class="fas fa-file-csv"></i> Export Excel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- TABEL DATA --}}
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    @if($jenis === 'semua')
                        Semua Jenis Surat
                    @else
                        {{ ucwords(str_replace('_', ' ', $jenis)) }}
                    @endif
                </h3>
            </div>
            <div class="card-body">
                @if(count($rekapData))
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                @if($jenis === 'semua')
                                    <th>Jenis Surat</th>
                                @endif
                                <th>Nama Pemohon</th>
                                <th>Status</th>
                                <th>Tanggal Pengajuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekapData as $item)
                                @if(is_object($item))
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    @if($jenis === 'semua')
                                        <td>{{ ucwords(str_replace('_', ' ', $item->jenis_surat ?? '-')) }}</td>
                                    @endif
                                    <td>{{ $item->nama ?? '-' }}</td>
                                    <td>{{ ucfirst($item->status ?? '-') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="text-muted">Tidak ada data ditemukan untuk filter yang dipilih.</div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('.datatable').DataTable({
            language: {
                "emptyTable": "Tidak ada data tersedia",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "search": "Cari:",
                "zeroRecords": "Tidak ditemukan data yang cocok",
                "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Berikutnya"
                }
            }
        });
    });
</script>
@endsection

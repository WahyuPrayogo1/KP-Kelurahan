@extends('backend.master')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Surat Keterangan Beda Data Kependudukan</h4>
        </div>
        <div class="card-body">

            <div class="row">
                <!-- Kolom 1: Data Diri -->
                <div class="col-md-6">
                    <h5>Data Diri</h5>
                    <table class="table table-bordered">
                        <tr><th>Nama Lengkap</th><td>{{ $surat->nama_lengkap }}</td></tr>
                        <tr><th>NIK</th><td>{{ $surat->nik }}</td></tr>
                        <tr><th>Tempat, Tanggal Lahir</th><td>{{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d-m-Y') }}</td></tr>
                        <tr><th>Jenis Kelamin</th><td>{{ $surat->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                        <tr><th>Agama</th><td>{{ $surat->agama }}</td></tr>
                        <tr><th>Status Perkawinan</th><td>{{ $surat->status_perkawinan }}</td></tr>
                        <tr><th>Kewarganegaraan</th><td>{{ $surat->kewarganegaraan }}</td></tr>
                        <tr><th>Pekerjaan</th><td>{{ $surat->pekerjaan }}</td></tr>
                        <tr><th>Alamat</th><td>{{ $surat->alamat }}</td></tr>
                        <tr><th>RT / RW</th><td>{{ $surat->rt }} / {{ $surat->rw }}</td></tr>
                    </table>
                </div>

                <!-- Kolom 2: Informasi Perbedaan Data -->
                <div class="col-md-6">
                    <h5>Informasi Perbedaan Data</h5>
                    <table class="table table-bordered">
                        <tr><th>Lokasi Perbedaan Nama</th><td>{{ $surat->lokasi_perbedaan_nama }}</td></tr>
                        <tr><th>Status</th>
                            <td>
                                <span class="badge
                                    @if($surat->status == 'proses') bg-yellow text-yellow-fg
                                    @elseif($surat->status == 'selesai') bg-green text-green-fg
                                    @else bg-red text-red-fg
                                    @endif">
                                    {{ ucfirst($surat->status) }}
                                </span>
                            </td></tr>
                        <tr><th>Catatan</th><td>{{ $surat->catatan ?? '-' }}</td></tr>
                    </table>
                </div>
            </div>

            <h5 class="mt-4">Dokumen Pendukung</h5>
            <div class="row">
                @php
                    $dokumen = [
                        'fc_ktp' => 'Fotokopi KTP',
                        'fc_kk' => 'Fotokopi KK',
                        'surat_pernyataan_beda_data' => 'Surat Pernyataan Beda Data',
                        'bukti_beda_data' => 'Bukti Beda Data',
                        'pengantar_rt_rw' => 'Pengantar RT/RW'
                    ];
                @endphp

                @foreach ($dokumen as $field => $label)
                    @if ($surat->$field)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-header">{{ $label }}</div>
                                <div class="card-body text-center p-2">
                                    <img src="{{ route('file.preview', ['path' => $surat->$field]) }}"
                                         class="img-thumbnail cursor-pointer"
                                         style="max-height: 150px;"
                                         onclick="showImageModal('{{ route('file.preview', ['path' => $surat->$field]) }}', '{{ $label }}')">
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

          <div class="mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"> </i> Kembali
                </a>

                @role('Admin')
                <a href="{{ route('surat.preview-pdf', $surat->id) }}" class="btn btn-info">
                    <i class="fas fa-file-pdf"></i> Buat PDF
                </a>
                @endrole
            </div>

        </div>
    </div>
</div>

<!-- Modal untuk preview gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImageContent" src="" class="img-fluid" style="max-height: 80vh;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function showImageModal(imageSrc, title) {
        document.getElementById('modalImageContent').src = imageSrc;
        document.getElementById('imageModalTitle').textContent = title;
        var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    }
</script>
@endpush

<style>
    .cursor-pointer {
        cursor: pointer;
    }
</style>
@endsection

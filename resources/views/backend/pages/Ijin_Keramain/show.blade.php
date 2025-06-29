@extends('backend.master')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Surat Pengantar Ijin Keramaian</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Informasi Pemohon</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Nama Pemohon</th>
                            <td>{{ $surat->nama_pemohon }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>{{ $surat->jabatan_pemohon }}</td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td>{{ $surat->no_hp }}</td>
                        </tr>
                        <tr>
                            <th>Nama Organisasi</th>
                            <td>{{ $surat->nama_organisasi }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Organisasi</th>
                            <td>{{ $surat->alamat_organisasi }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h5>Informasi Acara</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Kegiatan</th>
                            <td>{{ $surat->mengadakan_keramain }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Hiburan</th>
                            <td>{{ $surat->hiburan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Waktu</th>
                            <td>{{ $surat->waktu }}</td>
                        </tr>
                        <tr>
                            <th>Tempat</th>
                            <td>{{ $surat->tempat }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge
                                    @if($surat->status == 'proses') bg-yellow text-yellow-fg
                                    @elseif($surat->status == 'selesai') bg-green text-green-fg
                                    @else bg-red text-red-fg
                                    @endif">
                                    {{ ucfirst($surat->status) }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <h5 class="mt-4">Dokumen Pendukung</h5>
            <div class="row">
                <!-- KTP -->
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-header">KTP</div>
                        <div class="card-body text-center p-2">
                            <img src="{{ route('file.preview', ['path' => $surat->foto_ktp]) }}"
                                 class="img-thumbnail cursor-pointer"
                                 style="max-height: 150px;"
                                 onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_ktp]) }}', 'KTP')">
                        </div>
                    </div>
                </div>

                <!-- Kartu Keluarga -->
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-header">Kartu Keluarga</div>
                        <div class="card-body text-center p-2">
                            <img src="{{ route('file.preview', ['path' => $surat->foto_kartu_keluarga]) }}"
                                 class="img-thumbnail cursor-pointer"
                                 style="max-height: 150px;"
                                 onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_kartu_keluarga]) }}', 'Kartu Keluarga')">
                        </div>
                    </div>
                </div>

                <!-- Pernyataan Tetangga -->
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-header">Pernyataan Tetangga</div>
                        <div class="card-body text-center p-2">
                            <img src="{{ route('file.preview', ['path' => $surat->foto_pernyataan_tetangga]) }}"
                                 class="img-thumbnail cursor-pointer"
                                 style="max-height: 150px;"
                                 onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_pernyataan_tetangga]) }}', 'Pernyataan Tetangga')">
                        </div>
                    </div>
                </div>

                <!-- Pengantar RT/RW -->
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-header">Pengantar RT/RW</div>
                        <div class="card-body text-center p-2">
                            <img src="{{ route('file.preview', ['path' => $surat->foto_pengantar_rt_rw]) }}"
                                 class="img-thumbnail cursor-pointer"
                                 style="max-height: 150px;"
                                 onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_pengantar_rt_rw]) }}', 'Pengantar RT/RW')">
                        </div>
                    </div>
                </div>
            </div>

            @if($surat->catatan)
            <div class="mt-3">
                <h5>Catatan</h5>
                <div class="alert alert-info">
                    {{ $surat->catatan }}
                </div>
            </div>
            @endif
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

<!-- Image Preview Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

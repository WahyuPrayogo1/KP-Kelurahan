@extends('backend.master')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-building me-2"></i>Detail Surat Keterangan Pindah Perusahaan</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="section-title"><i class="fas fa-info-circle me-2"></i>Informasi Perusahaan</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Nama Perusahaan</th>
                            <td>{{ $surat->nama_perusahaan }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pemilik</th>
                            <td>{{ $surat->nama_pemilik }}</td>
                        </tr>
                        <tr>
                            <th>Nomor TDP/Akta Notaris</th>
                            <td>{{ $surat->nomor_tdp }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Usaha</th>
                            <td>{{ $surat->jenis_usaha }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h5 class="section-title"><i class="fas fa-map-marker-alt me-2"></i>Alamat</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Alamat Perusahaan</th>
                            <td>{{ $surat->alamat_perusahaan }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Pemilik</th>
                            <td>{{ $surat->alamat_pemilik }}</td>
                        </tr>
                         <tr>
                            <th>Tanggal Pindah</th>
                            <td>{{ $surat->tanggal_pindah }}</td>
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

            <h5 class="section-title mt-4"><i class="fas fa-file-alt me-2"></i>Dokumen Pendukung</h5>
            <div class="row">
                <!-- KTP Pemilik -->
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <div class="card-header ">KTP Pemilik</div>
                        <div class="card-body text-center p-2">
                            <img src="{{ route('file.preview', ['path' => $surat->foto_ktp]) }}"
                                 class="img-thumbnail cursor-pointer"
                                 style="max-height: 150px;"
                                 onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_ktp]) }}', 'KTP Pemilik')">
                        </div>
                    </div>
                </div>

                <!-- Kartu Keluarga -->
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <div class="card-header ">Kartu Keluarga</div>
                        <div class="card-body text-center p-2">
                            <img src="{{ route('file.preview', ['path' => $surat->foto_kk]) }}"
                                 class="img-thumbnail cursor-pointer"
                                 style="max-height: 150px;"
                                 onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_kk]) }}', 'Kartu Keluarga')">
                        </div>
                    </div>
                </div>

                <!-- Pernyataan Pindah -->
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <div class="card-header ">Pernyataan Pindah</div>
                        <div class="card-body text-center p-2">
                            <img src="{{ route('file.preview', ['path' => $surat->foto_pernyataan_pindah]) }}"
                                 class="img-thumbnail cursor-pointer"
                                 style="max-height: 150px;"
                                 onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_pernyataan_pindah]) }}', 'Pernyataan Pindah')">
                        </div>
                    </div>
                </div>

                <!-- Akte Notaris -->
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <div class="card-header ">Akte Notaris</div>
                        <div class="card-body text-center p-2">
                            <img src="{{ route('file.preview', ['path' => $surat->foto_akte_notaris]) }}"
                                 class="img-thumbnail cursor-pointer"
                                 style="max-height: 150px;"
                                 onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_akte_notaris]) }}', 'Akte Notaris')">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengantar RT/RW -->
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <div class="card-header ">Pengantar RT/RW</div>
                        <div class="card-body text-center p-2">
                            <img src="{{ route('file.preview', ['path' => $surat->foto_pengantar_rt_rw]) }}"
                                 class="img-thumbnail cursor-pointer"
                                 style="max-height: 150px;"
                                 onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_pengantar_rt_rw]) }}', 'Pengantar RT/RW')">
                        </div>
                    </div>
                </div>
            </div>

             @if ($surat->status === 'ditolak' && $surat->catatan)
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
                        <a href="{{ route('surat-pindah-perusahaan.preview-pdf', $surat->id) }}" class="btn btn-info">
                            <i class="fas fa-file-pdf"></i> Buat PDF
                        </a>
                    @endrole
                </div>
        </div>
    </div>
</div>

<!-- Image Preview Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="imageModalTitle"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImageContent" src="" class="img-fluid" style="max-height: 70vh;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function showImageModal(imageSrc, title) {
        document.getElementById('modalImageContent').src = imageSrc;
        document.getElementById('imageModalTitle').textContent = title;
        new bootstrap.Modal(document.getElementById('imageModal')).show();
    }
</script>
@endpush

@push('styles')
<style>
    .section-title {
        border-bottom: 2px solid #0d6efd;
        padding-bottom: 5px;
        margin-bottom: 20px;
        color: #0d6efd;
    }
    .cursor-pointer {
        cursor: pointer;
    }
    .card-header. {
        background-color: #f8f9fa !important;
    }
</style>
@endpush

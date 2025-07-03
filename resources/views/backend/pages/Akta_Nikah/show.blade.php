@extends('backend.master')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Surat Keterangan Status Nikah</h4>
        </div>
        <div class="card-body">
            <h5>Informasi Pemohon</h5>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th width="20%">Nama</th>
                        <td width="30%">{{ $surat->nama }}</td>
                        <th width="20%">NIK</th>
                        <td width="30%">{{ $surat->nik }}</td>
                    </tr>
                    <tr>
                        <th>Tempat Lahir</th>
                        <td>{{ $surat->tempat_lahir }}</td>
                        <th>Tanggal Lahir</th>
                        <td>{{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $surat->jenis_kelamin }}</td>
                        <th>Agama</th>
                        <td>{{ $surat->agama }}</td>
                    </tr>
                    <tr>
                        <th>Status Perkawinan</th>
                        <td>{{ $surat->status_perkawinan }}</td>
                        <th>Pekerjaan</th>
                        <td>{{ $surat->pekerjaan }}</td>
                    </tr>
                    <tr>
                        <th>Kewarganegaraan</th>
                        <td>{{ $surat->kewarganegaraan }}</td>
                        <th>Alamat Lengkap</th>
                        <td>{{ $surat->alamat_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pengantar RT/RW</th>
                        <td>{{ \Carbon\Carbon::parse($surat->tanggal_pengantar_rt_rw)->format('d-m-Y') }}</td>
                        <th>Tanggal Dikeluarkan</th>
                        <td>{{ \Carbon\Carbon::parse($surat->tanggal_dikeluarkan)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td colspan="3">
                            <span class="badge
                                @if($surat->status == 'proses') bg-warning text-dark
                                @elseif($surat->status == 'selesai') bg-success text-white
                                @else bg-danger text-white
                                @endif">
                                {{ ucfirst($surat->status) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Dokumen Pendukung -->
            <h5 class="mt-4">Dokumen Pendukung</h5>
            <div class="row">

                <!-- Foto KTP -->
                <div class="col-md-6 mb-3">
                    <label for="foto_ktp" class="form-label">Foto KTP</label>
                    <input type="file" name="foto_ktp" id="foto_ktp" class="form-control mb-2" accept="image/jpeg,image/png">
                    @if($surat->foto_ktp)
                        <div class="text-center">
                            <p class="small text-muted">File saat ini:</p>
                            <img src="{{ route('file.preview', ['path' => $surat->foto_ktp]) }}"
                                 alt="Foto KTP" class="img-thumbnail cursor-pointer"
                                 onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_ktp]) }}', 'Foto KTP')">
                        </div>
                    @endif
                </div>

                <!-- Foto KK -->
                <div class="col-md-6 mb-3">
                    <label for="foto_kartu_keluarga" class="form-label">Foto Kartu Keluarga</label>
                    <input type="file" name="foto_kartu_keluarga" id="foto_kartu_keluarga" class="form-control mb-2" accept="image/jpeg,image/png">
                    @if($surat->foto_kartu_keluarga)
                        <div class="text-center">
                            <p class="small text-muted">File saat ini:</p>
                            <img src="{{ route('file.preview', ['path' => $surat->foto_kartu_keluarga]) }}"
                                 alt="Foto KK" class="img-thumbnail cursor-pointer"
                                 onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_kartu_keluarga]) }}', 'Foto KK')">
                        </div>
                    @endif
                </div>

                <!-- Surat Pernyataan Nikah -->
                <div class="col-md-6 mb-3">
                    <label for="foto_surat_pernyataan_nikah" class="form-label">Surat Pernyataan Nikah</label>
                    <input type="file" name="foto_surat_pernyataan_nikah" id="foto_surat_pernyataan_nikah" class="form-control mb-2" accept="image/jpeg,image/png">
                    @if($surat->foto_surat_pernyataan_nikah)
                        <div class="text-center">
                            <p class="small text-muted">File saat ini:</p>
                            <img src="{{ route('file.preview', ['path' => $surat->foto_surat_pernyataan_nikah]) }}"
                                 alt="Surat Pernyataan Nikah" class="img-thumbnail cursor-pointer"
                                 onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_surat_pernyataan_nikah]) }}', 'Surat Pernyataan Nikah')">
                        </div>
                    @endif
                </div>

                <!-- Surat Pengantar RT/RW -->
                <div class="col-md-6 mb-3">
                    <label for="foto_surat_pengantar_rt_rw" class="form-label">Surat Pengantar RT/RW</label>
                    <input type="file" name="foto_surat_pengantar_rt_rw" id="foto_surat_pengantar_rt_rw" class="form-control mb-2" accept="image/jpeg,image/png">
                    @if($surat->foto_surat_pengantar_rt_rw)
                        <div class="text-center">
                            <p class="small text-muted">File saat ini:</p>
                            <img src="{{ route('file.preview', ['path' => $surat->foto_surat_pengantar_rt_rw]) }}"
                                 alt="Surat Pengantar RT/RW" class="img-thumbnail cursor-pointer"
                                 onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_surat_pengantar_rt_rw]) }}', 'Surat Pengantar RT/RW')">
                        </div>
                    @endif
                </div>
            </div>

            <!-- Catatan -->
           @if($surat->status === 'ditolak' && $surat->catatan)
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
                <a href="{{ route('keterangan_akta_nikah.preview-pdf', $surat->id) }}" class="btn btn-info">
                    <i class="fas fa-file-pdf"></i> Buat PDF
                </a>
                @endrole
            </div>

        </div>
    </div>
</div>

<!-- Modal Preview Gambar -->
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
@endsection

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

@push('styles')
<style>
    .cursor-pointer {
        cursor: pointer;
    }
</style>
@endpush

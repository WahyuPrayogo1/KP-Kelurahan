@extends('backend.master')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Surat Keterangan Kematian</h4>
        </div>
        <div class="card-body">
            <h5>Informasi Pemohon</h5>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th width="20%">Nama</th>
                        <td width="30%">{{ $surat->nama }}</td>
                        <th width="20%">Jenis Kelamin</th>
                        <td width="30%">{{ $surat->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Lengkap</th>
                        <td>{{ $surat->alamat_lengkap }}</td>
                        <th>Tempat Lahir</th>
                        <td>{{ $surat->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d-m-Y') }}</td>
                        <th>Tempat Meninggal</th>
                        <td>{{ $surat->tempat_meninggal }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Meninggal</th>
                        <td>{{ \Carbon\Carbon::parse($surat->tanggal_meninggal)->format('d-m-Y') }}</td>
                        <th>Penyebab Kematian</th>
                        <td>{{ $surat->penyebab_kematian }}</td>
                    </tr>
                    <tr>
                        <th>Kewarganegaraan</th>
                        <td>{{ $surat->kewarganegaraan }}</td>
                        <th>Agama</th>
                        <td>{{ $surat->agama }}</td>
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

            <h5 class="mt-4">Dokumen Pendukung</h5>
            <div class="row">
                <!-- Foto KTP -->
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-header">Foto KTP</div>
                        <div class="card-body text-center p-2">
                            @if($surat->fc_ktp)
                                <img src="{{ route('file.preview', ['path' => $surat->fc_ktp]) }}"
                                alt="Foto KTP" class="file-preview img-thumbnail cursor-pointer"
                                onclick="showImageModal('{{ route('file.preview', ['path' => $surat->fc_ktp]) }}', 'Foto KTP')">
                            @else
                                <p class="text-muted">Tidak ada file</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Foto Kartu Keluarga -->
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-header">Foto Kartu Keluarga</div>
                        <div class="card-body text-center p-2">
                            @if($surat->fc_kk)
                                <img src="{{ route('file.preview', ['path' => $surat->fc_kk]) }}"
                                alt="Foto KK" class="file-preview img-thumbnail cursor-pointer"
                                onclick="showImageModal('{{ route('file.preview', ['path' => $surat->fc_kk]) }}', 'Foto Kartu Keluarga')">
                            @else
                                <p class="text-muted">Tidak ada file</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Foto Buku Nikah -->
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-header">Foto Buku Nikah</div>
                        <div class="card-body text-center p-2">
                            @if($surat->fc_buku_nikah)
                                <img src="{{ route('file.preview', ['path' => $surat->fc_buku_nikah]) }}"
                                alt="Foto Buku Nikah" class="file-preview img-thumbnail cursor-pointer"
                                onclick="showImageModal('{{ route('file.preview', ['path' => $surat->fc_buku_nikah]) }}', 'Foto Buku Nikah')">
                            @else
                                <p class="text-muted">Tidak ada file</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Foto Surat Pengantar Kematian RT/RW -->
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-header">Foto Surat Pengantar Kematian RT/RW</div>
                        <div class="card-body text-center p-2">
                            @if($surat->pengantar_kematian_rt_rw)
                                <img src="{{ route('file.preview', ['path' => $surat->pengantar_kematian_rt_rw]) }}"
                                alt="Surat Pengantar Kematian RT/RW" class="file-preview img-thumbnail cursor-pointer"
                                onclick="showImageModal('{{ route('file.preview', ['path' => $surat->pengantar_kematian_rt_rw]) }}', 'FSurat Pengantar Kematian RT/RW')">
                            @else
                                <p class="text-muted">Tidak ada file</p>
                            @endif
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
                <a href="{{ route('surat_keterangan_kematian.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('surat_keterangan_kematian.preview-pdf', $surat->id) }}" class="btn btn-info">
                    <i class="fas fa-file-pdf"></i> Buat PDF
                </a>
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

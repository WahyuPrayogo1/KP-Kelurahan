@extends('backend.master')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Detail Surat Keterangan Bekerja di Luar Negeri</h4>
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
                                <th>NIK Pemohon</th>
                                <td>{{ $surat->nik_pemohon }}</td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td>{{ $surat->tempat_lahir_pemohon }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ \Carbon\Carbon::parse($surat->tanggal_lahir_pemohon)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <td>{{ $surat->pekerjaan_pemohon }}</td>
                            </tr>
                            <tr>
                                <th>Status Perkawinan</th>
                                <td>{{ $surat->status_perkawinan_pemohon }}</td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>{{ $surat->agama_pemohon }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $surat->alamat_pemohon }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h5>Informasi Pekerja</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Hubungan dengan Pekerja</th>
                                <td>{{ ucfirst($surat->hubungan_dengan_pekerja) }}</td>
                            </tr>
                            <tr>
                                <th>Nama Pekerja</th>
                                <td>{{ $surat->nama_pekerja }}</td>
                            </tr>
                            <tr>
                                <th>NIK Pekerja</th>
                                <td>{{ $surat->nik_pekerja }}</td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td>{{ $surat->tempat_lahir_pekerja }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ \Carbon\Carbon::parse($surat->tanggal_lahir_pekerja)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $surat->jenis_kelamin_pekerja == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                            <tr>
                                <th>Kewarganegaraan</th>
                                <td>{{ $surat->kewarganegaraan_pekerja }}</td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>{{ $surat->agama_pekerja }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $surat->alamat_pekerja }}</td>
                            </tr>
                            <tr>
                                <th>Negara Tujuan</th>
                                <td>{{ $surat->negara_tujuan }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span
                                        class="badge
                                    @if ($surat->status == 'proses') bg-yellow text-yellow-fg
                                    @elseif($surat->status == 'selesai') bg-green text-green-fg
                                    @else bg-red text-red-fg @endif">
                                        {{ ucfirst($surat->status) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <h5 class="mt-4">Dokumen Pendukung</h5>
                <div class="row">
                    <!-- FC KTP -->
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-header">FC KTP</div>
                            <div class="card-body text-center p-2">
                                @if ($surat->fc_ktp)
                                    <img src="{{ route('file.preview', ['path' => $surat->fc_ktp]) }}"
                                        class="img-thumbnail cursor-pointer" style="max-height: 150px;"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->fc_ktp]) }}', 'FC KTP')">
                                @else
                                    <p class="text-muted">Tidak ada file</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- FC KK -->
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-header">FC Kartu Keluarga</div>
                            <div class="card-body text-center p-2">
                                @if ($surat->fc_kk)
                                    <img src="{{ route('file.preview', ['path' => $surat->fc_kk]) }}"
                                        class="img-thumbnail cursor-pointer" style="max-height: 150px;"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->fc_kk]) }}', 'FC Kartu Keluarga')">
                                @else
                                    <p class="text-muted">Tidak ada file</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Surat Pernyataan Bekerja -->
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-header">Surat Pernyataan Bekerja</div>
                            <div class="card-body text-center p-2">
                                @if ($surat->surat_pernyataan_bekerja)
                                    <img src="{{ route('file.preview', ['path' => $surat->surat_pernyataan_bekerja]) }}"
                                        class="img-thumbnail cursor-pointer" style="max-height: 150px;"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->surat_pernyataan_bekerja]) }}', 'Surat Pernyataan Bekerja')">
                                @else
                                    <p class="text-muted">Tidak ada file</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Pengantar RT/RW -->
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-header">Pengantar RT/RW</div>
                            <div class="card-body text-center p-2">
                                @if ($surat->pengantar_rt_rw)
                                    <img src="{{ route('file.preview', ['path' => $surat->pengantar_rt_rw]) }}"
                                        class="img-thumbnail cursor-pointer" style="max-height: 150px;"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->pengantar_rt_rw]) }}', 'Pengantar RT/RW')">
                                @else
                                    <p class="text-muted">Tidak ada file</p>
                                @endif
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
                        <a href="{{ route('surat-bekerja-luar-negeri.preview-pdf', $surat->id) }}" class="btn btn-info">
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

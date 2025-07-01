@extends('backend.master')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
              @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sukses!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Surat Keterangan Bekerja Luar Negeri</h4>
                </div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Oops!</strong> Ada masalah dengan input Anda.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('surat-bekerja-luar-negeri.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Data Pemohon --}}
                        <h5 class="mb-3 border-bottom pb-2 text-primary">Data Pemohon</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Pemohon</label>
                                <input type="text" name="nama_pemohon" class="form-control" value="{{ old('nama_pemohon', $surat->nama_pemohon) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIK Pemohon</label>
                                <input type="text" name="nik_pemohon" class="form-control" maxlength="16" value="{{ old('nik_pemohon', $surat->nik_pemohon) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tempat Lahir Pemohon</label>
                                <input type="text" name="tempat_lahir_pemohon" class="form-control" value="{{ old('tempat_lahir_pemohon', $surat->tempat_lahir_pemohon) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir Pemohon</label>
                                <input type="date" name="tanggal_lahir_pemohon" class="form-control" value="{{ old('tanggal_lahir_pemohon', $surat->tanggal_lahir_pemohon) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pekerjaan Pemohon</label>
                                <input type="text" name="pekerjaan_pemohon" class="form-control" value="{{ old('pekerjaan_pemohon', $surat->pekerjaan_pemohon) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Perkawinan</label>
                                <input type="text" name="status_perkawinan_pemohon" class="form-control" value="{{ old('status_perkawinan_pemohon', $surat->status_perkawinan_pemohon) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Agama Pemohon</label>
                                <input type="text" name="agama_pemohon" class="form-control" value="{{ old('agama_pemohon', $surat->agama_pemohon) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hubungan dengan Pekerja</label>
                                <select name="hubungan_dengan_pekerja" class="form-select" required>
                                    <option value="">-- Pilih Hubungan --</option>
                                    @foreach(['orang tua', 'suami', 'istri', 'anak', 'saudara'] as $option)
                                        <option value="{{ $option }}" {{ old('hubungan_dengan_pekerja', $surat->hubungan_dengan_pekerja) == $option ? 'selected' : '' }}>{{ ucfirst($option) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-mb-3 mb-3">
                                <label class="form-label">Alamat Pemohon</label>
                                <textarea name="alamat_pemohon" class="form-control" rows="2" required>{{ old('alamat_pemohon', $surat->alamat_pemohon) }}</textarea>
                            </div>
                        </div>

                        {{-- Data Pekerja --}}
                        <h5 class="mt-4 mb-3 border-bottom pb-2 text-primary">Data Pekerja</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Pekerja</label>
                                <input type="text" name="nama_pekerja" class="form-control" value="{{ old('nama_pekerja', $surat->nama_pekerja) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIK Pekerja</label>
                                <input type="text" name="nik_pekerja" class="form-control" maxlength="16" value="{{ old('nik_pekerja', $surat->nik_pekerja) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir_pekerja" class="form-control" value="{{ old('tempat_lahir_pekerja', $surat->tempat_lahir_pekerja) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir_pekerja" class="form-control" value="{{ old('tanggal_lahir_pekerja', $surat->tanggal_lahir_pekerja) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin_pekerja" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="L" {{ old('jenis_kelamin_pekerja', $surat->jenis_kelamin_pekerja) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin_pekerja', $surat->jenis_kelamin_pekerja) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kewarganegaraan</label>
                                <input type="text" name="kewarganegaraan_pekerja" class="form-control" value="{{ old('kewarganegaraan_pekerja', $surat->kewarganegaraan_pekerja) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Agama</label>
                                <input type="text" name="agama_pekerja" class="form-control" value="{{ old('agama_pekerja', $surat->agama_pekerja) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Negara Tujuan</label>
                                <input type="text" name="negara_tujuan" class="form-control" value="{{ old('negara_tujuan', $surat->negara_tujuan) }}" required>
                            </div>
                            <div class="col-mb-3 mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat_pekerja" class="form-control" rows="2" required>{{ old('alamat_pekerja', $surat->alamat_pekerja) }}</textarea>
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3 border-bottom pb-2 text-primary">Upload Dokumen Pendukung</h5>
                        <div class="row">
                            <!-- FC KTP -->
                            <div class="col-md-6 mb-4">
                                <label for="fc_ktp" class="form-label">Foto/Scan KTP</label>
                                <input type="file" name="fc_ktp" id="fc_ktp" class="form-control mb-2" accept="image/*">
                                @if($surat->fc_ktp)
                                <div class="file-preview-container text-center">
                                    <p class="small text-muted">File saat ini:</p>
                                    <img src="{{ route('file.preview', ['path' => $surat->fc_ktp]) }}"
                                        class="file-preview img-thumbnail"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->fc_ktp]) }}', 'Foto KTP')">
                                </div>
                                @endif
                            </div>

                            <!-- FC KK -->
                            <div class="col-md-6 mb-4">
                                <label for="fc_kk" class="form-label">Foto/Scan Kartu Keluarga</label>
                                <input type="file" name="fc_kk" id="fc_kk" class="form-control mb-2" accept="image/*">
                                @if($surat->fc_kk)
                                <div class="file-preview-container text-center">
                                    <p class="small text-muted">File saat ini:</p>
                                    <img src="{{ route('file.preview', ['path' => $surat->fc_kk]) }}"
                                        class="file-preview img-thumbnail"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->fc_kk]) }}', 'Foto KK')">
                                </div>
                                @endif
                            </div>

                            <!-- Surat Pernyataan Bekerja -->
                            <div class="col-md-6 mb-4">
                                <label for="surat_pernyataan_bekerja" class="form-label">Surat Pernyataan Bekerja</label>
                                <input type="file" name="surat_pernyataan_bekerja" id="surat_pernyataan_bekerja" class="form-control mb-2" accept="image/*">
                                @if($surat->surat_pernyataan_bekerja)
                                <div class="file-preview-container text-center">
                                    <p class="small text-muted">File saat ini:</p>
                                    <img src="{{ route('file.preview', ['path' => $surat->surat_pernyataan_bekerja]) }}"
                                        class="file-preview img-thumbnail"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->surat_pernyataan_bekerja]) }}', 'Surat Pernyataan Bekerja')">
                                </div>
                                @endif
                            </div>

                            <!-- Pengantar RT/RW -->
                            <div class="col-md-6 mb-4">
                                <label for="pengantar_rt_rw" class="form-label">Pengantar RT/RW</label>
                                <input type="file" name="pengantar_rt_rw" id="pengantar_rt_rw" class="form-control mb-2" accept="image/*">
                                @if($surat->pengantar_rt_rw)
                                <div class="file-preview-container text-center">
                                    <p class="small text-muted">File saat ini:</p>
                                    <img src="{{ route('file.preview', ['path' => $surat->pengantar_rt_rw]) }}"
                                        class="file-preview img-thumbnail"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->pengantar_rt_rw]) }}', 'Pengantar RT/RW')">
                                </div>
                                @endif
                            </div>
                        </div>


                         <!-- Status dan Catatan Section -->
                         @role('Admin')
                         <h5 class="section-title"><i class="fas fa-cog me-2"></i>Status & Catatan</h5>
                                <!-- Jika Admin, tampilkan dropdown status -->
                                <div class="col-md-12 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="proses" {{ $surat->status == 'proses' ? 'selected' : '' }}>Proses
                                        </option>
                                        <option value="selesai" {{ $surat->status == 'selesai' ? 'selected' : '' }}>Selesai
                                        </option>
                                        <option value="ditolak" {{ $surat->status == 'ditolak' ? 'selected' : '' }}>Ditolak
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="catatan" class="form-label">Catatan Tambahan</label>
                                    <textarea name="catatan" class="form-control" placeholder="Opsional">{{ $surat->catatan }}</textarea>
                                </div>
                            @else

                                <!-- Jika bukan admin, set default status "proses" lewat input hidden -->
                                <input type="hidden" name="status" value="proses">
                            @endrole

                            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
    @role('Admin')
        <a href="{{ route('surat-bekerja-luar-negeri.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    @else
        <a href="{{ route('surat.saya') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    @endrole

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-2"></i>Simpan Perubahan
    </button>
</div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
function showImageModal(imageUrl, title) {
    const modal = document.createElement("div");
    modal.classList.add("modal", "fade");
    modal.innerHTML = `
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">${title}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="${imageUrl}" class="img-fluid rounded">
                </div>
            </div>
        </div>`;
    document.body.appendChild(modal);
    const bsModal = new bootstrap.Modal(modal);
    bsModal.show();
    modal.addEventListener('hidden.bs.modal', () => modal.remove());
}
</script>

@endsection

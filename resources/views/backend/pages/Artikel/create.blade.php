@extends('backend.master')

@section('content')
<div class="container-xl mt-5">
    <div class="row row-deck row-cards">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Artikel</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Judul -->
                        <div class="form-group mb-3">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control" required>
                        </div>

                        <!-- Isi Artikel -->
                        <div class="form-group mb-3">
                            <label for="isi">Isi Artikel</label>
                            <textarea name="isi" id="isi" class="form-control" rows="5" required></textarea>
                        </div>

                        <!-- Gambar -->
                        <div class="form-group mb-3">
                            <label for="gambar">Gambar (Opsional)</label>
                            <input type="file" name="gambar" id="gambar" class="form-control">
                        </div>

                        <!-- Tombol Submit -->
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('artikel.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

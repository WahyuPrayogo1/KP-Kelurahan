@extends('backend.master')

@section('content')
<div class="container-xl mt-5">
    <div class="row row-deck row-cards">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Artikel</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $artikel->judul) }}" required>
                        </div>

                        {{-- Isi Artikel --}}
                        <div class="mb-3">
                            <label for="isi" class="form-label">Isi Artikel</label>
                            <textarea name="isi" id="isi" class="form-control" rows="6" required>{{ old('isi', $artikel->isi) }}</textarea>
                        </div>

                        {{-- Gambar --}}
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar (Opsional)</label>
                            <input type="file" name="gambar" id="gambar" class="form-control">

                            @if($artikel->gambar)
                                <div class="mt-3">
                                    <label class="form-label">Gambar Lama:</label><br>
                                    <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Gambar Artikel" class="img-thumbnail" width="150">
                                </div>
                            @endif
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('artikel.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

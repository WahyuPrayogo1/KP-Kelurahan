@extends('backend.master')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h2>Tambah Data Pekerjaan</h2>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Terjadi kesalahan!</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('pekerjaan.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="sektor_id" class="form-label">Sektor Pekerjaan</label>
                                <select name="sektor_id" class="form-control" required>
                                    <option value="">-- Pilih Sektor --</option>
                                    @foreach($sektors as $sektor)
                                        <option value="{{ $sektor->id }}">{{ $sektor->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pekerjaan</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('pekerjaan.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

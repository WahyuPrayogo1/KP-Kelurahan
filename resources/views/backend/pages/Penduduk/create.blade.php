@extends('backend.master')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                    <h2>Tambah Data Penduduk</h2>
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
                    <form action="{{ route('penduduk.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="laki_laki" class="form-label">Laki-laki</label>
                            <input type="number" name="laki_laki" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="perempuan" class="form-label">Perempuan</label>
                            <input type="number" name="perempuan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <input type="text" name="tahun" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('penduduk.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

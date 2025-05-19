@extends('backend.master')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h2>Edit Sektor Pekerjaan</h2>
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
                        <form action="{{ route('sektor-pekerjaan.update', $sektorPekerjaan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Sektor</label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama', $sektorPekerjaan->nama) }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                            <a href="{{ route('sektor-pekerjaan.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app') {{-- Ganti sesuai master layout kamu --}}

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h1 class="mb-3 text-purple" style="font-weight: 700;">{{ $artikel->judul }}</h1>
                    <p class="text-muted mb-4" style="font-size: 14px;">Dipublikasikan pada {{ $artikel->created_at->format('d M Y') }}</p>

                    @if($artikel->gambar)
                        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="img-fluid rounded mb-4">
                    @endif

                    <div class="content" style="line-height: 1.7; font-size: 16px;">
                        {!! $artikel->isi !!}
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-pill">
                    ← Kembali ke Berita
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb" style="font-size: 14px">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}" class="text-decoration-none text-muted">Beranda</a>
            </li>
            <li class="breadcrumb-item ">
                <a href="{{ route('berita.list') }}" class="text-decoration-none text-muted">Artikel</a>
            </li>
        </ol>
    </nav>
    <section class="artikel-list">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="fw-bold text-uppercase" style="color: #6F3A68; letter-spacing: 2px;">
                    Artikel & Berita Terbaru
                </h2>
                <p class="text-muted mt-2" style="font-size: 15px;">
                    Temukan informasi terbaru seputar Kelurahan Subangjaya Sukabumi.
                </p>
            </div>
        </div>

        @if($artikels->isEmpty())
            <div class="text-center py-5">
                <div class="d-flex justify-content-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#6F3A68" class="bi bi-newspaper" viewBox="0 0 16 16">
                        <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
                        <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
                    </svg>
                </div>
                <h5 class="fw-semibold mb-2" style="color: #6F3A68;">Belum ada artikel tersedia</h5>
                <p class="text-muted">Silakan kembali lagi nanti untuk melihat artikel terbaru</p>
                <a href="{{ url('/') }}" class="btn btn-purple mt-3 px-4 py-2" style="background-color: #6F3A68; color: white;">
                    Kembali ke Beranda
                </a>
            </div>
        @else
            <div class="row g-4">
                @foreach ($artikels as $artikel)
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="card border-1 shadow-sm h-100">
                            <div class="ratio ratio-4x3">
                                <img src="{{ asset('storage/' . $artikel->gambar) }}"
                                     class="img-fluid object-fit-cover rounded-top" alt="{{ $artikel->judul }}">
                            </div>
                            <div class="card-body d-flex flex-column p-3">
                                <h5 class="card-title fw-semibold text-dark"
                                    style="font-size: 16px; line-height: 1.4em; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $artikel->judul }}
                                </h5>

                                <div class="mb-2 text-muted" style="font-size: 13px;">
                                    <i class="bi bi-person-circle me-1"></i>
                                    {{ $artikel->user->name ?? 'Admin' }} &middot;
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $artikel->created_at->format('d M Y') }}
                                </div>

                                <p class="card-text flex-grow-1 text-muted"
                                   style="font-size: 14px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                    {!! Str::limit(strip_tags($artikel->isi), 120) !!}
                                </p>

                                <div class="mt-3">
                                    <a href="{{ route('berita.detail', $artikel->id) }}"
                                       class="text-decoration-none fw-semibold" style="color: #6F3A68; font-size: 14px;">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection

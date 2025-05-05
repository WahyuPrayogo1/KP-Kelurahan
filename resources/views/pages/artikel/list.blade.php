@extends('layouts.app')
@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4" >
        <ol class="breadcrumb" style="font-size: 14px">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}" class="text-decoration-none text-muted">Home</a>
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
    </section>
</div>
@endsection

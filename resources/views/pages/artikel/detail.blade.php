@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <!-- Meta Info -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>

                            <span class="text-muted">
                                <i class="far fa-clock me-1"></i>
                                {{ $artikel->created_at->format('d M Y') }} •
                                {{ $artikel->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="share-buttons">
                            <button class="btn btn-sm btn-outline-secondary rounded-circle me-2">
                                <i class="fab fa-facebook-f"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary rounded-circle me-2">
                                <i class="fab fa-twitter"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary rounded-circle">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Judul -->
                    <h1 class="mb-3" style="font-weight: 700; color: #2c3e50;">{{ $artikel->judul }}</h1>

                    <!-- Gambar Utama -->
                    @if($artikel->gambar)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $artikel->gambar) }}"
                             alt="{{ $artikel->judul }}"
                             class="img-fluid rounded-3 shadow-sm w-100"
                             style="max-height: 500px; object-fit: cover;">
                        <p class="text-center text-muted mt-2" style="font-size: 14px;">
                            <em>{{ $artikel->judul }}</em>
                        </p>
                    </div>
                    @endif

                    <!-- Konten -->
                    <div class="content article-body">
                        {!! $artikel->isi !!}
                    </div>

                    <!-- Author -->
                    <div class="d-flex align-items-center mt-5 pt-4 border-top">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('images/Default.png') }}"
                                 class="rounded-circle"
                                 width="60"
                                 alt="Author">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1">Admin</h5>
                            <p class="text-muted mb-0">Penulis Artikel</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            @if($relatedArticles->count() > 0)
            <div class="mt-5">
                <h4 class="mb-4" style="font-weight: 600;">Artikel Terkait</h4>
                <div class="row">
                    @foreach($relatedArticles as $related)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm rounded-3">
                            @if($related->gambar)
                            <img src="{{ asset('storage/' . $related->gambar) }}"
                                 class="card-img-top"
                                 style="height: 180px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ Str::limit($related->judul, 50) }}</h5>
                                <a href="{{ route('berita.detail', $related->id) }}" class="stretched-link"></a>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <small class="text-muted">{{ $related->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Tombol Kembali -->
            <div class="mt-4 text-center">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Berita
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .article-body {
        color: #333;
        line-height: 1.8;
        font-size: 1.1rem;
    }
    .article-body p {
        margin-bottom: 1.5rem;
    }
    .article-body img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5rem 0;
    }
    .article-body h2,
    .article-body h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #2c3e50;
        font-weight: 600;
    }
    .article-body blockquote {
        border-left: 4px solid #6c5ce7;
        padding-left: 1.5rem;
        margin-left: 0;
        font-style: italic;
        color: #555;
    }
    .bg-purple-light {
        background-color: #f3f0ff;
    }
    .text-purple {
        color: #6c5ce7;
    }
</style>
@endsection

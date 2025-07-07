@extends('backend.master')

@section('content')
@push('styles')
<style>
    #editor {
        min-height: 300px;
    }
    .ck-editor__editable {
        min-height: 500px;
    }
</style>
@endpush
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
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>

                        <!-- Isi Artikel -->
                        <div class="mb-3">
                            <label class="form-label">Isi Artikel</label>
                           <textarea name="isi" id="editor" class="form-control" style="min-height:300px"></textarea>
<!-- Hapus atribut 'required' -->
                        </div>

                        <!-- Gambar -->
                        <div class="mb-3">
                            <label class="form-label">Gambar (Opsional)</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>

                        <!-- Tombol Submit -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('artikel.index') }}" class="btn btn-secondary ms-2">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor.create(document.querySelector('#editor'), {
            minHeight: '500px',
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'link', 'bulletedList', 'numberedList',
                'blockQuote', 'insertTable', 'undo', 'redo'
            ]
        })
        .catch(error => {
            console.error('CKEditor error:', error);
        });
    });
</script>
@endpush




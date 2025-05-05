<a href="{{ route('artikel.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>

<button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $row->id }})">Hapus</button>

<form id="delete-form-{{ $row->id }}" action="{{ route('artikel.destroy', $row->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Artikel yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endpush

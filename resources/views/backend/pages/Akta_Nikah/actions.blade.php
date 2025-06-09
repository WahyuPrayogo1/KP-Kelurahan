<!-- Action Buttons in your table cell -->
<td class="text-center">
    <!-- Detail Button -->
    <a href="{{ route('keterangan_akta_nikah.show', $row->id) }}" class="btn btn-sm btn-info" title="Detail">
        <i class="fas fa-eye"></i>
    </a>

    <!-- Edit Button -->
    <a href="{{ route('keterangan_akta_nikah.edit', $row->id) }}" class="btn btn-sm btn-warning" title="Edit">
        <i class="fas fa-edit"></i>
    </a>

    <!-- Delete Button -->
    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $row->id }})" title="Hapus">
        <i class="fas fa-trash"></i>
    </button>

    <!-- Hidden Delete Form -->
    <form id="delete-form-{{ $row->id }}" action="{{ route('keterangan_akta_nikah.destroy', $row->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</td>

<!-- SweetAlert Delete Confirmation -->
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan data ini!",
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

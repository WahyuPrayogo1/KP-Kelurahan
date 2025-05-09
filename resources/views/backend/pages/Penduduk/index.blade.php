@extends('backend.master')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Dashboard
                </div>
                <h2 class="page-title pb-2">
                    Statistik Penduduk
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <!-- Tombol Export CSV -->
                    <a href="{{ route('penduduk.export') }}" class="btn btn-success mb-3">
                        <i class="fas fa-file-csv"></i> Export CSV
                    </a>
                    <!-- Tombol Tambah Statistik -->
                    <a href="{{ route('penduduk.create') }}" class="btn btn-primary mb-3">
                        <i class="fas fa-plus"></i> Tambah Statistik
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="container-xl mt-5">
        <div class="row row-deck row-cards">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Statistik Penduduk</h3>
                </div>
                <div class="card-body">
                    <div id="table-default" class="table-responsive">
                        <table id="penduduk" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Laki-laki</th>
                                    <th>Perempuan</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#penduduk').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('penduduk.index') }}',
                language: {
                    "emptyTable": "Tidak ada data yang tersedia",
                    "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                    "infoFiltered": "(terfilter dari _MAX_ total entri)",
                    "paginate": {
                        "previous": "Sebelumnya",
                        "next": "Berikutnya"
                    }
                },
                columns: [
                    {
                        data: null,
                        name: 'nomor',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: 'tahun', name: 'tahun' },
                    { data: 'laki_laki', name: 'laki_laki' },
                    { data: 'perempuan', name: 'perempuan' },
                    {
                        data: null,
                        name: 'total',
                        render: function(data, type, row) {
                            return parseInt(row.laki_laki) + parseInt(row.perempuan);
                        },
                        orderable: false,
                        searchable: false
                    },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
                ]
            });

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data tidak dapat dikembalikan!",
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
            });
        }
    </script>
@endsection

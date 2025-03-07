@extends('backend.master')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<style>
    .dataTables_wrapper .dataTable tbody td {
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .dataTables_wrapper .dataTable thead th {
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .dataTables_wrapper .dataTables_paginate {
        margin-top: 20px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #007bff;
        color: white;
    }

    .dataTables_wrapper .dataTables_info {
        margin-top: 10px;
    }

    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_length {
        margin-bottom: 20px;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        color: white;
    }

    .table th, .table td {
        color: white;
    }

    .table {
        background-color: transparent;
    }

    .table thead {
        background-color: #f30000;
    }

    .table tbody tr:nth-child(odd) {
        background-color: rgba(255, 10, 10, 0);
        border-bottom: 2px solid rgba(219, 219, 219, 0.192);
    }

    .table tbody tr:nth-child(even) {
        background-color: rgba(255, 255, 255, 0);
        border-bottom: 2px solid rgba(219, 219, 219, 0.192);
    }

    .dataTables_paginate a {
        color: white;
        border: 1px solid rgb(214, 26, 26);
        padding: 5px 10px;
    }

    .dataTables_paginate a:hover {
        background-color: #555;
    }
</style>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Dashboard
                </div>
                <h2 class="page-title pb-2">
                    Surat Keterangan Domisili
                </h2>

            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('keterangan_domisili.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Domisili
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
                <h3 class="card-title">Daftar Data Domisili</h3>
            </div>
            <div class="card-body">
                <div id="table-default" class="table-responsive">
                    <table id="keterangan_domisili" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>No HP</th>
                                <th>Jenis Kelamin</th>
                                <th>Status</th>
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
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        var table = $('#keterangan_domisili').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('keterangan_domisili.index') }}',
            },
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
                { data: 'id', name: 'id' },
                { data: 'nama', name: 'nama' },
                { data: 'nik', name: 'nik' },
                { data: 'no_hp', name: 'no_hp' },
                { data: 'jenis_kelamin', name: 'jenis_kelamin' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
            ]
        });
    });

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
        });
    }
</script>

@endsection

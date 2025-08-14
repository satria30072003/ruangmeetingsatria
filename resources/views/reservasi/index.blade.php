@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">📋 Daftar Reservasi</h3>
        <a href="{{ route('reservasi.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-1"></i> Buat Reservasi Baru
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table id="reservasiTable" class="table table-hover align-middle table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Email</th>
                        <th>No WhatsApp</th>
                        <th>Ruangan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                        <th>Status</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#reservasiTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('reservasi.datatable') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'nama_pemesan',
                name: 'nama_pemesan'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'no_whatsapp',
                name: 'no_whatsapp'
            },
            {
                data: 'room_name',
                name: 'room.name'
            },
            {
                data: 'tanggal',
                name: 'tanggal'
            },
            {
                data: null,
                render: function(data, type, row) {
                    return row.waktu_mulai + ' - ' + row.waktu_selesai;
                }
            },
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false
            },
            {
                data: 'status',
                name: 'status',
                orderable: false,
                searchable: false
            },


        ]
    });

    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        let url = $(this).data('url');

        if (confirm("Yakin ingin menghapus reservasi ini?")) {
            $.ajax({
                url: url,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    $('#reservasiTable').DataTable().ajax.reload();
                    alert(res.success);
                },
                error: function() {
                    alert('Gagal menghapus data.');
                }
            });
        }
    });
});
</script>
@endsection
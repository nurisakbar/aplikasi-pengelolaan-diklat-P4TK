@extends('layouts.app')
@section('title','Kelola Data Diklat')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kelola Data Diklat</h6>
    </div>
    <div class="card-body">
        @include('alert')
        <a href="/diklat/create" class="btn btn-danger">Tambah Data Diklat</a>
        <hr>
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th width="10">Nomor</th>
                    <th>Nama Diklat</th>
                    <th>Tahun Pelaksaan</th>
                    <th>Jumlah Peserta</th>
                    <th>Status Aktif</th>
                    <th width="92">#</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/diklat',
        columns: [
            {data: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'nama_diklat', name: 'nama_diklat' },
            { data: 'tahun', name: 'tahun' },
            { data: 'jumlah_peserta', name: 'jumlah_peserta' },
            { data: 'status_aktif', name: 'status_aktif' },
            { data: 'action', name: 'action' }
        ]
    });
});
</script>
@endpush

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush



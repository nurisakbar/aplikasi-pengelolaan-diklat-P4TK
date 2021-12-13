@extends('layouts.app')
@section('title','Kelola Data Toko')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kelola Data Toko</h6>
    </div>
    <div class="card-body">
        @include('alert')
        <a href="/toko/create" class="btn btn-danger">Tambah Data Toko</a>
        <hr>
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th width="10">No</th>
                    <th>Nama Toko</th>
                    <th>Email</th>
                    <th>Kategori Toko</th>
                    <th width="70">#</th>
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
        ajax: '/toko',
        columns: [
            {data: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'nama_toko', name: 'nama_toko' },
            { data: 'email', name: 'email' },
            { data: 'kategori_toko', name: 'kategori_toko' },
            { data: 'action', name: 'action' }
        ]
    });
});
</script>
@endpush

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush



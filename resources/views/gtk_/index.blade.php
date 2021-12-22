@extends('layouts.app')
@section('title','Kelola Data GTK')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kelola Data GTK</h6>
    </div>
    <div class="card-body">
        @include('alert')
        <a href="/gtk/create" class="btn btn-danger">Tambah Data GTK</a>
        <hr>
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th width="10">NOPES</th>
                    <th>Nama GTK</th>
                    <th>Asal Sekolah</th>
                    <th>Provinsi - Kota</th>
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
        ajax: '/gtk',
        columns: [
            { data: 'nopes', name: 'nopes' },
            { data: 'nama_gtk', name: 'nama_gtk' },
            { data: 'asal_sekolah', name: 'asal_sekolah' },
            { data: 'provinsi', name: 'provinsi' },
            { data: 'action', name: 'action' }
        ]
    });
});
</script>
@endpush

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush



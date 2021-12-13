@extends('layouts.app')
@section('title','Kelola Panduan Kerja')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kelola Panduan Kerja</h6>
    </div>
    <div class="card-body">
        @include('alert')
        <a href="/video/create" class="btn btn-danger">Tambah Panduan Kerja</a>
        <hr>
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th width="10">No</th>
                    <th>Judul</th>
                    <th width="96">#</th>
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
        ajax: '/video',
        columns: [
            {data: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'title', name: 'title' },
            { data: 'action', name: 'action' }
        ]
    });
});
</script>
@endpush

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush



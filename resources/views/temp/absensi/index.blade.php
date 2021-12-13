@extends('layouts.app')
@section('title','Kelola Data Absensi')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kelola Data Absensi</h6>
    </div>
    <div class="card-body">
        @include('alert')
        {{ Form::open(['url'=>'absensi','method'=>'GET']) }}
        <table class="table table-bordered">
            <tr>
                <td width="150">Dari Tanggal</td>
                <td>
                    {{ Form::date('tanggal_start',$tanggal_start,['class' => 'tanggal_start form-control'])}}
                </td>
            </tr>
            <tr>
                <td>Sampai Tanggal</td>
                <td>
                    {{ Form::date('tanggal_end',$tanggal_end,['class' => 'tanggal_end form-control'])}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="action" value="filter" class="btn btn-sm btn-danger">Filter Laporan</button>
                    @if(Auth::user()->level=='administrator' || Auth::user()->level=='leader')
                        <button type="submit" name="action" value="download" class="btn btn-sm btn-danger">Download Excel</button>
                        <a href="/absensi/create" class="btn btn-danger btn-sm">Input Absensi</a>
                    @endif
                </td>
            </tr>
        </table>
        {{ Form::close() }}
        <hr>
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th width="10">No</th>
                    <th>Nama Karyawan</th>
                    <th>Tanggal</th>
                    <th>Status Kehadiran</th>
                    <th>Keterangan</th>
                    @if(Auth::user()->level!='kelompok')
                        <th width="70">#</th>
                    @endif
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
@if(Auth::user()->level!='kelompok')
    <script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/absensi?tanggal_start='+$('.tanggal_start').val()+'&tanggal_end='+$('.tanggal_end').val(),
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'user.name', name: 'user.name' },
                { data: 'tanggal', name: 'tanggal' },
                { data: 'status_kehadiran', name: 'status_kehadiran' },
                { data: 'keterangan', name: 'keterangan' },
                { data: 'action', name: 'action' }
            ]
        });
    });
    </script>
@else
    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/absensi?tanggal_start='+$('.tanggal_start').val()+'&tanggal_end='+$('.tanggal_end').val(),
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false},
                    { data: 'user.name', name: 'user.name' },
                    { data: 'tanggal', name: 'tanggal' },
                    { data: 'status_kehadiran', name: 'status_kehadiran' },
                    { data: 'keterangan', name: 'keterangan' }
                ]
            });
        });
    </script>
@endif
@endpush

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush



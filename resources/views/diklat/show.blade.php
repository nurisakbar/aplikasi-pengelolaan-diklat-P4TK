@extends('layouts.app')
@section('title','Detail Diklat')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Diklat {{ $diklat->nama_diklat }}</h6>
    </div>
    <div class="card-body">
        {{-- @include('alert')
        <a href="/jabatan/create" class="btn btn-danger">Tambah Data Jabatan</a>
        <hr> --}}
        <table class="table table-bordered">
            <tr>
                <td width="300">Nama Diklat</td>
                <td>{{ $diklat->nama_diklat }}</td>
            </tr>
            <tr>
                <td>Tahun Pelaksanaan</td>
                <td>{{ $diklat->tahun }}</td>
            </tr>
            <tr>
                <td>Jumlah Peserta Terdaftar</td>
                <td>50</td>
            </tr>
            <tr>
                <td>Jumlah Peserta Terkonfirmasi</td>
                <td>50</td>
            </tr>
        </table>
        
        <h5>Daftar Peserta Diklat </h5>
        <hr>
        <div class="table-responsive">
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th width="10">NOPES</th>
                    <th>Nama GTK</th>
                    <th>Asal Sekolah</th>
                    <th>Provinsi - Kota</th>
                    <th>Status</th>
                    <th width="70">#</th>
                </tr>
            </thead>
        </table>
        </div>
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
        ajax: '/diklat/{{$diklat->id}}',
        columns: [
            { data: 'nopes', name: 'nopes' },
            { data: 'gtk.nama_gtk', name: 'gtk.nama_gtk' },
            { data: 'gtk.asal_sekolah', name: 'gtk.asal_sekolah' },
            { data: 'gtk.provinsi', name: 'gtk.provinsi' },
            { data: 'status_kehadiran', name: 'status_kehadiran' },
            { data: 'action', name: 'action' }
        ]
    });
});
</script>
@endpush

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush



@extends('layouts.app')
@section('title','Data Diklat')
@section('content')
@include('diklat.toolbar')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <div class="content flex-row-fluid" id="kt_content">
        @include('alert')
        <table class="table table-rounded table-striped border gy-7 gs-7" id="users-table">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                    <th width="10">Nomor</th>
                    <th>Nama Diklat</th>
                    <th>Kategori</th>
                    <th>Kompetensi Keahlian</th>
                    <th>Tahun Pelaksaan</th>
                    <th>Jumlah Peserta</th>
                    <th>Status Aktif</th>
                    <th width="170">#</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/diklat',
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'nama_diklat', name: 'nama_diklat' },
                { data: 'kategori.nama_kategori', name: 'kategori.nama_kategori' },
                { data: 'kompetensi_keahlian', name: 'kompetensi_keahlian' },
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
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endpush

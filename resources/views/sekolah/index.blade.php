@extends('layouts.app')
@section('title','Data Diklat')
@section('content')
@include('sekolah.toolbar')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <div class="content flex-row-fluid" id="kt_content">
        @include('alert')
        <table class="table table-rounded table-striped border gy-7 gs-7" id="users-table">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                    <th width="10">Nomor</th>
                    <th>Nama Sekolah</th>
                    <th>Jenjang</th>
                    <th>Alamat</th>
                    <th>Kecamatan</th>
                    <th>Kabupaten</th>
                    <th>Provinsi</th>
                    <th width="170">#</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://preview.keenthemes.com/metronic8/demo11/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/sekolah',
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'nama_sekolah', name: 'nama_sekolah' },
                { data: 'jenjang', name: 'jenjang' },
                { data: 'alamat', name: 'alamat' },
                { data: 'district.name', name: 'district.name' },
                { data: 'district.regency.name', name: 'district.regency.name' },
                { data: 'district.regency.province.name', name: 'district.regency.province.name' },
                { data: 'action', name: 'action' }
            ]
        });
    });
    </script>
@endpush

@push('css')
    <link href="https://preview.keenthemes.com/metronic8/demo11/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

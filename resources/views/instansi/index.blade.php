@extends('layouts.app')
@section('title','Data Instansi')
@section('content')
@include('instansi.toolbar')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <div class="content flex-row-fluid" id="kt_content">
        @include('alert')
        <table class="table table-rounded table-striped border gy-7 gs-7" id="users-table">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                    <th width="10">No</th>
                    <th>Nama Sekolah</th>
                    <th>Jenis Instansi</th>
                    <th>Status</th>
                    <th>Telepon</th>
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
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/instansi',
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'nama_instansi', name: 'nama_instansi' },
                { data: 'jenis_instansi', name: 'jenis_instansi' },
                { data: 'status', name: 'status' },
                { data: 'telepon', name: 'telepon' },
                { data: 'wilayah_administratif.district_name'},
                { data: 'wilayah_administratif.regency_name' },
                { data: 'wilayah_administratif.province_name'},
                { data: 'action', name: 'action' }
            ]
        });
    });
    </script>
@endpush

@push('css')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endpush

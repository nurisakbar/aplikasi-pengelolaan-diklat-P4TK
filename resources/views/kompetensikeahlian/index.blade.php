@extends('layouts.app')
@section('title','Kompetensi Keahlian')
@section('content')
@include('kompetensikeahlian.toolbar')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <div class="content flex-row-fluid" id="kt_content">
        @include('alert')
        <table class="table table-rounded table-striped border gy-7 gs-7" id="users-table">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                    <th width="10">Nomor</th>
                    <th>Nama Kompetensi Keahlian</th>
                    <th>Nama Bidang Keahlian</th>
                    <th width="120">#</th>
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
            ajax: '/kompetensikeahlian',
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'nama_program_keahlian', name: 'nama_program_keahlian' },
                { data: 'bidang_keahlian.nama_bidang_keahlian', name: 'bidang_keahlian.nama_bidang_keahlian' },
                { data: 'action', name: 'action' }
            ]
        });
    });
    </script>
@endpush

@push('css')
    <link href="https://preview.keenthemes.com/metronic8/demo11/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

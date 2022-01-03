@extends('layouts.app')
@section('title', 'Data Approve')
@section('content')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">
            @include('alert')
            <table class="table table-rounded table-striped border gy-7 gs-7" id="approve-table">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                        <th width="10">Nomor</th>
                        <th>Nama Lengkap</th>
                        <th>NIK</th>
                        <th>NUPTk</th>
                        <th>Jabatan</th>
                        <th width="150">#</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(function() {
            $('#approve-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/daftarApprove',
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap'
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'nuptk',
                        name: 'nuptk'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        });
    </script>
@endpush

@push('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush

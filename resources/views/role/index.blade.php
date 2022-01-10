@extends('layouts.app')
@section('title', 'Data Role')
@section('content')
    @include('role.toolbar')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">
            @include('alert')
            @if($notif=='success')
            <div class="alert alert-primary">
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-3">...</span>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-dark">Notifikasi</h4>
                    <span>Perubahan Permission Berhasil Disimpan</span>
                </div>
            </div>
            @endif
            <table class="table table-rounded table-striped border gy-7 gs-7" id="roles-table">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                        <th width="10">No</th>
                        <th>Nama</th>
                        <th width="170">#</th>
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
            $('#roles-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/role',
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
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

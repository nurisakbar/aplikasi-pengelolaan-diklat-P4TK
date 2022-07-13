@extends('layouts.app')
@section('title', 'Riwayat Diklat')
@section('content')
<div class="toolbar py-5 py-lg-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
        <div class="page-title d-flex flex-column me-3">
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Riwayat Diklat</h1>
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ url('/') }}" class="text-gray-600 text-hover-primary">Home</a>
                </li>
                <li class="breadcrumb-item text-gray-600">Riwayat Diklat</li>
            </ul>
        </div>
    </div>
</div>

    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">
            @include('alert')
            <div class="card">
                <div class="card-body py-4">
                    <table class="table table-rounded table-striped border gy-7 gs-7" id="users-table">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                <th>Nomor</th>
                                <th>Nama Diklat</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diklat as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->diklat->nama_diklat}}</td>
                                <td>{{ $row->diklat->tanggal_mulai}}</td>
                                <td>{{ $row->diklat->tanggal_selesai}}</td>
                                <td>{{ $row->status_kehadiran}}</td>
                            </tr>
                            @endforeach()
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script>
$( document ).ready(function() {
    $('#users-table').DataTable();
});
</script>
@endpush

@push('css')
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endpush

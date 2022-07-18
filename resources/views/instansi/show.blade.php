@extends('layouts.app')
@section('title','Data Instansi')
@section('content')
@include('instansi.toolbar')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <div class="content flex-row-fluid" id="kt_content">
        <div class="card">
            <div class="card-body py-4">
               @include('alert')
               <div id="alert"></div>

        <table class="table table-row-bordered">
            <tr>
                <td width="300">Nama Instansi</td>
                <td>{{ $instansi->nama_instansi }}</td>
            </tr>
            <tr>
                <td>Provinsi</td>
                <td>{{ $instansi->wilayahAdministratif->province_name }}</td>
            </tr>
            <tr>
                <td>Kabupaten</td>
                <td>{{ $instansi->wilayahAdministratif->regency_name }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>{{ $instansi->alamat }}</td>
            </tr>
        </table>

        <hr>
        <h3>Daftar Guru {{ $instansi->nama_instansi }}</h3>
        <hr>

                <table class="table table-rounded table-striped border gy-7 gs-7" id="instansi-table">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                            <th width="10">No</th>
                            <th>Nomor UKG</th>
                            <th width="150">Nama Guru</th>
                            <th>Mapel Dapodik</th>
                            <th>Email</th>
                            <th>HP</th>
                            <th>NIK</th>                        
                            <th width="30">#</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
@push('scripts')
<script src="https://preview.keenthemes.com/metronic8/demo11/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script>
$(function() {
    $('#instansi-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/instansi/{{$instansi->id}}',
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'nomor_ukg', name: 'nomor_ukg' },
            { data: 'nama_lengkap', name: 'nama_lengkap' },
            { data: 'mapel_ukg_ptk', name: 'mapel_ukg_ptk' },
            { data: 'email', name: 'email' },
            { data: 'nomor_hp', name: 'nomor_hp' },
            { data: 'nik', name: 'nik' },
            { data: 'action', name: 'action' }
        ]
    });

});

</script>
@endpush

@push('css')
    <link href="https://preview.keenthemes.com/metronic8/demo11/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

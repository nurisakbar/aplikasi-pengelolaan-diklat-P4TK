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

        {{-- <table class="table table-row-bordered">
            <tr>
                <td width="300">Nama Diklat</td>
                <td>{{ $diklat->nama_diklat }}</td>
            </tr>
            <tr>
                <td>Tahun Pelaksanaan</td>
                <td>{{ $diklat->tahun }}</td>
            </tr>
            <tr>
                <td>Departemen</td>
                <td>{{ $diklat->departement }}</td>
            </tr>
            <tr>
                <td>Quota</td>
                <td>{{ $diklat->quota }}</td>
            </tr>
            <tr>
                <td>Jumlah Peserta Terdaftar</td>
                <td>{{ $diklat->peserta->count() }}</td>
            </tr>
            <tr>
                <td>Jumlah Peserta Terkonfirmasi</td>
                <td>{{ $diklat->peserta->where('status','Terkonfirmasi')->count() }}</td>
            </tr>
        </table> --}}

        <hr>
        <h3>Daftar Guru {{ $instansi->nama_instansi }}</h3>
        <hr>

                <table class="table table-rounded table-striped border gy-7 gs-7" id="instansi-table">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                            <th width="10">No</th>
                            <th width="150">Nama Guru</th>
                            <th>NIK</th>
                            <th>Nomor UKG</th>
                            <th>NUPTK</th>
                            <th>NPWP</th>
                            <th>Jabatan</th>
                            <th>Email</th>
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
            { data: 'nama_lengkap', name: 'nama_lengkap' },
            { data: 'nik', name: 'nik' },
            { data: 'nomor_ukg', name: 'nomor_ukg' },
            { data: 'nuptk', name: 'nuptk' },
            { data: 'npwp', name: 'npwp' },
            { data: 'jabatan', name: 'jabatan' },
            { data: 'email', name: 'email' },
            { data: 'action', name: 'action' }
        ]
    });

});

</script>
@endpush

@push('css')
    <link href="https://preview.keenthemes.com/metronic8/demo11/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

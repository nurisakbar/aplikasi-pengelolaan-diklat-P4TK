@extends('layouts.app')
@section('title', 'Data Diklat')
@section('content')
    {{-- @include('diklat.__toolbar-show') --}}
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">

            @include('alert')
            <div id="alert"></div>

            <table class="table table-row-bordered">
                <tr>
                    <td width="300">Nama Diklat</td>
                    <td>{{ $diklat->nama_diklat }}</td>
                </tr>
                <tr>
                    <td>Tahun Pelaksanaan</td>
                    <td>{{ $diklat->tahun }} | Dari Mulai {{ $diklat->tanggal_mulai }} Sampai
                        {{ $diklat->tanggal_selesai }}</td>
                </tr>
                <tr>
                    <td>Departemen</td>
                    <td>{{ $diklat->departemen->nama_departemen }}</td>
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
                    <td>{{ $diklat->peserta->where('status', 'Terkonfirmasi')->count() }}</td>
                </tr>
            </table>

            <hr>
            <h3>Daftar Peserta Diklat</h3>
            <hr>

            <table class="table table-rounded table-striped border gy-7 gs-7" id="gtk-table">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                        <th width="10">No UKG</th>
                        <th>Nama Lengkap</th>
                        <th>Asal Sekolah</th>
                        <th>Kota</th>
                        <th>Provinsi</th>
                        <th>Nomor HP</th>
                        <th>Status</th>
                    </tr>
                </thead>
            </table>

        </div>

        @include('diklat.show-modal')
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            $('#gtk-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/detailDiklat/{{ $diklat->id }}',
                columns: [{
                        data: 'gtk.nomor_ukg',
                        name: 'gtk.nomor_ukg'
                    },
                    {
                        data: 'gtk.nama_lengkap',
                        name: 'gtk.nama_lengkap'
                    },
                    {
                        data: 'gtk.instansi.nama_instansi'
                    },
                    {
                        data: 'gtk.instansi.wilayah_administratif.regency_name'
                    },
                    {
                        data: 'gtk.instansi.wilayah_administratif.province_name'
                    },
                    {
                        data: 'gtk.nomor_hp',
                        name: 'gtk.nomor_hp'
                    },
                    {
                        data: 'status_kehadiran',
                        name: 'status_kehadiran'
                    }
                ]
            });

        });
    </script>
@endpush

@push('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
@endpush

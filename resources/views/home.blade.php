@extends('layouts.app')
@section('title','Halaman Utama')
@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">

    
    <!--begin::Post-->
    <div class="content flex-row-fluid" id="kt_content" style="margin-top:40px;">
        <div class="col-md-12">
            @include('alert')
        </div>
        <!--begin::Toolbar-->
        <div class="d-flex flex-wrap flex-stack mb-6">
            <!--begin::Heading-->
            <h3 class="fw-bolder my-2">DAFTAR DIKLAT YANG AKAN BERJALAN</h3>
            <!--end::Heading-->
  
        </div>
        <!--end::Toolbar-->
        <!--begin::Row-->
        <div class="row g-6 g-xl-9">
            <table class="table table-rounded table-striped border gy-7 gs-7" id="users-table">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                        <th>Nama Kegiatan/ Diklat</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Tempat Pelaksanaan</th>
                        <th>Quota</th>
                        <th>Jumlah Pendaftar</th>
                        <th>Kompetensi Keahlian</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($diklat as $d)
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                        <td><b>{{ $d->nama_diklat}}</b><br> {{ $d->kategori->nama_kategori}}</td>
                        <td>{{ date_format(date_create($d->tanggal_mulai),"d-m-Y")}}</td>
                        <td>{{ date_format(date_create($d->tanggal_selesai),"d-m-Y")}}</td>
                        <td>{{ $d->tempat}}</td>
                        <td>{{ $d->quota}}</td>
                        <td>{{ \DB::table('diklat_peserta')->where('diklat_id',$d->id)->where('status_kehadiran','Peserta')->count()}}</td>
                        <td>
                            @if(!in_array($d->kompetensi_keahlian_id,[null,'']))
                            <?php
                            $kompetensi = \DB::table('kompetensi_keahlian')->where('id',$d->kompetensi_keahlian_id)->first();
                            echo $kompetensi->nama_kompetensi_keahlian??'-';
                            ?>
                            @elseif(!in_array($d->program_keahlian_id,[null,'']))
                            <?php
                            $program = \DB::table('program_keahlian')->where('id',$d->program_keahlian_id)->first();
                            echo $program->nama_program_keahlian??'-';
                            ?>
                            @endif
                        </td>
                        <td>
                            <a href="/diklat/detail/{{$d->id}}" class="btn btn-info btn-sm">Daftar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection

@push('scripts')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        $('#users-table').DataTable();
    });
    </script>
@endpush

@push('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush

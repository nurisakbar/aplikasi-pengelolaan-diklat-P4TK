@extends('layouts.app')
@section('title', 'Data GTK')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar py-5 py-lg-5" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-3">
                <!--begin::Title-->
                <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Daftar GTK</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-600">
                        <a href="https://preview.keenthemes.com/metronic8/demo11/../demo11/index.html"
                            class="text-gray-600 text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-600">GTK</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-600">Daftar GTK</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->

    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">
            @if ($totalApprove != 0)
                <div class="alert alert-info" role="alert">
                    Ada <b>{{ $totalApprove }}</b> Data GTK Baru Yang Menunggu Konfirmasi Akun. <a
                        href="{{ url('daftarApprove') }}" class="text-primary">Lihat daftar
                        disini</a>
                </div>
            @endif

            <table class="table table-bordered">
                <tr>
                    <td colspan="2">FILTER DATA PTK</td>
                </tr>
                <tr>
                    <td width="200">Provinsi</td>
                    <td>
                        <div class="row">
                            <div class="col-md-4">
                              {{Form::select('provinsi',$provinsi,null,['class' => 'form-control txt_provinsi','placeholder'=>'-- Semua Provinsi --','onChange'=>'loadKabupaten()'])}}
                            </div>
                            <div class="col-md-4 kabupaten">
                                <div id="kabupaten_area"></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Nama Instansi</td>
                    <td>
                        {{ Form::text('nama_instansi',null,['class' => 'form-control txt_nama_instansi','placeholder'=>'Nama Instansi/ Sekolah'])}}
                    </td>
                  </tr>
                <tr>
                  <td>Nama Calon Peserta</td>
                  <td>
                      {{ Form::text('nama_gtk',null,['class' => 'form-control txt_nama_gtk','placeholder'=>'Nama Calon Peerta'])}}
                  </td>
              </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="filterData()">Filter Data</button>
                        <a class="btn btn-primary" href="/gtk/create">Tambah Data</a>
                    </td>
                </tr>
            </table>

            @include('alert')


            <table class="table table-rounded table-striped border gy-7 gs-7" id="gtk-table">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                        <th width="10">No UKG</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Umur</th>
                        <th>Nomor HP</th>
                        <th>Asal instansi</th>
                        <th>Provinsi - Kota</th>
                        <th width="170">#</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!--end::Post-->
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
   
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>

$(function() {
    // var province_id     = $(".txt_provinsi").val();
    // var regency_id      = $(".regency_id").val();
    // var nama_instansi   = $('.txt_nama_instansi').val();
    // var nama_gtk        = $('.txt_nama_gtk').val();
    
    $('#gtk-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/gtk',
        columns: [{
            data: 'nomor_ukg',
            name: 'nomor_ukg'
        },
        {
            data: 'nama_lengkap',
            name: 'nama_lengkap'
        },
        {
            data: 'jenis_kelamin',
            name: 'jenis_kelamin'
        },
        {
            data: 'umur',
            name: 'umur'
        },
        {
            data: 'nomor_hp',
            name: 'nomor_hp'
        },
        {
            data: 'nama_instansi',
            name: 'nama_instansi'
        },
        {
            data: 'nama_provinsi'
        },
        {
            data: 'action',
            name: 'action'
        }
    ]
    });

});

function filterData(){
    var province_id     = $(".txt_provinsi").val();
    var regency_id      = $(".regency_id").val();
    var nama_instansi   = $('.txt_nama_instansi').val();
    var nama_gtk        = $('.txt_nama_gtk').val();
    var params = '/gtk?province_id='+province_id+'&regency_id='+regency_id+'&nama_instansi='+nama_instansi+'&nama_gtk='+nama_gtk;
    $('#gtk-table').DataTable().ajax.url(params).load();
}

function loadKabupaten(){
    var provinsi= $(".txt_provinsi").val();
    $.ajax({
         url: "/ajax/kabupaten",
         cache: false,
         data:{provinsi:provinsi},
         success: function(response){
            console.log(response.nopes);
            $('#kabupaten_area').html(response);
            $(".regency_id").removeClass("form-select-solid");
         }
    })
}
</script>
@endpush

@push('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush

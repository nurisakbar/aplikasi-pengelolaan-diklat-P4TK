@extends('layouts.app')
@section('title', 'Data Detail Approve')
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
                    <li class="breadcrumb-item text-gray-600">Daftar Approve</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-600">Detail</li>
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

            <table class="table table-row-bordered mt-5">
                <tr>
                    <td width="300">Nama Lengkap</td>
                    <td>{{ $gtk->nama_lengkap }}</td>
                </tr>
                <tr>
                    <td width="300">Email</td>
                    <td>{{ $gtk->email }}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>{{ $gtk->nik }}</td>
                </tr>
                <tr>
                    <td>Instansi</td>
                    <td>{{ $gtk->instansi->nama_instansi }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>{{ $gtk->domisi_alamat_jalan }}</td>
                </tr>
                <tr>
                    <td>Nomor HP</td>
                    <td>{{ $gtk->nomor_hp }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>{{ $gtk->jabatan }}</td>
                </tr>
            </table>
        </div>

    </div>
@endsection

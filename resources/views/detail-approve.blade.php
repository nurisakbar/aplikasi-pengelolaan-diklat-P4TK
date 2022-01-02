@extends('layouts.app')
@section('title', 'Data Detail Approve')
@section('content')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">

            <table class="table table-row-bordered mt-5">
                <tr>
                    <td width="300">Nama Lengkap</td>
                    <td>{{ $gtk->nama_lengkap }}</td>
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

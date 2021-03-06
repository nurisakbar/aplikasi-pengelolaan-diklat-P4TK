@extends('layouts.app')
@section('title','Data Instansi')
@section('content')
@include('instansi.toolbar')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <div class="content flex-row-fluid" id="kt_content">
        @include('alert')
        {{ Form::open(['url'=>'instansi','method'=>'GET'])}}
        {{ Form::hidden('type', 'download_excel')}}
        <table class="table table-bordered">
            <tr>
                <td colspan="2">FILTER DATA PTK</td>
            </tr>
            <tr>
                <td width="200">Provinsi</td>
                <td>
                    <div class="row">
                        <div class="col-md-4">
                          {{Form::select('provinsi',$provinsi,$_GET['provinsi']??null,['class' => 'form-control txt_provinsi','placeholder'=>'-- Semua Provinsi --','onChange'=>'loadKabupaten()'])}}
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
                <td>Kompetensi Keahlian</td>
                <td>
                    <div class="row">
                        <div class="col-md-4">
                            {{Form::select('kompetensi_keahlian_id',$kompetensi,$_GET['kompetensi_keahlian_id']??null,['class' => 'form-control komepetensi_keahlian_id','placeholder'=>'-- Semua Kompetensi --'])}}
                          </div>
                    </div>
                </td>
              </tr>
            <tr>
                <td></td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="filterData()">Cari Data</button>
                    <button type="submit" class="btn btn-danger">Export Excel</button>
                </td>
            </tr>
        </table>
        <form>
        <table class="table table-rounded table-striped border gy-7 gs-7" id="users-table">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                    <th width="10">No</th>
                    <th>NPSN</th>
                    <th>Nama Sekolah</th>
                    {{-- <th>Jenis Instansi</th>
                    <th>Status</th>
                    <th>Telepon</th>
                    <th>Kecamatan</th> --}}
                    <th>Kabupaten/ Kota</th>
                    <th>Provinsi</th>
                    <th width="180">#</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="{{asset('asset/custom/documentation/forms/select2.js')}}"></script>
<script>
    $(function() {
        var province_id     = getParameterByName('province_id');
        var regency_id      = getParameterByName('regency_id');
        var nama_instansi   = getParameterByName('nama_instansi');
        var kompetensi_keahlian_id   = getParameterByName('kompetensi_keahlian_id');

        $('.komepetensi_keahlian_id').select2();
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            processData: true,
            ajax: '/instansi?province_id='+province_id+'&regency_id='+regency_id+'&nama_instansi='+nama_instansi+'&kompetensi_keahlian_id='+kompetensi_keahlian_id,
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'npsn', name: 'npsn' },
                { data: 'nama_instansi', name: 'nama_instansi' },
                // { data: 'jenis_instansi', name: 'jenis_instansi' },
                // { data: 'status', name: 'status' },
                // { data: 'telepon', name: 'telepon' },
                // { data: 'nama_kecamatan'},
                { data: 'nama_kabupaten' },
                { data: 'nama_provinsi'},
                { data: 'action', name: 'action' }
            ]
        });
    });

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

function filterData(){
    var province_id     = $(".txt_provinsi").val();
    var regency_id      = $(".regency_id").val();
    var nama_instansi   = $('.txt_nama_instansi').val();
    var kompetensi_keahlian_id   = $('.komepetensi_keahlian_id').val();
    var params = '/instansi?province_id='+province_id+'&regency_id='+regency_id+'&nama_instansi='+nama_instansi+'&kompetensi_keahlian_id='+kompetensi_keahlian_id;
    $('#users-table').DataTable().ajax.url(params).load();
}


    function getParameterByName(name, url = window.location.href) {
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <style>
        .dataTables_filter {
        display: none;
        } 
    </style>
@endpush

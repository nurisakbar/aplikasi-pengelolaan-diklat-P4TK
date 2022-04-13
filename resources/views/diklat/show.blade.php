@extends('layouts.app')
@section('title','Data Diklat')
@section('content')
@include('diklat.__toolbar-show')
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
                <td>{{ $diklat->tahun }} | Dari Mulai {{ $diklat->tanggal_mulai }} Sampai {{ $diklat->tanggal_selesai }}</td>
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
                <td>Jumlah Pendaftar</td>
                <td>{{ $diklat->peserta->where('status_kehadiran','Pendaftar')->count() }}</td>
            </tr>
            <tr>
                <td>Jumlah Peserta Terkonfirmasi</td>
                <td>{{ $diklat->peserta->where('status_kehadiran','Peserta')->count() }}</td>
            </tr>
        </table>

        <hr>
        <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link {{request('tab')=='pendaftar'?'active':''}}" href="/diklat/{{ $diklat->id}}?tab=pendaftar">Daftar Pendaftar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{request('tab')=='peserta'?'active':''}}" href="/diklat/{{ $diklat->id}}?tab=peserta">Daftar Peserta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{request('tab')=='kelas'?'active':''}}" href="/diklat/{{ $diklat->id}}?tab=kelas">Data Kelas</a>
              </li>
          </ul>
        <hr>
        @if(request('tab')=='kelas')
        <table class="table table-rounded table-striped border gy-7 gs-7" id="kelas-table">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nama Kelas</th>
                    <th>Jumlah Peserta</th>
                    <th width="260">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kelas_all as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->nama_kelas }}</td>
                    <td>{{ $k->peserta->count() }} Peserta</td>
                    <td>
                        <button type="button" onclick="ubah_kelas({{ $k->id}})" class="btn btn-danger btn-sm">Edit Kelas</button>
                        {{ Form::open(['url'=>'kelas-diklat/'.$k->id,'method'=>'delete','style'=>'float:left;margin-right:10px'])}}
                        <button type="submit" class="btn btn-danger btn-sm">Hapus Kelas</button>
                        {{ Form::close()}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <table class="table table-rounded table-striped border gy-7 gs-7" id="users-table">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                    <th width="10">No UKG</th>
                    <th>Nama Lengkap</th>
                    <th>Umur</th>
                    <th>Asal Sekolah</th>
                    <th>Kota</th>
                    <th>Provinsi</th>
                    <th>Nomor HP</th>
                    <th>Status</th>
                    @if(request('tab')=='peserta')
                        <th>Kelas</th>
                    @endif
                    <th width="110">#</th>
                </tr>
            </thead>
        </table>
        @endif
    </div>

    @include('diklat.show-modal')
</div>
@endsection
@push('scripts')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(request('tab')=='peserta')
    <script>
        $(function() {
            $('#kela-table').DataTable();
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/diklat/{{$diklat->id}}?status_kehadiran={{ request('tab') }}',
                columns: [
                    { data: 'gtk.nomor_ukg', name: 'gtk.nomor_ukg' },
                    { data: 'gtk.nama_lengkap', name: 'gtk.nama_lengkap' },
                    { data: 'gtk.umur', name: 'gtk.umur' },
                    { data: 'gtk.instansi.nama_instansi'},
                    { data: 'gtk.instansi.wilayah_administratif.regency_name'},
                    { data: 'gtk.instansi.wilayah_administratif.province_name'},
                    { data: 'gtk.nomor_hp', name: 'gtk.nomor_hp' },
                    { data: 'status_kehadiran', name: 'status_kehadiran' },
                    { data: 'kelas', name: 'kelas' },
                    { data: 'action', name: 'action' }
                ]
            });    
        });
    </script>
@else
<script>
    $(function() {
        $('#kela-table').DataTable();
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/diklat/{{$diklat->id}}?status_kehadiran={{ request('tab') }}',
            columns: [
                { data: 'gtk.nomor_ukg', name: 'gtk.nomor_ukg' },
                { data: 'gtk.nama_lengkap', name: 'gtk.nama_lengkap' },
                { data: 'gtk.umur', name: 'gtk.umur' },
                { data: 'gtk.instansi.nama_instansi'},
                { data: 'gtk.instansi.wilayah_administratif.regency_name'},
                { data: 'gtk.instansi.wilayah_administratif.province_name'},
                { data: 'gtk.nomor_hp', name: 'gtk.nomor_hp' },
                { data: 'status_kehadiran', name: 'status_kehadiran' },
                { data: 'action', name: 'action' }
            ]
        });    
    });
</script>
@endif
<script>
$(function() {
    $('#kela-table').DataTable();
    var province_id     = $(".txt_provinsi").val();
    var regency_id      = $(".regency_id").val();
    var nama_instansi   = $('.txt_nama_instansi').val();
    var nama_gtk        = $('.txt_nama_gtk').val();
    
    $('#gtk-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/gtk?province_id='+province_id+'&regency_id='+regency_id+'&nama_instansi='+nama_instansi+'&nama_gtk='+nama_gtk,
        columns: [
            { data: 'nomor_ukg', name: 'nomor_ukg' },
            { data: 'nama_lengkap', name: 'nama_lengkap' },
            { data: 'umur', name: 'umur' },
            { data: 'nama_instansi', name: 'nama_instansi' },
            { data: 'nama_kabupaten', name: 'nama_kabupaten' },
            { data: 'nama_provinsi', name: 'nama_provinsi' },
            { data: 'keterangan', name: 'keterangan' },
            { data: 'pilih', name: 'pilih' }
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


function ubah_kelas(id){
    $('#tambahKelas').modal('show');
    $.ajax({
    url: "/kelas-diklat/"+id,
    cache: false,
    success: function(response){
        console.log(response);
        $('.nama_kelas').val(response.nama_kelas);
        $('.kelas_id').val(response.id);
    }});
}


function tutup_modal_gtk(id)
{
    $('#exampleModal').modal('hide');
    console.log(id);
    console.log('open detail gtk');
    $('#modalPesertaTerpilih').modal('show');
    $.ajax({
    url: "/gtk/"+id,
    cache: false,
    success: function(response){
        console.log(response);
        $('#nama').html(response.nama_lengkap);
        $('#nomor_ukg').html(response.nomor_ukg);
        $('#asal_sekolah').html(response.instansi.nama_instansi);
        $('#mapel_ajar_dapodik').html(response.mapel_ukg_ptk);
        $("#peserta_id_txt").val(response.id);
        $(".link_detail_peserta").attr("href", "/gtk/"+response.id);
    }
});
}

function tambah_peserta(){
    var peserta_id = $("#peserta_id_txt").val();
    var diklat_kelas_id = $("#kelas").val();
    var diklat_id_txt = $("#diklat_id_txt").val();
    $.ajax({
    url: "/diklatpeserta/",
    data: {
        "_token": "{{ csrf_token() }}",
        diklat_kelas_id:diklat_kelas_id,
        diklat_id:diklat_id_txt,
        peserta_id:peserta_id,
    },
    method:'POST',
    cache: false,
    success: function(response){
        console.log(response);
        $('#modalPesertaTerpilih').modal('hide');
        $('#users-table').DataTable().draw();
    }});
}

function buka_modal_gtk(){
    $('#exampleModal').modal('toggle');
}

function buka_modal_ubah_status(id){
    $('#modalUbahStatus').modal('toggle');
    console.log(id);
    $.ajax({
    url: "/diklatpeserta/"+id,
    cache: false,
    success: function(response){
        console.log(response.gtk);
        $('#nama_gtk').html(response.gtk.nama_lengkap);
        $('#nopes_gtk').html(response.gtk.nomor_ukg);
        $('#asal_sekolah_gtk').html(response.gtk.instansi.nama_instansi);
        $('#mapel_ajar_dapodik_gtk').html(response.gtk.mapel_ukg_ptk);
        $("#id").val(id);
        $("#status_kehadiran").val(response.status_kehadiran).change();
        $("#kelas_id_txt").val(response.diklat_kelas_id).change();
    }
});
}

function simpan_perubahan(){
    var id = $('#id').val();
    var status_kehadiran = $("#status_kehadiran").val();
    var diklat_kelas_id = $("#kelas_id_txt").val();

    $.ajax({
        url: "/diklatpeserta/"+id,
        data: {
            "_token": "{{ csrf_token() }}",
            status_kehadiran: status_kehadiran,
            diklat_kelas_id: diklat_kelas_id
        },
        method: 'PUT',
        success: function (response) {
            $('#users-table').DataTable().draw();
            $('#modalUbahStatus').modal('hide');
        }
    });
}

function hapusPeserta(id){
    Swal.fire({
        title: "Konfirmasi Hapus Peserta",
        text: "Tambahkan Alasan Penghapusan",
        input: 'text',
        showCancelButton: true
    }).then((result) => {
        if (result.value) {
            console.log("Result: " + result.value);
            $.ajax({
                url: "/diklatpeserta/"+id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    keterangan:result.value
                },
                method: 'DELETE',
                success: function (response) {
                    console.log(response);
                    $('#users-table').DataTable().draw();
                }
            });
        }
    });
} 


function tambah_kelas(){
    var nama_kelas = $(".nama_kelas").val();
    var kelas_id = $(".kelas_id").val();
    $.ajax({
        url: "/tambah-kelas-diklat",
        data: {
            "_token": "{{ csrf_token() }}",
            nama_kelas: nama_kelas,
            kelas_id:kelas_id,
            diklat_id: {{ $diklat->id }}
        },
        method: 'POST',
        success: function (response) {
            console.log(response);
            location.reload();
            $("#alert").html('<div class="alert alert-primary" role="alert">Data Kelas Berhasil Ditambahkan</div>');
            $('#tambahKelas').modal('hide');
        }
    });
}


function show_bidang_keahlian(){
    var bidang_keahlian = $(".bidang_keahlian").val();
        $.ajax({
        url: "/ajax/programkeahlian-dropdown",
        data:{bidang_keahlian_id: bidang_keahlian},
        success: function(response){
            console.log(response);
            $("#bidang_keahlian").html(response);    
        }
        });
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
{{-- <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" /> --}}
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endpush

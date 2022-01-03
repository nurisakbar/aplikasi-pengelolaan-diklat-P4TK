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
                <td>Jumlah Peserta Terdaftar</td>
                <td>{{ $diklat->peserta->count() }}</td>
            </tr>
            <tr>
                <td>Jumlah Peserta Terkonfirmasi</td>
                <td>{{ $diklat->peserta->where('status','Terkonfirmasi')->count() }}</td>
            </tr>
        </table>

        <hr>
        <h3>Daftar Peserta Diklat</h3>
        <hr>

                <table class="table table-rounded table-striped border gy-7 gs-7" id="users-table">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                            <th width="10">No UKG</th>
                            <th>Nama Lengkap</th>
                            <th>Asal Sekolah</th>
                            <th>Kota</th>
                            <th>Provinsi</th>
                            <th>Nomor HP</th>
                            <th>Status</th>
                            <th width="110">#</th>
                        </tr>
                    </thead>
                </table>
        
    </div>

    @include('diklat.show-modal')
</div>
@endsection
@push('scripts')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/diklat/{{$diklat->id}}',
        columns: [
            { data: 'gtk.nomor_ukg', name: 'gtk.nomor_ukg' },
            { data: 'gtk.nama_lengkap', name: 'gtk.nama_lengkap' },
            { data: 'gtk.instansi.nama_instansi'},
            { data: 'gtk.instansi.wilayah_administratif.regency_name'},
            { data: 'gtk.instansi.wilayah_administratif.province_name'},
            { data: 'gtk.nomor_hp', name: 'gtk.nomor_hp' },
            { data: 'status_kehadiran', name: 'status_kehadiran' },
            { data: 'action', name: 'action' }
        ]
    });

});


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
    $.ajax({
        url: "/tambah-kelas-diklat",
        data: {
            "_token": "{{ csrf_token() }}",
            nama_kelas: nama_kelas,
            diklat_id: {{ $diklat->id }}
        },
        method: 'POST',
        success: function (response) {
            console.log(response);
            $("#alert").html('<div class="alert alert-primary" role="alert">Data Kelas Berhasil Ditambahkan</div>');
            $('#tambahKelas').modal('hide');
        }
    });
}
</script>
@endpush

@push('css')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endpush

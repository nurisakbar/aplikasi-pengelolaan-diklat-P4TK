@extends('layouts.app')
@section('title','Data Diklat')
@section('content')
@include('diklat.__toolbar-show')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <div class="content flex-row-fluid" id="kt_content">
        <div class="card">
            <div class="card-body py-4">
               @include('alert')
               <div id="alert"></div>

        <table class="table table-row-bordered">
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
        </table>

        <hr>
        <h3>Daftar Peserta Diklat</h3>
        <hr>

                <table class="table table-rounded table-striped border gy-7 gs-7" id="users-table">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                            <th width="10">NOPES</th>
                            <th>Nama GTK</th>
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
        </div>
    </div>

    @include('diklat.show-modal')
</div>
@endsection
@push('scripts')
<script src="https://preview.keenthemes.com/metronic8/demo11/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/diklat/{{$diklat->id}}',
        columns: [
            { data: 'nopes', name: 'nopes' },
            { data: 'gtk.nama_gtk', name: 'gtk.nama_gtk' },
            { data: 'gtk.asal_sekolah', name: 'gtk.asal_sekolah' },
            { data: 'gtk.kota', name: 'gtk.kota' },
            { data: 'gtk.provinsi', name: 'gtk.provinsi' },
            { data: 'gtk.simkb_nomor_hp', name: 'gtk.simkb_nomor_hp' },
            { data: 'status_kehadiran', name: 'status_kehadiran' },
            { data: 'action', name: 'action' }
        ]
    });

    $('#gtk-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/gtk',
        columns: [
            { data: 'nopes', name: 'nopes' },
            { data: 'nama_gtk', name: 'nama_gtk' },
            { data: 'asal_sekolah', name: 'asal_sekolah' },
            { data: 'kota', name: 'kota' },
            { data: 'provinsi', name: 'provinsi' },
            { data: 'keterangan', name: 'keterangan' },
            { data: 'pilih', name: 'pilih' }
        ]
    });
});


function tutup_modal_gtk(nopes)
{
    $('#exampleModal').modal('hide');
    console.log(nopes);
    $.ajax({
    url: "/gtk/"+nopes,
    cache: false,
    success: function(response){
        console.log(response.nopes);
        $('#nama').html(response.nama_gtk);
        $('#nopes').html(response.nopes);
        $('#asal_sekolah').html(response.asal_sekolah+' - '+response.provinsi);
        $('#mapel_ajar_dapodik').html(response.mapel_ajar_dapodik);
        $("#nopes_txt").val(response.nopes);
    }
});
}

function tambah_peserta(){
    var nopes = $("#nopes_txt").val();
    var diklat_kelas_id = $("#kelas").val();
    var diklat_id_txt = $("#diklat_id_txt").val();
    $.ajax({
    url: "/diklatpeserta/",
    data: {
        "_token": "{{ csrf_token() }}",
        diklat_kelas_id:diklat_kelas_id,
        diklat_id:diklat_id_txt,
        nopes:nopes,
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
    console.log(nopes);
    $.ajax({
    url: "/diklatpeserta/"+id,
    cache: false,
    success: function(response){
        //console.log(response.diklat_kelas_id);
        $('#nama_gtk').html(response.nama_gtk);
        $('#nopes_gtk').html(response.nopes);
        $('#asal_sekolah_gtk').html(response.asal_sekolah+' - '+response.provinsi);
        $('#mapel_ajar_dapodik_gtk').html(response.mapel_ajar_dapodik);
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
    <link href="https://preview.keenthemes.com/metronic8/demo11/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

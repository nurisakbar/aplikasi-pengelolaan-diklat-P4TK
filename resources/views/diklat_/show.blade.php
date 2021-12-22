@extends('layouts.app')
@section('title','Detail Diklat')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Diklat {{ $diklat->nama_diklat }}</h6>
    </div>
    <div class="card-body">
        <div id="alert"></div>

        <table class="table table-bordered">
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
        
        <h5>Daftar Peserta Diklat  
            <button type="button" style="float: right;margin-right:10px;"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahKelas">
                Tambah Kelas
              </button>

            <button type="button" style="float: right;margin-right:10px;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
            Tambah Peserta Diklat
          </button>
          <a href="/diklat/{{ $diklat->id }}/pdf" target="new" style="float: right;margin-right:10px;" class="btn btn-danger btn-sm">Download PDF</a>
        </h5>
        <hr>
        <div class="table-responsive">
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th width="10">NOPES</th>
                    <th>Nama GTK</th>
                    <th>Asal Sekolah</th>
                    <th>Provinsi - Kota</th>
                    <th>Status</th>
                    <th width="70">#</th>
                </tr>
            </thead>
        </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 90%;max-width:1200px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Daftar PTK</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tr>
                    <td colspan="2">FILTER DATA PTK</td>
                </tr>
                <tr>
                    <td>Provinsi</td>
                    <td>{{Form::select('provinsi',$provinsi,null,['class' => 'form-control','placeholder'=>'-- Semua Provinsi --'])}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="button" class="btn btn-danger">Filter Data</button>
                    </td>
                </tr>
            </table>
            <hr>
            <table class="table table-bordered" id="gtk-table">
                <thead>
                    <tr>
                        <th width="10">NOPES</th>
                        <th>Nama GTK</th>
                        <th>Asal Sekolah</th>
                        <th>Provinsi - Kota</th>
                        <th>Keterangan</th>
                        <th width="10">#</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Info Peserta -->
<div class="modal fade" id="modalPesertaTerpilih" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 60%;max-width:1200px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Biodata Guru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input id="nopes_txt" type="hidden">
            <input id="diklat_id_txt" type="hidden" value="{{$diklat->id}}">
         <table class="table table-bordered">
             <tr>
                 <td width="180">NOPENS</td>
                 <td id="nopes">
                 </td>
                 <td rowspan="5" width="200">
                     <img width="200" class="" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMQhVwnyVv3iHI8PyUUiQYl41sJ4Qy3wHWXKdEz3QOMRU48C2Gp6v3iqOT43otQqNJqic&usqp=CAU">
                 </td>
             </tr>
             <tr>
                <td>Nama</td>
                <td id="nama"></td>
            </tr>
            <tr>
                <td>Asal Sekolah</td>
                <td id="asal_sekolah"></td>
            </tr>
            <tr>
                <td>Mapel Ajar Dapodik</td>
                <td id="mapel_ajar_dapodik"></td>
            </tr>
             <tr>
                 <td>Pilih Kelas</td>
                 <td>{{ Form::select('kelas_id',$kelas,null,['class'=>'form-control','id'=>'kelas'])}}</td>
             </tr>
         </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="buka_modal_gtk()" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="tambah_peserta()">Tambahkan Peserta Ke Diklat</button>
        </div>
      </div>
    </div>
  </div>




  <!-- Info Peserta -->
<div class="modal fade" id="modalUbahStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 60%;max-width:1200px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Biodata Guru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input id="id" type="hidden">
            <input id="diklat_id_txt_gtk" type="hidden" value="{{$diklat->id}}">
         <table class="table table-bordered">
             <tr>
                 <td width="180">NOPES</td>
                 <td id="nopes_gtk">
                 </td>
                 <td rowspan="5" width="200">
                     <img width="200" class="" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMQhVwnyVv3iHI8PyUUiQYl41sJ4Qy3wHWXKdEz3QOMRU48C2Gp6v3iqOT43otQqNJqic&usqp=CAU">
                 </td>
             </tr>
             <tr>
                <td>Nama</td>
                <td id="nama_gtk"></td>
            </tr>
            <tr>
                <td>Asal Sekolah</td>
                <td id="asal_sekolah_gtk"></td>
            </tr>
            <tr>
                <td>Mapel Ajar Dapodik</td>
                <td id="mapel_ajar_dapodik_gtk"></td>
            </tr>
             <tr>
                 <td>Kelas</td>
                 <td>{{ Form::select('kelas_id',$kelas,null,['class'=>'form-control','id'=>'kelas_id_txt'])}}</td>
             </tr>
             <tr>
                <td>Status Kehadiran</td>
                <td>{{ Form::select('status_kehadiran',['Menunggu Konfirmasi'=>'Menunggu Konfirmasi','Terkonfirmasi'=>'Terkonfirmasi'],null,['class'=>'form-control','id'=>'status_kehadiran'])}}</td>
            </tr>
         </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="simpan_perubahan()">Simpan Perubahan</button>
        </div>
      </div>
    </div>
  </div>



<!-- Modal -->
<div class="modal fade" id="tambahKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <table class="table table-bordered">
             <tr>
                 <td>Nama Kelas</td>
                 <td>{{ Form::text('nama_kelas',null,['class' => 'form-control nama_kelas','placeholder' => 'Nama Kelas'])}}</td>
             </tr>
         </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="tambah_kelas()">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  

@endsection

@push('scripts')
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
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
            { data: 'gtk.provinsi', name: 'gtk.provinsi' },
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
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush



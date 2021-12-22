
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 90%;max-width:1200px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Daftar PTK</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
            <table class="table table-rounded table-striped border gy-7 gs-7" id="gtk-table">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                        <th width="10">NOPES</th>
                        <th>Nama GTK</th>
                        <th>Asal Sekolah</th>
                        <th>Kota</th>
                        <th>Provinsi</th>
                        <th>Keterangan</th>
                        <th width="10">#</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
          <button type="button" class="btn btn-secondary" onclick="buka_modal_gtk()" data-bs-dismiss="modal">Tutup</button>
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
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
            
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="tambah_kelas()">Simpan</button>
        </div>
      </div>
    </div>
  </div>
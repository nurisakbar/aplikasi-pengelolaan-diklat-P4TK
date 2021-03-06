

<!-- Modal -->
<div class="modal fade" tabindex="-1" id="exampleModal">
  <div class="modal-dialog" style="width: 90%;max-width:1200px;">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Daftar Guru</h5>

              <!--begin::Close-->
              <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                  <span class="svg-icon svg-icon-2x"></span>
              </div>
              <!--end::Close-->
          </div>

          <div class="modal-body">
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
                    <td>Bidang Keahlian</td>
                    <td>
                        <div class="row">
                            <div class="col-md-4">
                                {{ Form::select('bidang_keahlian',\App\BidangKeahlian::pluck('nama_bidang_keahlian', 'id'),null,['class' => 'form-control bidang_keahlian','placeholder'=>'-- Semua Bidang Keahlian --','onChange'=>'show_bidang_keahlian()'])}}
                            </div>
                            <div class="col-md-6">
                                <div id="bidang_keahlian"></div>
                            </div>
                        </div>
                        
                    </td>
                  </tr>
              <tr>
                <td>Nama Calon Peserta</td>
                <td>
                    {{ Form::text('nama_gtk',null,['class' => 'form-control txt_nama_gtk','placeholder'=>'Nama Calon Peserta'])}}
                </td>
            </tr>
              <tr>
                  <td></td>
                  <td>
                      <button type="button" class="btn btn-primary" onclick="filterData()">Cari</button>
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tambah Data</button>
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                  </td>
              </tr>
          </table>
          <hr>
          <table class="table table-rounded table-striped border gy-7 gs-7" id="gtk-table">
              <thead>
                  <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                      <th width="10">Nomor UKG</th>
                      <th>Nama GTK</th>
                      <th>Umur</th>
                      <th>Asal Sekolah</th>
                      <th>Kota</th>
                      <th>Provinsi</th>
                      <th>Terakhir Diklat</th>
                      <th width="10">#</th>
                  </tr>
              </thead>
          </table>
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
                 <td width="180">Nomor UKG</td>
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
                 <td>{{ Form::select('kelas_id',$kelas,null,['class'=>'form-control','id'=>'kelas_id_txt','placeholder'=>'Pilih Kelas'])}}</td>
             </tr>
             <tr>
                <td>Status Peserta</td>
                <td>{{ Form::select('status_kehadiran',['Pendaftar'=>'Pendaftar','Peserta'=>'Peserta'],null,['class'=>'form-control','id'=>'status_kehadiran'])}}</td>
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
          <h5 class="modal-title" id="exampleModalLabel">Management Kelas</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" class="kelas_id">
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


  <div class="modal fade" tabindex="-1" id="modalPesertaTerpilih">
    <div class="modal-dialog" style="width: 60%;max-width:1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail GTK</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="/diklat/{{ $diklat->id}}?tab=pendaftar">Biodata Guru</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link link_detail_peserta" target="new">Riwayat Diklat</a>
                    </li>
                  </ul>
              <input id="peserta_id_txt" type="hidden">
              <input id="diklat_id_txt" type="hidden" value="{{$diklat->id}}">
           <table class="table table-bordered">
               <tr>
                   <td width="180">Nomor UKG</td>
                   <td id="nomor_ukg">
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
               <tr>
                   <td>Kirim Notifikasi WA</td>
                   <td>
                       <input type="radio" name="notif_wa" value="1" checked> Ya

                       <input type="radio" name="notif_wa" value="0"> Tidak
                   </td>
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








<!-- Modal Tambah Kelas-->
<div class="modal fade" tabindex="-1" id="exampleModalKelas">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Tambah Kelas Baru</h5>

              <!--begin::Close-->
              <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                  <span class="svg-icon svg-icon-2x"></span>
              </div>
              <!--end::Close-->
          </div>

          {{ Form::open(['url'=>'kelas-diklat']) }}
          {{ Form::hidden('diklat_id',$diklat->id) }}
          <div class="modal-body">
            <table class="table table-bordered">
              <tr>
                  <td>Nama Kelas</td>
                  <td>
                      {{ Form::text('nama_kelas',null,['class' => 'form-control','placeholder'=>'Nama Kelas'])}}
                  </td>
                </tr>
              <tr>
                  <td></td>
                  <td>
                      <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Tambah Data</button>
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                  </td>
              </tr>
          </table>
          {{ Form::close() }}
          </div>
      </div>
  </div>
</div>
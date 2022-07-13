@extends('layouts.app')
@section('title','Data Diklat')
@section('content')
@include('diklat.toolbar')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
  {{ Form::open(['url'=>'diklat','method'=>'GET']) }}
    <div class="content flex-row-fluid" id="kt_content">
      <table class="table table-bordered">
        <tr class="table-active">
            <td colspan="2">FILTER DATA DIKLAT</td>
        </tr>
        <tr>
            <td width="200">Tahun Pelaksanaan</td>
            <td>
                <select class="form-control txt_tahun">
                  <option value="0">-- Semua Tahun  --</option>
                  @for($tahun=2022;$tahun>=2000;$tahun--)
                  <option value="{{ $tahun}}">{{ $tahun }}</option>
                  @endfor
                </select>
            </td>
        </tr>
        <tr>
          <td>Departemen</td>
          <td>
            {{Form::select('departemen_id',$departemen,null,['class' => 'form-control txt_departemen_id','placeholder'=>'-- Semua Departemen --'])}}
          </td>
        </tr>
        <tr>
          <td>Kategori Diklat</td>
          <td>
            {{Form::select('kategori_id',$kategori,null,['class' => 'form-control txt_kategori_diklat_id','placeholder'=>'-- Semua Kategori --'])}}
          </td>
        </tr>
        <tr>
          <td>Bidang Keahlian</td>
          <td>
            <div class="row">
              <div class="col-md-4">
                {{Form::select('bidang_keahlian_id',$bidangKeahlian,null,['class' => 'form-control txt_bidang_keahlian','placeholder'=>'-- Semua Bidang Keahlian --','onChange'=>'load_program_keahlian()'])}}
              </div>
              <div class="col-md-4">
                <div id="program_keahlian"></div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>Nama Diklat</td>
          <td>
            <div class="row">
              <div class="col-md-8">
                {{Form::text('nama_diklat',null,['class' => 'form-control txt_nama_diklat','placeholder'=>'Nama Diklat'])}}
              </div>
              <div class="col-md-4">
                <div id="program_keahlian"></div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="button" class="btn btn-danger" onclick="filterData()">Filter Data</button>
            </td>
        </tr>
    </table>
    {{Form::close()}}
        @include('alert')
        <table class="table table-rounded table-striped border gy-7 gs-7" id="users-table">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                    {{-- <th width="10">Nomor</th> --}}
                    <th>Nama Kegiatan/ Diklat</th>
                    <th>Kategori</th>
                    <th>Pola Diklat</th>
                    <th>Departemen</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Jumlah Peserta</th>
                    <th>Quota</th>
                    <th>Status Aktif</th>
                    <th width="170">#</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 60%;max-width:600px;">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Import Riwayat Diklat</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ Form::open(['url'=>'diklat/import','files'=>true])}}
                <div class="alert alert-primary">
                  <div class="d-flex flex-column">
                      <h4 class="mb-1 text-dark">Informasi</h4>
                      <span>Digunakan untuk melakukan import data diklat beserta dengan data peserta</span>
                  </div>
              </div>
              <table class="table table-bordered">
                <tr>
                    <td>Periode</td>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" required class="form-control" name="tahun" placeholder="Tahun">
                            </div>
                            <div class="col-md-4">
                                <input type="date" required class="form-control" name="tanggal_mulai" placeholder="Tanggal Mulai">
                            </div>
                            <div class="col-md-4">
                                <input type="date" required class="form-control" name="tanggal_selesai" placeholder="Tanggal Selesai">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Departemen</td>
                    <td>
                        {!! Form::select('departemen_id', $departemen, null, ['class'=>'form-control']) !!}
                    </td>
                </tr>
                <tr>
                  <td>Pola Diklat</td>
                  <td>
                      {!! Form::text('pola_diklat', null, ['class'=>'form-control','placeholder'=>'Pola Diklat']) !!}
                  </td>
              </tr>
                  <tr>
                      <td>File</td>
                      <td>
                          <input type="file" name="file" class="form-control">
                      </td>
                  </tr>
              </table>
             
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <a href="{{asset('Laporan-AJUAN-Pemrograman-CNC-Turning-dan-Milling-241220212013.xlsx')}}" class="btn btn-secondary">Download Template Import</a>
              
              <button type="submit" class="btn btn-danger">Upload Dan Proses</button>
            </div>
            {{Form::close()}}
          </div>
        </div>
      </div>



      <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 60%;max-width:600px;">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Import Diklat</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ Form::open(['url'=>'diklat/import-diklat','files'=>true])}}

                <div class="alert alert-primary">
                  <div class="d-flex flex-column">
                      <h4 class="mb-1 text-dark">Informasi</h4>
                      <span>Fitur ini digunakan untuk melakukan import data diklat</span>
                  </div>
              </div>
              <table class="table table-bordered">
                  <tr>
                      <td>File</td>
                      <td>
                          <input type="file" name="file" class="form-control">
                      </td>
                  </tr>
              </table>
             
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <a href="{{asset('template-import-diklat.xlsx')}}" class="btn btn-secondary">Download Template Import</a>
              
              <button type="submit" class="btn btn-danger">Upload Dan Proses</button>
            </div>
            {{Form::close()}}
          </div>
        </div>
      </div>

</div>
@endsection
@push('scripts')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/diklat',
            columns: [
                // {data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'nama_diklat', name: 'nama_diklat' },
                { data: 'kategori.nama_kategori', name: 'kategori.nama_kategori' },
                { data: 'pola_diklat', name: 'pola_diklat' },
                { data: 'departemen.nama_departemen', name: 'departemen.nama_departemen' },
                { data: 'tanggal_mulai', name: 'tanggal_mulai' },
                { data: 'tanggal_selesai', name: 'tanggal_selesai' },
                { data: 'jumlah_peserta', name: 'jumlah_peserta' },
                { data: 'quota', name: 'qupta' },
                { data: 'status_aktif', name: 'status_aktif' },
                { data: 'action', name: 'action' }
            ]
        });
    });

function filterData(){
    var tahun     = $(".txt_tahun").val();
    var departemen_id             = $(".txt_departemen_id").val();
    var kategori_diklat_id        = $('.txt_kategori_diklat_id').val();
    var bidang_keahlian_id        = $('.txt_bidang_keahlian').val();
    var program_keahlian_id       = $('.program_keahlian_id').val();
    var nama_diklat               = $('.txt_nama_diklat').val();
    var params = '/diklat?tahun='+tahun+'&departemen_id='+departemen_id+'&kategori_diklat_id='+kategori_diklat_id+'&bidang_keahlian_id='+bidang_keahlian_id+"&program_keahlian_id="+program_keahlian_id+'&nama_diklat='+nama_diklat;
    $('#users-table').DataTable().ajax.url(params).load();
}

function load_program_keahlian(){
    var bidang_keahlian_id = $('.txt_bidang_keahlian').val();
    if(bidang_keahlian_id>0)
    {
      console.log(bidang_keahlian_id);
      $.ajax({
        url: "/ajax/programkeahlian-dropdown",
        
        data:{bidang_keahlian_id: bidang_keahlian_id},
        success: function(response){
            console.log(response);
            $("#program_keahlian").html(response);
            $("#program_keahlian").show();
        }
        });
    }else{
      $("#program_keahlian").hide();
    }
}
</script>
@endpush

@push('css')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endpush



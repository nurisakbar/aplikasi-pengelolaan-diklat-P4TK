@extends('layouts.app')
@section('title','Data Instansi')
@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <div class="content flex-row-fluid" id="kt_content">
        <div class="card">
            <div class="card-body py-4">
               @include('alert')
               <div id="alert"></div>

        <table class="table table-row-bordered">
            <tr>
                <td width="300">Nama Instansi</td>
                <td>{{ $instansi->nama_instansi }}</td>
            </tr>
            <tr>
                <td>Provinsi</td>
                <td>{{ $instansi->wilayahAdministratif->province_name }}</td>
            </tr>
            <tr>
                <td>Kabupaten</td>
                <td>{{ $instansi->wilayahAdministratif->regency_name }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>{{ $instansi->alamat }}</td>
            </tr>
        </table>
        <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link {{request('tab')=='guru'?'active':''}}" href="/instansi/{{ $instansi->id}}?tab=guru">Daftar Guru</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{request('tab')=='keahlian'?'active':''}}" href="/instansi/{{ $instansi->id}}?tab=keahlian">Daftar Keahlian</a>
            </li>
          </ul>
        <hr>
        @if($_GET['tab']=='keahlian')
        <h3>Kompetensi Keahlian {{ $instansi->nama_instansi }} 
            <button style="float: right" type="button" class="btn btn-danger fw-bolder btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalKelas">
            <i class="far fa-plus-square"></i> Tambah Kompetensi
          </button></h3>
        <table class="table table-rounded table-striped border gy-7 gs-7" id="keahlian-table">
            <thead>
                <tr>
                    <td>Nomor</td>
                    <td>Nama Kompetensi Keahlian</td>
                    <td width="100">Action</td>
                </tr>
            </thead>
                <tbody>
                    @foreach($instansi->kompetensiKeahlian as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->kompetensiKeahlian->nama_kompetensi_keahlian}}</td>
                            <td>
                                {{ Form::open(['url'=>'instansi-kompetensi-keahlian/'.$row->id,'method'=>'delete'])}}
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                {{ Form::close()}}
                            </td>
                        </tr>
                    @endforeach
        </tbody>
        </table>
        @else
            <h3>Daftar Guru {{ $instansi->nama_instansi }}</h3>
            <hr>

                    <table class="table table-rounded table-striped border gy-7 gs-7" id="instansi-table">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                <th width="10">No</th>
                                <th>Nomor UKG</th>
                                <th width="150">Nama Guru</th>
                                <th>Mapel Dapodik</th>
                                <th>Email</th>
                                <th>HP</th>
                                <th>NIK</th>                        
                                <th width="30">#</th>
                            </tr>
                        </thead>
                    </table>
        @endif
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah Kelas-->
<div class="modal fade" tabindex="-1" id="exampleModalKelas">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kompetensi Keahlian</h5>
  
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>
  
            {{ Form::open(['url'=>'instansi-kompetensi-keahlian']) }}
            {{ Form::hidden('instansi_id',$instansi->id) }}
            <div class="modal-body">
              <table class="table table-bordered">
                <tr>
                    <td>Pilih Kompetensi Keahlian</td>
                    <td>
                        {{Form::select('kompetensi_keahlian_id',$kompetensi,$_GET['kompetensi_keahlian_id']??null,['class' => 'form-control komepetensi_keahlian_id','placeholder'=>'-- Semua Kompetensi --'])}}
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
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="{{asset('asset/custom/documentation/forms/select2.js')}}"></script>
<script>
$(function() {
    $('.komepetensi_keahlian_id').select2({ dropdownParent: "#exampleModalKelas" });
    $('#instansi-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/instansi/{{$instansi->id}}',
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'nomor_ukg', name: 'nomor_ukg' },
            { data: 'nama_lengkap', name: 'nama_lengkap' },
            { data: 'mapel_ukg_ptk', name: 'mapel_ukg_ptk' },
            { data: 'email', name: 'email' },
            { data: 'nomor_hp', name: 'nomor_hp' },
            { data: 'nik', name: 'nik' },
            { data: 'action', name: 'action' }
        ]
    });
    $('#keahlian-table').DataTable();
});

</script>
@endpush

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush

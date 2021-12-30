@extends('layouts.app')
@section('title','Data Diklat')
@section('content')
@include('diklat.toolbar')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <div class="content flex-row-fluid" id="kt_content">
        @include('alert')
        <table class="table table-rounded table-striped border gy-7 gs-7" id="users-table">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                    <th width="10">Nomor</th>
                    <th>Nama Diklat</th>
                    <th>Kategori</th>
                    <th>Kompetensi Keahlian</th>
                    <th>Tahun Pelaksaan</th>
                    <th>Jumlah Peserta</th>
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
                      <td>File</td>
                      <td>
                          <input type="file" name="file" class="form-control">
                      </td>
                  </tr>
              </table>
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Upload Dan Proses</button>
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
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'nama_diklat', name: 'nama_diklat' },
                { data: 'kategori.nama_kategori', name: 'kategori.nama_kategori' },
                { data: 'program_keahlian.nama_program_keahlian', name: 'program_keahlian.nama_program_keahlian' },
                { data: 'tahun', name: 'tahun' },
                { data: 'jumlah_peserta', name: 'jumlah_peserta' },
                { data: 'status_aktif', name: 'status_aktif' },
                { data: 'action', name: 'action' }
            ]
        });
    });
    </script>
@endpush

@push('css')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endpush

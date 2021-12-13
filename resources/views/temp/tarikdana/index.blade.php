@extends('layouts.app')
@section('title','Laporan Tarik Dana')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Tarik Dana</h6>
    </div>
    <div class="card-body">
        @include('alert')
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
            Download Excel
          </button>
        @if(Auth::user()->level!='administrator')
            <a href="/tarikdana/create" class="btn btn-danger">Input Transaksi Tarik Dana</a>
            <hr>
        @endif
        <hr>
        
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th width="10">No</th>
                    <th>Karyawan</th>
                    <th>Nama Toko</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    @if(Auth::user()->level=='administrator')
                      <th width="70">#</th>
                    @endif
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal -->
{!! Form::open(['url'=>'tarikdana','method'=>'GET']) !!}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Periode</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="download" value="excel">
          <table class="table table-bordered">
              <tr>
                  <td>Pilih Bulan</td>
                  <td>
                      <input type="text" name="periode" class="form-control month" placeholder="Bulan" required>
                  </td>
              </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Download</button>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
@endsection



@push('scripts')
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="https://cdn.rawgit.com/digitalBush/jquery.maskedinput/1.4.1/dist/jquery.maskedinput.min.js"></script>
<script src="https://kidsysco.github.io/jquery-ui-month-picker/MonthPicker.min.js"></script>
@if(Auth::user()->level!='administrator')
  <script>
  $(function() {
      $('.month').MonthPicker({ Button: false });
      $('#users-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: '/tarikdana',
          columns: [
              {data: 'DT_RowIndex', orderable: false, searchable: false},
              { data: 'toko.user.name', name: 'toko.user.name' },
              { data: 'toko.nama_toko', name: 'toko.nama_toko' },
              { data: 'tanggal', name: 'tanggal' },
              { data: 'jumlah', name: 'jumlah' },
          ]
      });
  });
  </script>
@else
  <script>
    $(function() {
        $('.month').MonthPicker({ Button: false });
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/tarikdana',
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'toko.user.name', name: 'toko.user.name' },
                { data: 'toko.nama_toko', name: 'toko.nama_toko' },
                { data: 'tanggal', name: 'tanggal' },
                { data: 'jumlah', name: 'jumlah' },
                { data: 'action', name: 'action' },
            ]
        });
    });
    </script>
@endif
@endpush

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
    <link href="https://kidsysco.github.io/jquery-ui-month-picker/MonthPicker.min.css" rel="stylesheet" type="text/css" />
@endpush



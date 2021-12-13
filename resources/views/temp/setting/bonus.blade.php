@extends('layouts.app')
@section('title','Kelola Data Pegawai')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Setting Bonus</h6>
    </div>
    <div class="card-body">
        @include('setting.navigasi')
        @include('alert')
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
            </button>
        <hr>
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th width="10">Nomor</th>
                    <th>Dari Profit Perbulan</th>
                    <th>Sampai</th>
                    <th>Jumlah Bonus</th>
                    <th width="60">#</th>
                </tr>
            </thead>
        </table>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Setting Bonus</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['url'=>'setting']) !!}
            {!! Form::hidden('jenis', 'bonus') !!}
          <table class="table table-bordered">
              <tr>
                  <td>Dari Mulai</td>
                  <td>{!! Form::text('dari', null, ['class'=>'form-control','required','placeholder'=>'Dari Mulai']) !!}</td>
              </tr>
              <tr>
                <td>Sampai</td>
                <td>{!! Form::text('sampai', null, ['class'=>'form-control','required','placeholder'=>'Sampai Profit']) !!}</td>
            </tr>
            <tr>
                <td>Bonus</td>
                <td>
                  <div class="input-group mb-3">
          
                  {!! Form::text('bonus', null, ['class'=>'form-control','required','placeholder'=>'Jumlah Bonus']) !!}
                
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">%</span>
                  </div>
                  </div>                </td>
            </tr>
          </table>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="practice_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Setting Bonus</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['url'=>'setting']) !!}
            {!! Form::hidden('jenis', 'update-bonus') !!}
            <input type="hidden" name="id" class="id-bonus">
          <table class="table table-bordered">
              <tr>
                  <td>Dari Mulai</td>
                  <td>{!! Form::text('dari', null, ['class'=>'form-control dari','required','placeholder'=>'Dari Mulai']) !!}</td>
              </tr>
              <tr>
                <td>Sampai</td>
                <td>{!! Form::text('sampai', null, ['class'=>'form-control sampai','required','placeholder'=>'Sampai Profit']) !!}</td>
            </tr>
            <tr>
                <td>Bonus</td>
                <td>
                  <div class="input-group mb-3">
  
                  {!! Form::text('bonus', null, ['class'=>'form-control bonus','required','placeholder'=>'Jumlah Bonus']) !!}
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">%</span>
                  </div>
                  </div>
                </td>
            </tr>
          </table>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection

@push('scripts')
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/setting/bonus',
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'dari', name: 'dari' },
                { data: 'sampai', name: 'sampai' },
                { data: 'bonus', name: 'bonus' },
                { data: 'action', name: 'action' }
            ]
        });
    });

    $('body').on('click', '#editCompany', function (event) {

    event.preventDefault();
    var id = $(this).data('id');
    $.get('setting/bonus/' + id , function (data) {
        $('#practice_modal').modal('show');
        $('.dari').val(data.dari);
        $('.sampai').val(data.sampai);
        $('.bonus').val(data.bonus);
        $('.id-bonus').val(data.id);
    })
    });
</script>
@endpush

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush

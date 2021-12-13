@extends('layouts.app')
@section('title','Laporan Rekapan')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Rekapan</h6>
    </div>
    <div class="card-body">
        @include('alert')
        {!! Form::open(['url'=>'rekapan','method'=>'GET']) !!}
        <table class="table table-bordered">
            <tr>
                <td>Periode Awal</td>
                <td>
                    {!! Form::date('periode_awal', $periode_awal, ['class'=>'form-control periode_awal','placeholder'=>'Periode Awal']) !!}
                </td>
            </tr>
            <tr>
                <td>Periode Akhir</td>
                <td>
                    {!! Form::date('periode_akhir', $periode_akhir, ['class'=>'form-control periode_akhir','placeholder'=>'Periode Akhir']) !!}
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="button" value="filter" class="btn btn-primary">Tampilkan</button>
                    <button type="submit" name="button" value="excel" class="btn btn-primary">Download Excel</button>
                    @if(Auth::user()->level!='administrator')
                        <a href="/penjualan/create" class="btn btn-danger">Input Penjualan</a>
                    @endif
                </td>
            </tr>
        </table>
        {!! Form::close() !!}
        <div class="table-responsive">
            @include('rekapan.table')
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
    $('#example').DataTable({
        "iDisplayLength": 100,
        "aLengthMenu": [[10, 25, 50, 100,200,300], ["10", "25", "50", "100","200","300"]]
    });
} );
</script>
@endpush

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush



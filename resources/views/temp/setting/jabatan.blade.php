@extends('layouts.app')
@section('title','Kelola Data Pegawai')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Setting Tunjangan Jabatan</h6>
    </div>
    <div class="card-body">
        @include('setting.navigasi')
        <div class="alert alert-primary" role="alert">
            Data Tunjangan Jabatan Disimpan Secara Otomatis
          </div>
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th width="10">Nomor</th>
                    <th>Nama Jabatan</th>
                    <th width="200">Tunjangan</th>
                </tr>
            </thead>
        </table>
@endsection

@push('scripts')
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/jabatan',
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'nama_jabatan', name: 'nama_jabatan' },
                { data: 'tunjangan', name: 'tunjangan' }
            ]
        });
    });

    function updateTunjangan(id)
    {
        console.log(id);
        var tunjangan = $(".tunjangan-"+id).val();
        console.log(tunjangan);
        $.ajax({
            url: "/jabatan/update-tunjangan",
            data:{tunjangan:tunjangan,id:id},
            cache: false,
            success: function (html) {
                // setTimeout(function() {
                //     toastr.info('Data Berhasil Di Update');
                // }, 5000);
            }
        });
    }
</script>
@endpush

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endpush

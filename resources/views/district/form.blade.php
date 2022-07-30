<div class="mb-10">
    <label class="form-label">ID</label>
    {!! Form::text('id', null, ['class'=>'form-control','placeholder'=>'ID Kecamatan','maxlength'=>6]) !!}
</div>
<div class="mb-10">
    <label class="form-label">Nama Kecamatan</label>
    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Nama Kecamatan']) !!}
</div>
<div class="mb-10">
    <label class="form-label">Pilih Kabupaten</label>
    {!! Form::select('regency_id',\App\regency::pluck('name','id'), null, ['class'=>'form-control js-example-basic-single']) !!}
</div>
<div class="mb-10">
    <button type="submit" class="btn btn-danger">Simpan Data</button>
    <a href="/regency" class="btn btn-danger">Kembali</a>
</div>



@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function() {
        $(document).ready(function() {
        $('.js-example-basic-single').select2();
});
    });
    </script>
@endpush

@push('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush

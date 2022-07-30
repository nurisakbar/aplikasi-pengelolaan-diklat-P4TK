<div class="mb-10">
    <label class="form-label">ID</label>
    {!! Form::text('id', null, ['class'=>'form-control','placeholder'=>'ID Kabupaten','maxlength'=>4]) !!}
</div>
<div class="mb-10">
    <label class="form-label">Nama Kabupaten</label>
    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Nama Kabupaten']) !!}
</div>
<div class="mb-10">
    <label class="form-label">Nama Provinsi</label>
    {!! Form::select('province_id',\App\Province::pluck('name','id'), null, ['class'=>'form-control']) !!}
</div>
<div class="mb-10">
    <button type="submit" class="btn btn-danger">Simpan Data</button>
    <a href="/regency" class="btn btn-danger">Kembali</a>
</div>

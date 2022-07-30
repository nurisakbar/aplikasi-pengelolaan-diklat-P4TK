<div class="mb-10">
    <label class="form-label">ID</label>
    {!! Form::text('id', null, ['class'=>'form-control','placeholder'=>'ID Provinsi','maxlength'=>2]) !!}
</div>
<div class="mb-10">
    <label class="form-label">Nama Provinsi</label>
    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Nama Provinsi']) !!}
</div>
<div class="mb-10">
    <button type="submit" class="btn btn-danger">Simpan Data</button>
    <a href="/provinsi" class="btn btn-danger">Kembali</a>
</div>

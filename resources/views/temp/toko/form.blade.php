<div class="form-group">
    <label for="exampleInputEmail1">Nama Toko</label>
    {!! Form::text('nama_toko', null, ['class'=>'form-control','placeholder'=>'Nama Toko']) !!}
</div>
<div class="form-group">
  <label for="exampleInputEmail1">Email</label>
  {!! Form::text('email', null, ['class'=>'form-control','placeholder'=>'Email']) !!}
</div>
<div class="form-group">
  <label for="exampleInputEmail1">Kategori Toko</label>
  {!! Form::text('kategori_toko', null, ['class'=>'form-control','placeholder'=>'Kategori Toko']) !!}
</div>
  <button type="submit" class="btn btn-primary">Simpan Toko</button>
  <a href="/toko" class="btn btn-primary">Kembali</a>
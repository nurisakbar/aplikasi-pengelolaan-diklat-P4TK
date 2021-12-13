<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Jabatan</label>
      {!! Form::text('nama_diklat', null, ['class'=>'form-control','placeholder'=>'Nama Diklat']) !!}
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <label for="exampleInputEmail1">Tahun Pelaksaan</label>
      {!! Form::text('tahun', null, ['class'=>'form-control','placeholder'=>'Tahun']) !!}
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <label for="exampleInputEmail1">Status Aktif</label>
      {!! Form::select('status_aktif',['Aktif'=>'Aktif','Tidak Aktif'=>'Tidak Aktif'], null, ['class'=>'form-control']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <button type="submit" class="btn btn-primary">Simpan Diklat</button>
    <a href="/diklat" class="btn btn-primary">Kembali</a>
  </div>
</div>

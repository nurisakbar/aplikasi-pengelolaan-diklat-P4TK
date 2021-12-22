<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Jabatan</label>
      {!! Form::text('nama_diklat', null, ['class'=>'form-control','placeholder'=>'Nama Diklat']) !!}
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="exampleInputEmail1">Tahun Pelaksaan</label>
      {!! Form::text('tahun', null, ['class'=>'form-control','placeholder'=>'Tahun']) !!}
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Departement</label>
      {!! Form::select('departement',['Departemen A'=>'Departemen A','Departemen B'=>'Departemen B'], null, ['class'=>'form-control']) !!}
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="exampleInputEmail1">Jumlah Quota</label>
      {!! Form::text('quota', null, ['class'=>'form-control','placeholder'=>'Quota']) !!}
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Kompetensi Keahlian</label>
      {!! Form::text('kompetensi_keahlian', null, ['class'=>'form-control','placeholder'=>'Kompetensi']) !!}
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="exampleInputEmail1">Status Aktif</label>
      {!! Form::select('status_aktif',['Aktif'=>'Aktif','Tidak Aktif'=>'Tidak Aktif'], null, ['class'=>'form-control']) !!}
    </div>
  </div>

</div>
<hr>
<h5>Kelola Kelas Diklat</h5>
<hr>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Kelas</label>
      {!! Form::text('kelas[]', null, ['class'=>'form-control','placeholder'=>'Nama Kelas']) !!}
    </div>
  </div>
  <div class="col-md-8"></div>
  {{-- <div class="col-md-4">
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Kelas</label>
      {!! Form::text('kelas[]', null, ['class'=>'form-control','placeholder'=>'Nama Kelas']) !!}
    </div>
  </div> --}}
  <div class="col-md-8"></div>
  <div class="col-md-12">
    <button type="submit" class="btn btn-primary">Simpan Diklat</button>
    <a href="/diklat" class="btn btn-primary">Kembali</a>
  </div>
</div>

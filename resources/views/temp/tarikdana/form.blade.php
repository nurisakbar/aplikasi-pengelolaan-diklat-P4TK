<div class="form-group">
    <label for="exampleInputEmail1">Pilih Toko</label>
    {!! Form::select('toko_id',$toko, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
  <label for="exampleInputEmail1">Tanggal Penarikan</label>
  {!! Form::date('tanggal', null, ['class'=>'form-control','placeholder'=>'tanggal']) !!}
</div>
<div class="form-group">
  <label for="exampleInputEmail1">Jumlah</label>
  {!! Form::text('jumlah', null, ['class'=>'form-control','placeholder'=>'Jumlah']) !!}
</div>
  <button type="submit" class="btn btn-primary">Simpan</button>
  <a href="/tarikdana" class="btn btn-primary">Kembali</a>
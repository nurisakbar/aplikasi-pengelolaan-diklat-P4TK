<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label for="exampleInputEmail1">Tanggal</label>
      {!! Form::date('tanggal', null, ['class'=>'form-control','placeholder'=>'Tanggal','required'=>'required']) !!}
  </div>
  </div>
</div>

@foreach($users  as $user)
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Karyawan</label>
      @if(isset($absensi))
        {{ Form::hidden('id[]',$absensi->id) }}
      @endif
      {{ Form::hidden('user_id[]',$user->id) }}
      {!! Form::text('user_name[]', $user->name, ['class'=>'form-control','readonly'=>'readonly']) !!}
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="exampleInputEmail1">Status Kehadiran</label>
      {!! Form::select('status_kehadiran[]',['h'=>'Hadir','t'=>'Tidak Hadir'], null, ['class'=>'form-control']) !!}
    </div>
  </div>
  <div class="col-md-5">
    <div class="form-group">
      <label for="exampleInputEmail1">Keterangan</label>
      {!! Form::text('keterangan[]', null, ['class'=>'form-control','placeholder'=>'Keterangan']) !!}
    </div>
  </div>
</div>
@endforeach
  <button type="submit" class="btn btn-primary">Simpan Kehadiran</button>
  <a href="/absensi" class="btn btn-primary">Kembali</a>
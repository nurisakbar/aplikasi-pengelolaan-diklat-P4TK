<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Jabatan</label>
      {!! Form::text('nama_jabatan', null, ['class'=>'form-control','placeholder'=>'Nama Jabatan']) !!}
  </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputEmail1">Jenis Jabatan</label>
      {!! Form::select('level',  ['leader'=>'Leader','kelompok'=>'Kelompok'], null, ['class'=>'level form-control','onChange'=>'load_kelompok()']) !!}
    </div>
  </div>
</div>


<div class="form-group kelompok">
  <label for="exampleInputEmail1">Pilih Leader</label>
  {!! Form::select('jabatan_id',  $leader, null, ['class'=>'level form-control']) !!}
</div>
  <button type="submit" class="btn btn-primary">Simpan Jabatan</button>
  <a href="/jabatan" class="btn btn-primary">Kembali</a>


@push('scripts')
<script >
  $(document).ready(function () {
    load_kelompok();
  });

function load_kelompok() {
  var level = $(".level").val();
  console.log(level);
  if (level == 'leader') {
    $(".kelompok").hide();
  } else {
    $(".kelompok").show();
  }
} 
</script>
@endpush
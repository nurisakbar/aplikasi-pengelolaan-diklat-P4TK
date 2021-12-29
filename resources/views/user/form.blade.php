@if(isset($user))
 <input type="hidden" id="jabatan_id_value" value="{{ $user->jabatan_id}}">
@endif
<div class="row mb-3">
  <div class="col-md-6 mb-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Pegawai</label>
      {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Nama Lengkap']) !!}
    </div>
  </div>
  <div class="col-md-6 mb-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Email</label>
      {!! Form::text('email', null, ['class'=>'form-control','placeholder'=>'Email']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" placeholder="Password">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputEmail1" >Jabatan</label>
      {!! Form::select('level', array_merge(['' => '--Pilih jabatan--'], $jabatan), null, ['class'=>'form-control']) !!}
    </div>
  </div>
</div>

{{-- <div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputEmail1">Tempat Lahir</label>
      {!! Form::text('tempat_lahir', null, ['class'=>'form-control','placeholder'=>'Tempat Lahir']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputEmail1">Tanggal Lahir</label>
      {!! Form::date('tanggal_lahir', null, ['class'=>'form-control','placeholder'=>'Tanggal Lahir']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputEmail1">Tanggal  Mulai Bekerja</label>
      {!! Form::date('tanggal_mulai_bekerja', null, ['class'=>'form-control','placeholder'=>'Tanggal Mulai Bekerja']) !!}
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Jenis Jabatan</label>
      {!! Form::select('level',['leader'=>'Leader','kelompok'=>'Kelompok'], null, ['class'=>'level form-control','onChange'=>'load_kelompok()']) !!}
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1" >Jabatan</label>
      {!! Form::select('level', $jabatan, null, ['class'=>'form-control']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="exampleInputEmail1">Alamat Lengkap</label>
      {!! Form::text('alamat_lengkap', null, ['class'=>'form-control','placeholder'=>'Alamat Lengkap']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="exampleInputEmail1">Upload Photo ( opsional )</label>
      {!! Form::file('photo', ['class'=>'form-control']) !!}
      @if(isset($user))
      <hr>
        <img src="{{asset('storage/'.$user->photo.'')}}" width="300">
      @endif
    </div>
  </div>
</div> --}}
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="/user" class="btn btn-primary">Kembali</a>


@push('scripts')
<script >
  $(document).ready(function () {
    load_kelompok();
  });

function load_kelompok() {
  var level = $(".level").val();
  var url = window.location.pathname;

  $.ajax({
    url: "/user/dropdown-jabatan",
    cache: false,
    data: {
      level: level
    },
    success: function (html) {
      $("#dropdown_jabatan").html(html);
      if (url != '/user/create') {
        $(".jabatan_id").val($("#jabatan_id_value").val()).change();
      }

    }
  });

  if (level == 'leader') {
    $("#label_jabatan").html("Pilih Leader");
  } else {
    $("#label_jabatan").html("Pilih Kelompok");
  }
} 
</script>
@endpush
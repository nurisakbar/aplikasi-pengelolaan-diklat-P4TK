<div class="row mb-3">
    <div class="col-md-6 mb-3">
      <div class="form-group">
        <label class="form-label">Nama Instansi</label>
        {!! Form::text('nama_instansi', null, ['class'=>'form-control','placeholder'=>'Nama Instansi']) !!}
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="form-group">
        <label class="form-label">Status</label>
        {!! Form::select('status', ['SWASTA' => 'SWASTA', 'NEGERI' => 'NEGERI'],null, ['class'=>'form-control']) !!}
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="form-group">
        <label class="form-label">Alamat</label>
        {!! Form::text('alamat', null, ['class'=>'form-control','placeholder'=>'Alamat']) !!}
      </div>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Kecamatan</label>
        <select name="district_id" id="district" class="district form-control" style="height: 100px;" placeholder="Masukan Nama Daerah">
          @if(isset($instansi))
            <option value="{{ $instansi->district_id }}">{{ $instansi->district->name }}</option>
          @endif
        </select>
    </div>
    <div class="col-md-6 mb-3">
      <div class="form-group">
        <label class="form-label">Telepon</label>
        {!! Form::number('telepon', null, ['class'=>'form-control','placeholder'=>'Telepon']) !!}
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="form-group">
        <label class="form-label">Email</label>
        {!! Form::email('email', null, ['class'=>'form-control','placeholder'=>'Email']) !!}
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="form-group">
        <label class="form-label">Website</label>
        {!! Form::text('website', null, ['class'=>'form-control','placeholder'=>'Website']) !!}
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="form-group">
        <label class="form-label">NPSN</label>
        {!! Form::number('npsn', null, ['class'=>'form-control','placeholder'=>'NPSN']) !!}
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="form-group">
        <label class="form-label">Nama Kepala Instansi</label>
        {!! Form::text('nama_kepala_instansi', null, ['class'=>'form-control','placeholder'=>'Nama Kepala Instansi']) !!}
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="form-group">
        <label class="form-label">Nomor Telepon Kepala Instansi</label>
        {!! Form::text('telpon_kepala_instansi', null, ['class'=>'form-control','placeholder'=>'Nomor Telpon Kepala Instansi']) !!}
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="form-group">
        <label class="form-label">Keterangan</label>
        {!! Form::text('keterangan', null, ['class'=>'form-control','placeholder'=>'Keterangan']) !!}
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="form-group">
        <label class="form-label">Catatan</label>
        {!! Form::text('catatan', null, ['class'=>'form-control','placeholder'=>'Catatan']) !!}
      </div>
    </div>
  </div>
<hr>
<div class="mb-10">
    <button type="submit" class="btn btn-danger">Simpan Instansi</button>
    <a href="/instansi" class="btn btn-danger">Kembali</a>
</div>


@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$( document ).ready(function() {

    $('.district').select2({
        placeholder: 'Masukan Nama Daerah',
        ajax: {
        url: '/ajax/select2Daerah',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
            results:  $.map(data, function (item) {
                return {
                text: item.name,
                id: item.id
                }
            })
            };
        },
        cache: true
        }
    });

});
</script>
@endpush

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

<div class="mb-10">
    <label class="form-label">Nama Diklat</label>
    {!! Form::text('nama_diklat', null, ['class'=>'form-control','placeholder'=>'Nama Diklat']) !!}
</div>

<div class="row">
    <div class="col-sm-2">
        <label class="form-label">Tahun Pelaksanaan</label>
        {!! Form::text('tahun', null, ['class'=>'form-control','placeholder'=>'Tahun']) !!}
    </div>
    <div class="col-sm-3">
        <label class="form-label">Departemen</label>
        {!! Form::select('departement',['Departemen A'=>'Departemen A','Departemen B'=>'Departemen B'], null, ['class'=>'form-control']) !!}
    </div>
    <div class="col-sm-2">
        <label class="form-label">Quota</label>
        {!! Form::text('quota', null, ['class'=>'form-control','placeholder'=>'Quota']) !!}
    </div>
    <div class="col-sm-3">
        <label class="form-label">Kompetensi Keahlian</label>
        {!! Form::text('kompetensi_keahlian', null, ['class'=>'form-control','placeholder'=>'Kompetensi']) !!}
    </div>
    <div class="col-sm-2">
        <label class="form-label">Status Aktif</label>
        {!! Form::select('status_aktif',['Aktif'=>'Aktif','Tidak Aktif'=>'Tidak Aktif'], null, ['class'=>'form-control']) !!}
    </div>
</div>
<hr>
<div class="mb-10">
    <label class="form-label">Nama Kelas</label>
    {!! Form::text('kelas[]', null, ['class'=>'form-control','placeholder'=>'Nama Kelas']) !!}
</div>
<hr>
<div class="mb-10">
    <button type="submit" class="btn btn-danger">Simpan Diklat</button>
    <a href="/diklat" class="btn btn-danger">Kembali</a>
</div>

<div class="mb-10">
    <label class="form-label">Nama Bidang Keahlian</label>
    {!! Form::text('nama_bidang_keahlian', null, ['class'=>'form-control','placeholder'=>'Nama Bidang Keahlian']) !!}
</div>
<div class="mb-10">
    <label class="form-label">Jenis Bidang Keahlian</label>
    {!! Form::select('jenis',['produktif'=>'Produktif','adaptif'=>'Adaptif'], null, ['class'=>'form-control']) !!}
</div>
<div class="mb-10">
    <button type="submit" class="btn btn-danger">Simpan Bidang Keahlian</button>
    <a href="/bidangkeahlian" class="btn btn-danger">Kembali</a>
</div>

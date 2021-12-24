<div class="mb-10">
    <label class="form-label">Nama Program Keahlian</label>
    {!! Form::text('nama_program_keahlian', null, ['class'=>'form-control','placeholder'=>'Nama Program Keahlian']) !!}
</div>
<div class="mb-10">
    <label class="form-label">Bidang Keahlian</label>
    {!! Form::select('bidang_keahlian_id',$bidangKeahlian, null, ['class'=>'form-control']) !!}
</div>
<div class="mb-10">
    <button type="submit" class="btn btn-danger">Simpan Program Keahlian</button>
    <a href="/programkeahlian" class="btn btn-danger">Kembali</a>
</div>

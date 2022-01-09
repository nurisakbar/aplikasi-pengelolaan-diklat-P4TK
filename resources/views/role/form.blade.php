<div class="row mb-3">
    <div class="col-md-12 mb-3">
        <div class="form-group">
            <label for="exampleInputEmail1">Nama Role</label>
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Masukan Nama Role']) !!}
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="/role" class="btn btn-primary">Kembali</a>

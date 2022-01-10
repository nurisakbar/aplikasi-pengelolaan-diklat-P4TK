<div class="row mb-3">
    <div class="col-md-12 mb-3">
        <div class="form-group">
            <label for="exampleInputEmail1">Nama Permission</label>
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Masukan Nama Permission']) !!}
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="/permission" class="btn btn-primary">Kembali</a>

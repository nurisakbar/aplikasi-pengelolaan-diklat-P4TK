<div class="mb-6">
    <label class="form-label">Nama Diklat</label>
    {!! Form::text('nama_diklat', null, ['class'=>'form-control','placeholder'=>'Nama Diklat']) !!}
</div>

<div class="mb-6">
    <label class="form-label">Kategori Diklat</label>
    {!! Form::select('kategori_diklat_id',$kategori, null, ['class'=>'form-control','placeholder'=>'Pilih Kategori']) !!}
</div>


<div class="mb-6">
    <label class="form-label">Tanggal Mulai</label>
    {!! Form::date('tanggal_mulai', null, ['class'=>'form-control','placeholder'=>'Tanggal Mulai']) !!}
</div>

<div class="mb-6">
    <label class="form-label">Tanggal Selesai</label>
    {!! Form::date('tanggal_selesai',null, ['class'=>'form-control','placeholder'=>'Tanggal Selesai']) !!}
</div>



<div class="row">
    <div class="col-sm-2">
        <label class="form-label">Tahun Pelaksanaan</label>
        {!! Form::text('tahun', null, ['class'=>'form-control','placeholder'=>'Tahun']) !!}
    </div>
    <div class="col-sm-2">
        <label class="form-label">Departemen</label>
        {!! Form::select('departemen_id', $departemen, null, ['class'=>'form-control']) !!}
    </div>
    <div class="col-sm-1">
        <label class="form-label">Quota</label>
        {!! Form::text('quota', null, ['class'=>'form-control','placeholder'=>'Quota']) !!}
    </div>
    <div class="col-sm-3">
        <label class="form-label">Bidang Keahlian</label>
        {!! Form::select('bidang_keahlian',$bidangKeahlian, null, ['class'=>'form-control bidang_keahlian_id','onChange'=>'load_program_keahlian()']) !!}
    </div>
    <div class="col-sm-3">
        <label class="form-label">Program Keahlian</label>
        <div id="program_keahlian"></div>
    </div>
    <div class="col-sm-1">
        <label class="form-label">Status Aktif</label>
        {!! Form::select('status_aktif',['Aktif'=>'Aktif','Tidak Aktif'=>'Tidak'], null, ['class'=>'form-control']) !!}
    </div>
</div>

@if(isset($diklat))

@else
<hr>
<div class="mb-10">
    <label class="form-label">Nama Kelas</label>
    {!! Form::text('kelas[]', null, ['class'=>'form-control','placeholder'=>'Nama Kelas']) !!}
</div>
@endif
<hr>
<div class="mb-10">
    <button type="submit" class="btn btn-danger">Simpan Diklat</button>
    <a href="/diklat" class="btn btn-danger">Kembali</a>
</div>


@push('scripts')
<script>
    $(function() {
        load_program_keahlian();
    });

    function load_program_keahlian(){
        var bidang_keahlian_id = $(".bidang_keahlian_id").val();
        
        $.ajax({
        url: "/ajax/programkeahlian-dropdown",
        data:{bidang_keahlian_id: bidang_keahlian_id},
        success: function(response){
            $("#program_keahlian").html(response);
        }
        });
    }
</script>
@if(isset($diklat))
<script>
    console.log('ok');
</script>
@endif
@endpush

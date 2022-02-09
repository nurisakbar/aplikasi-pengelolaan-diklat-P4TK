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
    <div class="col-sm-7">
        <label class="form-label">Departemen</label>
        {!! Form::select('departemen_id', $departemen, null, ['class'=>'form-control']) !!}
    </div>
    <div class="col-sm-1">
        <label class="form-label">Quota</label>
        {!! Form::text('quota', null, ['class'=>'form-control','placeholder'=>'Quota']) !!}
    </div>

    <div class="col-sm-2">
        <label class="form-label">Status Aktif</label>
        {!! Form::select('status_aktif',['Aktif'=>'Aktif','Tidak Aktif'=>'Tidak'], null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="row" style="margin-top:10px">
    <div class="col-sm-2">
        <label class="form-label">Berdasarkan Spektrum</label>
        {!! Form::select('jenis',['ya'=>'Ya','tidak'=>'Tidak'], null, ['class'=>'form-control jenis','onChange'=>'status_berdasarkan_spektrum()']) !!}
    </div>
    <div class="col-sm-2 jenis_bidang_keahlian_div">
        <label class="form-label">Jenis Bidang Keahlian</label>
        {!! Form::select('',['produktif'=>'Produktif','adaptif'=>'Adaptif'], null, ['class'=>'form-control jenis_bidang_keahlian','onChange'=>'load_bidang_keahlian()']) !!}
    </div>
    <div class="col-sm-3 bidang_keahlian_div">
        <label class="form-label">Bidang Keahlian</label>
        {{-- {!! Form::select('bidang_keahlian',$bidangKeahlian, null, ['class'=>'form-control bidang_keahlian_id','onChange'=>'load_program_keahlian()']) !!} --}}
        <div id="bidang_keahlian"></div>
    </div>
    <div class="col-sm-3 program_keahlian_div">
        <label class="form-label">Program Keahlian</label>
        <div id="program_keahlian"></div>
    </div>
    <div class="col-sm-2">
        <label class="form-label">Pola Diklat</label>
        {!! Form::text('pola_diklat', null, ['class'=>'form-control','placeholder'=>'Pola Diklat']) !!}
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
        status_berdasarkan_spektrum();
        
    });

    function status_berdasarkan_spektrum(){
        var jenis = $(".jenis").val();
        console.log(jenis);
        if(jenis=='tidak'){
            $(".bidang_keahlian_div").hide();
            $(".program_keahlian_div").hide();
            $(".jenis_bidang_keahlian_div").hide();
        }else{
            $(".bidang_keahlian_div").show();
            $(".program_keahlian_div").show();
            $(".jenis_bidang_keahlian_div").show();
            load_bidang_keahlian();
        }
        
    }

    function load_bidang_keahlian(){
        var jenis_bidang_keahlian = $(".jenis_bidang_keahlian").val();
        $.ajax({
        url: "/ajax/bidangkeakhlian-dropdown",
        data:{jenis_bidang_keahlian: jenis_bidang_keahlian},
        success: function(response){
            console.log(response);
            $("#bidang_keahlian").html(response);
            if(jenis_bidang_keahlian=='produktif')
            {
                load_program_keahlian();
                $(".program_keahlian_div").show();
            }else{
                $(".program_keahlian_div").hide();
            }
            
        }
        });
    }

    function load_program_keahlian(){
        var bidang_keahlian_id = $(".bidang_keahlian_id").val();
        console.log(bidang_keahlian_id);
        $.ajax({
        url: "/ajax/programkeahlian-dropdown",
        
        data:{bidang_keahlian_id: bidang_keahlian_id},
        success: function(response){
            console.log(response);
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

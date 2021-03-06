<div class="mb-6">
    <label class="form-label">Nama Diklat</label>
    {!! Form::text('nama_diklat', null, ['class'=>'form-control','placeholder'=>'Nama Diklat','required'=>'required']) !!}
</div>

<div class="mb-6">
    <label class="form-label">Kategori Diklat</label>
    {!! Form::select('kategori_diklat_id',$kategori, null, ['class'=>'form-control','placeholder'=>'Pilih Kategori']) !!}
</div>




<div class="row" style="margin-top:10px;margin-bottom:10px">
    <div class="col-sm-3">
        <label class="form-label">Tanggal Mulai</label>
        {!! Form::date('tanggal_mulai', null, ['class'=>'form-control','placeholder'=>'Tanggal Mulai','required'=>'required']) !!}
    </div>
    
    <div class="col-sm-3">
        <label class="form-label">Tanggal Selesai</label>
        {!! Form::date('tanggal_selesai',null, ['class'=>'form-control','placeholder'=>'Tanggal Selesai','required'=>'required']) !!}
    </div>
    
    <div class="col-sm-6">
        <label class="form-label">Tempat Pelaksanaan</label>
        {!! Form::text('tempat',null, ['class'=>'form-control','placeholder'=>'Lokasi','required'=>'required']) !!}
    </div>
</div>



<div class="row">
    <div class="col-sm-2">
        <label class="form-label">Tahun Pelaksanaan</label>
        {!! Form::text('tahun', null, ['class'=>'form-control','placeholder'=>'Tahun','required'=>'required']) !!}
    </div>
    <div class="col-sm-7">
        <label class="form-label">Departemen</label>
        {!! Form::select('departemen_id', $departemen, null, ['class'=>'form-control']) !!}
    </div>
    <div class="col-sm-1">
        <label class="form-label">Quota</label>
        {!! Form::text('quota', null, ['class'=>'form-control','placeholder'=>'Quota','required'=>'required']) !!}
    </div>

    <div class="col-sm-2">
        <label class="form-label">Status Aktif</label>
        {!! Form::select('status_aktif',['Aktif'=>'Aktif','Tidak Aktif'=>'Tidak'], null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="row" style="margin-top:10px">
    {{-- <div class="col-sm-2">
        <label class="form-label">Berdasarkan Spektrum</label>
        {!! Form::select('jenis',['ya'=>'Ya','tidak'=>'Tidak'], null, ['class'=>'form-control jenis','onChange'=>'status_berdasarkan_spektrum()']) !!}
    </div>
    <div class="col-sm-2 jenis_bidang_keahlian_div">
        <label class="form-label">Jenis Bidang Keahlian</label>
        {!! Form::select('',['produktif'=>'Produktif','adaptif'=>'Adaptif'], null, ['class'=>'form-control jenis_bidang_keahlian','onChange'=>'load_bidang_keahlian()']) !!}
    </div> --}}

    <input type="hidden" class="jenis" value="ya">
    <input type="hidden" class="jenis_bidang_keahlian" value="produktif">
    <div class="col-sm-3 bidang_keahlian_div">
        <label class="form-label">Bidang Keahlian</label>
        {{-- {!! Form::select('bidang_keahlian',$bidangKeahlian, null, ['class'=>'form-control bidang_keahlian_id','onChange'=>'load_program_keahlian()']) !!} --}}
        <div id="bidang_keahlian"></div>
    </div>
    <div class="col-sm-3 program_keahlian_div">
        <label class="form-label">Program Keahlian</label>
        <div id="program_keahlian"></div>
    </div>
    <div class="col-sm-3 program_keahlian_div">
        <label class="form-label">Kompetensi Keahlian</label>
        <div id="kompetensi_keahlian"></div>
    </div>
    <div class="col-sm-2">
        <label class="form-label">Pola Diklat</label>
        {!! Form::text('pola_diklat', null, ['class'=>'form-control','placeholder'=>'Pola Diklat']) !!}
    </div>
</div>
<div class="mb-12">
    <label class="form-label">Deskripsi</label>
    {!! Form::textarea('description', null, ['class'=>'form-control','placeholder'=>'Deskripsi']) !!}
</div>

<div class="mb-12">
    <label class="form-label">Gambar Poster</label>
    {!! Form::file('image', null, ['class'=>'form-control']) !!}
</div>

{{-- @if(isset($diklat))

@else
<hr>
<div class="mb-10">
    <label class="form-label">Nama Kelas</label>
    {!! Form::text('kelas[]', null, ['class'=>'form-control','placeholder'=>'Nama Kelas','required'=>'required']) !!}
</div>
@endif --}}
<hr>
<div class="mb-10">
    <button type="submit" class="btn btn-danger">Simpan Diklat</button>
    <a href="/diklat" class="btn btn-danger">Kembali</a>
</div>


@push('scripts')
<script src="https://cdn.ckeditor.com/4.16.2/standard-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', {
      extraPlugins: 'embed,autoembed,image2,justify',
      height: 200,
      // Load the default contents.css file plus customizations for this sample.
      contentsCss: [
        'http://cdn.ckeditor.com/4.16.2/full-all/contents.css',
        'https://ckeditor.com/docs/ckeditor4/4.16.2/examples/assets/css/widgetstyles.css'
      ],
      // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
      embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
      // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
      // resizer (because image size is controlled by widget styles or the image takes maximum
      // 100% of the editor width).
      image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
      image2_disableResizer: true,
      removeButtons: 'PasteFromWord'
    });
  </script>
<script>
    $(function() {
        status_berdasarkan_spektrum();
        
    });

    function status_berdasarkan_spektrum(){
        var jenis = $(".jenis").val();
        //console.log(jenis);
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
            //console.log(response);
            $("#bidang_keahlian").html(response);
            if(jenis_bidang_keahlian=='produktif')
            {
                @if(isset($diklat))
                    $(".bidang_keahlian_id").val({{$diklat->bidang_keahlian_id}}).trigger('change');
                @endif
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
        //console.log(bidang_keahlian_id);
        $.ajax({
        url: "/ajax/programkeahlian-dropdown",
        
        data:{bidang_keahlian_id: bidang_keahlian_id},
        success: function(response){
            //console.log(response);
            $("#program_keahlian").html(response);
            load_kompetensi_keahlian()
            @if(isset($diklat))
                    $(".program_keahlian_id").val({{$diklat->program_keahlian_id}}).trigger('change');
            @endif
        }
        });
    }

    function load_kompetensi_keahlian(){
        var program_keahlian_id = $(".program_keahlian_id").val();
        console.log(program_keahlian_id);
        $.ajax({
        url: "/ajax/kompetensikeakhlian-dropdown",
        
        data:{program_keahlian_id: program_keahlian_id},
        success: function(response){
            //console.log(response);
            $("#kompetensi_keahlian").html(response);
            @if(isset($diklat))
                    $(".kompetensi_keahlian_id").val({{$diklat->kompetensi_keahlian_id}}).trigger('change');
            @endif
        }
        });
    }
</script>
@endpush

<div class="mb-10">
    <label class="form-label">Bidang Keahlian</label>
    {!! Form::select('bidang_keahlian_id',$bidangKeahlian, null, ['class'=>'form-control bidang_keahlian_id','onChange'=>'load_program_keahlian()']) !!}
</div>
<div class="mb-10">
    <label class="form-label">Program Keahlian</label>
    <div id="program_keahlian"></div>
</div>
<div class="mb-10">
    <label class="form-label">Nama Kompetensi Keahlian</label>
    {!! Form::text('nama_kompetensi_keahlian', null, ['class'=>'form-control','placeholder'=>'Nama Kompetensi Keahlian']) !!}
</div>

<div class="mb-10">
    <button type="submit" class="btn btn-danger">Simpan Kompetensi Keahlian</button>
    <a href="/kompetensikeahlian" class="btn btn-danger">Kembali</a>
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

@if(isset($kompetensiKeahlian))
<script>
    var bidang_keahlian_id = "{{$kompetensiKeahlian->programKeahlian->bidangKeahlian->id}}";
    var program_keahlian_id = "{{$kompetensiKeahlian->program_keahlian_id}}";
    console.log(program_keahlian_id);
    $(".bidang_keahlian_id").val(bidang_keahlian_id);
    load_program_keahlian();
    $(".program_keahlian_id").val(program_keahlian_id);
</script>
@endif
@endpush

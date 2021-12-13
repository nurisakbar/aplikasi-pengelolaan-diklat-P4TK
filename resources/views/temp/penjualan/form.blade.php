<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Dari Toko</label>
      {!! Form::select('toko_id',$toko, null, ['class'=>'form-control spesial']) !!}
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Nomor Pesanan</label>
      {!! Form::text('nomor_pesanan', null, ['class'=>'form-control spesial','placeholder'=>'Nomor Pesanan']) !!}
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="exampleInputEmail1">Tanggal</label>
      {!! Form::date('tanggal', null, ['class'=>'form-control spesial','placeholder'=>'Tanggal']) !!}
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="exampleInputEmail1">Ongkir</label>
      {!! Form::text('ongkir_customer', null, ['class'=>'form-control spesial','placeholder'=>'Ongkir']) !!}
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="exampleInputEmail1">Nomor Resi Asli</label>
      {!! Form::text('nomor_resi_asli', null, ['class'=>'form-control','placeholder'=>'Nomor Resi Asli']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Pembeli</label>
      {!! Form::text('nama_pembeli', null, ['class'=>'form-control spesial','placeholder'=>'Nama Pembeli']) !!}
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Nomor HP</label>
      {!! Form::text('nomor_hp', null, ['class'=>'form-control spesial','placeholder'=>'Nomor HP']) !!}
    </div>
  </div>
  <div class="col-md-2 column-status">
    <div class="form-group">
      <label for="exampleInputEmail1">Status</label>
      {!! Form::select('status',$status, null, ['class'=>'form-control status','onChange'=>'chekStatus()']) !!}
    </div>
  </div>
  {{-- <span id="tambahan"></span> --}}
  <div class="col-md-2">
    <div class="form-group">
      <label for="exampleInputEmail1">Uang Masuk</label>
      {!! Form::text('uang_masuk', null, ['class'=>'form-control spesial','placeholder'=>'Uang Masuk']) !!}
    </div>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Supplier Dari</label>
      {!! Form::select('supplier',['Shopee'=>'Shopee','Jakmall'=>'Jackmall','Tokopedia'=>'Tokopedia','Lainya'=>'Lainya'], null, ['class'=>'form-control spesial']) !!}
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Akun Belanja</label>
      {!! Form::text('akun_belanja', null, ['class'=>'form-control spesial','placeholder'=>'Akun Belanja']) !!}
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="exampleInputEmail1">Pesanan Supplier</label>
      {!! Form::text('nomor_pesanan_beli_ke_supplier', null, ['class'=>'form-control spesial','placeholder'=>'Nomor Pesanan']) !!}
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="exampleInputEmail1">Ongkir</label>
      {!! Form::text('ongkir_supplier', null, ['class'=>'form-control spesial','placeholder'=>'Ongkir']) !!}
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="exampleInputEmail1">Resi Sementara</label>
      {!! Form::text('nomor_resi_sementara', null, ['class'=>'form-control','placeholder'=>'Resi Sementara']) !!}
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Uang Belanja Ke Supplier</label>
      {!! Form::text('uang_belanja_ke_supplier', null, ['class'=>'form-control spesial','placeholder'=>'Belanja Supplier']) !!}
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Dana Cair</label>
      {!! Form::text('dana_cair', null, ['class'=>'form-control','placeholder'=>'Dana Cair']) !!}
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="exampleInputEmail1">Status WA</label>
      {!! Form::select('status_wa',$statusWa, null, ['class'=>'form-control']) !!}
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="exampleInputEmail1">Catatan</label>
      {!! Form::text('catatan', null, ['class'=>'form-control','placeholder'=>'Catatan']) !!}
    </div>
  </div>
{{-- 
  @if(isset($penjualan))
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Profit</label>
        {!! Form::text('profit', null, ['class'=>'form-control','placeholder'=>'Profit']) !!}
      </div>
    </div>
  @endif --}}

</div>

  <button type="submit" class="btn btn-primary">Simpan</button>
  <a href="/penjualan" class="btn btn-primary">Kembali</a>


  

@push('scripts')
@if(isset($penjualan))
  <script>
    $( document ).ready(function() {
      chekStatus();
  });

    function chekStatus(){
      var status = $('.status').val();
      if(status =='Refund'){
        var FormRefund = "<div class='col-md-2 tambahan'><div class='form-group'><label for='exampleInputEmail1'>Total Refund</label><input type='text' name='total_refund' value='{{$penjualan->total_refund}}' class='form-control total_refund' placeholder='Total Refund'></div></div>";
        console.log('refund');
      }else if(status =='Piutang'){
        var FormRefund = "<div class='col-md-2 tambahan'><div class='form-group'><label for='exampleInputEmail1'>Total Piutang</label><input type='text' name='total_piutang' value='{{$penjualan->total_piutang}}' class='form-control total_piutang' placeholder='Total Piutang'></div></div>";
        console.log('piutang');
      }else if(status =='Rugi'){
        var FormRefund = "<div class='col-md-2 tambahan'><div class='form-group'><label for='exampleInputEmail1'>Total Rugi</label><input type='text' value='{{$penjualan->total_rugi}}' name='total_rugi' class='form-control total_rugi' placeholder='Total Rugi'></div></div>";
        console.log('rugi');
      }else{
        $(".tambahan").remove();
      }
      $(".tambahan").remove();
      $(FormRefund).insertAfter('.column-status');
    }
  </script>

  @if(Auth::user()->level !='administrator')
  {
    <script type="text/javascript">
    $( document ).ready(function() {
      $(".total_piutang").prop("disabled", true); 
      $(".total_refund").prop("disabled", true); 
      $(".total_rugi").prop("disabled", true); 
  });
    
    </script>
  @endif
  }
@endif
@endpush
@extends('layouts.app')
@section('title','Edit Penjualan')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Penjualan</h6>
    </div>
    <div class="card-body">
        @include('validation_error')
        @include('alert')
        {!! Form::model($penjualan,['url'=>'penjualan/'.$penjualan->id,'method'=>'PUT']) !!}
        @include('penjualan.form')
        {!! Form::close() !!}
    </div>
</div>
@endsection
@push('scripts')
@if(Auth::user()->level!='administrator')
    <script>
    $( document ).ready(function() {
        $(".spesial").prop("disabled", true); 
    });
    </script>
@endif
@endpush

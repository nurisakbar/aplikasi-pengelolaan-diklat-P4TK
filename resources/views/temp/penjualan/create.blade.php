@extends('layouts.app')
@section('title','Input Penjualan')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Input Penjualan</h6>
    </div>
    <div class="card-body">
        @include('validation_error')
        {!! Form::open(['url'=>'penjualan']) !!}
        @include('penjualan.form')
        {!! Form::close() !!}
    </div>
</div>
@endsection



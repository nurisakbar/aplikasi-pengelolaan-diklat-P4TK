@extends('layouts.app')
@section('title','Input Laporan Tarik Dana')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Input Laporan Tarik Dana</h6>
    </div>
    <div class="card-body">
        @include('validation_error')
        {!! Form::open(['url'=>'tarikdana','files'=>true]) !!}
        @include('tarikdana.form')
        {!! Form::close() !!}
    </div>
</div>
@endsection



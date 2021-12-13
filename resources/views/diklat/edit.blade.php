@extends('layouts.app')
@section('title','Edit Diklat')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Diklat</h6>
    </div>
    <div class="card-body">
        @include('validation_error')
        {!! Form::model($diklat,['url'=>'diklat/'.$diklat->id,'method'=>'PUT']) !!}
        @include('diklat.form')
        {!! Form::close() !!}
    </div>
</div>
@endsection

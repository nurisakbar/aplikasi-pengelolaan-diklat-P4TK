@extends('layouts.app')
@section('title','Edit Laporan Tarik Dana')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Laporan Tarik Dana</h6>
    </div>
    <div class="card-body">
        @include('validation_error')
        {!! Form::model($tarikdana,['url'=>'tarikdana/'.$tarikdana->id,'method'=>'PUT']) !!}
        @include('tarikdana.form')
        {!! Form::close() !!}
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title','Tambah Panduan Kerja')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Panduan Kerja</h6>
    </div>
    <div class="card-body">
        @include('validation_error')
        {!! Form::open(['url'=>'video','files'=>true]) !!}
        @include('video.form')
        {!! Form::close() !!}
    </div>
</div>
@endsection



@extends('layouts.app')
@section('title','Edit Jabatan')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Jabatan</h6>
    </div>
    <div class="card-body">
        @include('validation_error')
        {!! Form::model($jabatan,['url'=>'jabatan/'.$jabatan->id,'method'=>'PUT']) !!}
        @include('jabatan.form')
        {!! Form::close() !!}
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title','Tambah Data Pegawai')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Pegawai</h6>
    </div>
    <div class="card-body">
        @include('validation_error')
            {!! Form::open(['url'=>'user','files'=>true]) !!}
            @include('user.form')
            {!! Form::close() !!}
    </div>
</div>
@endsection





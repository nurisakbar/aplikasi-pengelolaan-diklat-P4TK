@extends('layouts.app')
@section('title','Kelola Video Tutorial')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> {{ $video->title}}</h6>
    </div>
    <div class="card-body">
        {!! $video->description !!}
    </div>
</div>
@endsection



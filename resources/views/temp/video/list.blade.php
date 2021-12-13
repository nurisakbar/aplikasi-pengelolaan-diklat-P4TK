@extends('layouts.app')
@section('title','Video Tutorial')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Video Tutorial</h6>
    </div>
    <div class="card-body">
        <div class="row">
        @foreach ($videos as $video)
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('wfn-info.png')}}" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">{{ $video->title }}</h5>
                      <span style="height: 870px;">
                      <p  class="card-text">{!! substr($video->description,0,100) !!}</p>
                      </span>
                      <a href="/video/{{ $video->id }}" class="btn btn-primary">Lihat Video</a>
                    </div>
                  </div>
            </div>
        @endforeach
    </div>
    </div>
</div>
@endsection
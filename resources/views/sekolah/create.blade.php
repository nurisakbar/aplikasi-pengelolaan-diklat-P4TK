@extends('layouts.app')
@section('title','Data Diklat')
@section('content')
<div class="toolbar py-5 py-lg-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
       <div class="page-title d-flex flex-column me-3">
          <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Users List</h1>
          <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
             <li class="breadcrumb-item text-gray-600">
                <a href="https://preview.keenthemes.com/metronic8/demo11/../demo11/index.html"
                   class="text-gray-600 text-hover-primary">Home</a>
             </li>
             <li class="breadcrumb-item text-gray-600">Apps</li>
             <li class="breadcrumb-item text-gray-600">User Management</li>
          </ul>
       </div>
    </div>
 </div>

<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <div class="content flex-row-fluid" id="kt_content">
        <div class="card">
            <div class="card-body py-4">
                @include('validation_error')
                {!! Form::open(['url'=>'diklat','files'=>true]) !!}
                @include('diklat.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

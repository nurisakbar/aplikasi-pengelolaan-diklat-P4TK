@extends('layouts.app')
@section('title', 'Data Detail Role')
@section('content')
    <div class="toolbar py-5 py-lg-5" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Role : {{ $role->name }}</h1>
                <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                    <li class="breadcrumb-item text-gray-600">
                        <a href="https://preview.keenthemes.com/metronic8/demo11/../demo11/index.html"
                            class="text-gray-600 text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-gray-600">Role</li>
                    <li class="breadcrumb-item text-gray-600">Detail</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">

            @include('alert')

            <hr>
            <h3>Daftar Permission</h3>
            <hr>

            {!! Form::open(['url' => 'addPermission', 'method' => 'POST']) !!}

            <div class="row">
                <div class="col-md-6">
                    <div class="form-check my-4">
                        <input class="form-check-input" type="checkbox" name="tambah_guru" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Tambah Guru
                        </label>
                    </div>
                    <div class="form-check my-4">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Default checkbox
                        </label>
                    </div>
                    <div class="form-check my-4">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Default checkbox
                        </label>
                    </div>
                    <div class="form-check my-4">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Default checkbox
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Simpan perubahan</button>
            </div>
            {!! Form::close() !!}

        </div>

    </div>
@endsection

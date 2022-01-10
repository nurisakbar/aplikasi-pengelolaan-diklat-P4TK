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
            <h3>Daftar Permission </h3>
            <hr>

            <div class="row">
                <div class="col-md-6">
                    @foreach ($permissions as $permission)
                        <div class="form-check my-4">
                            <input data-role="{{ $role->id }}" data-permission="{{ $permission->name }}"
                                class="form-check-input" type="checkbox" {{ check_access($role->id, $permission->name) }}>
                            <label class="form-check-label" for="defaultCheck1">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                    <input type="hidden" value="{{ csrf_token() }}" id="csrf-token">
                </div>
            </div>
            <a href="{{ url('role?notif=success')}}" class="btn btn-primary">Simpan Perubahan</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('.form-check-input').click(function() {
            const CSRF_TOKEN = $('#csrf-token').val()
            const role_id = $(this).data('role')
            const permission = $(this).data('permission')

            $.ajax({
                type: 'POST',
                url: '/changePermission',
                data: {
                    _token: CSRF_TOKEN,
                    role_id,
                    permission
                },
                success: function(data) {
                    console.log(data)
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endpush

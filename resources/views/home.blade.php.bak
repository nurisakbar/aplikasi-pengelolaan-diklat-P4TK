@extends('layouts.app')
@section('title','Halaman Utama')
@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">

    
    <!--begin::Post-->
    <div class="content flex-row-fluid" id="kt_content" style="margin-top:40px;">
        <div class="col-md-12">
            @include('alert')
        </div>
        <!--begin::Toolbar-->
        <div class="d-flex flex-wrap flex-stack mb-6">
            <!--begin::Heading-->
            <h3 class="fw-bolder my-2">DAFTAR DIKLAT YANG AKAN BERJALAN</h3>
            <!--end::Heading-->
  
        </div>
        <!--end::Toolbar-->
        <!--begin::Row-->
        <div class="row g-6 g-xl-9">
            <!--begin::Col-->
            @foreach ($diklat as $d)
            <div class="col-md-6 col-xl-4">
                <!--begin::Card-->
                <a href="/diklat/detail/{{ $d->id}}" class="card border-hover-primary">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-9">
                        <!--begin::Card Title-->
                        <div class="card-title m-0">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px w-50px bg-light">
                                <img src="{{asset('LOGO-BAru-2020.png')}}" alt="image" class="p-3">
                            </div>
                            <!--end::Avatar-->
                        </div>
                        <!--end::Car Title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">{{ $d->status_aktif }}</span>
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end:: Card header-->
                    <!--begin:: Card body-->
                    <div class="card-body p-9">
                        <img src="{{ $d->image!=null?asset('image/'.$d->image):'https://www.bimteknasional.id/wp-content/uploads/2019/12/d-1024x683.jpg'}}" style="width: 350px;
                        height: 200px;
                        object-fit: cover;">
                        <hr>
                        <!--begin::Name-->
                        <div class="fs-3 fw-bolder text-dark">{{ $d->nama_diklat }}</div>
                        <!--end::Name-->
                        <!--begin::Description-->
                        <p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">{{ $d->kategori->nama_kategori }}</p>
                        <!--end::Description-->
                        <!--begin::Info-->
                        <div class="d-flex flex-wrap mb-5">
                            <!--begin::Due-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                                <div class="fs-6 text-gray-800 fw-bolder">{{ date('d F Y', strtotime($d->tanggal_mulai)) }}</div>
                                <div class="fw-bold text-gray-400">Tanggal Mulai</div>
                            </div>

                            <!--end::Due-->
                            <!--begin::Budget-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                <div class="fs-6 text-gray-800 fw-bolder">{{ date('d F Y', strtotime($d->tanggal_selesai)) }}</div>
                                <div class="fw-bold text-gray-400">Tanggal Selesai</div>
                            </div>
                            <!--end::Budget-->
                        </div>
                        <!--end::Info-->
                        {{-- <!--begin::Progress-->
                        <div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="" data-bs-original-title="This project 50% completed">
                            <div class="bg-primary rounded h-4px" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <!--end::Progress--> --}}
                    </div>
                    <!--end:: Card body-->
                </a>
                <!--end::Card-->
            </div>
            <!--end::Col-->
            @endforeach

        </div>
        <!--end::Row-->
        <!--begin::Pagination-->
        <div class="d-flex flex-stack flex-wrap pt-10">
            {{ $diklat->links()}}
        </div>
        <!--end::Pagination-->
        <!--begin::Modals-->
   
@endsection
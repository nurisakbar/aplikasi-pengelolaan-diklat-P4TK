@extends('layouts.app')
@section('title',$diklat->nama_diklat)
@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <!--begin::Post-->
    <div class="content flex-row-fluid" id="kt_content">
        <!--begin::Post card-->
        <div class="card">
            <!--begin::Body-->
            <div class="card-body p-lg-20 pb-lg-0">
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-xl-row">
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid me-xl-15">
                        <!--begin::Post content-->
                        <div class="mb-17">
                            <!--begin::Wrapper-->
                            <div class="mb-8">
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap mb-6">
                                    <!--begin::Item-->
                                    <div class="me-9 my-1">
                                        <!--begin::Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                        <span class="svg-icon svg-icon-primary svg-icon-2 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black"></rect>
                                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black"></rect>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--end::Icon-->
                                        <!--begin::Label-->
                                        <span class="fw-bolder text-gray-400">{{ date('d F Y', strtotime($diklat->tanggal_mulai)) }} - {{ date('d F Y', strtotime($diklat->tanggal_selesai)) }}</span>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    {{-- <div class="me-9 my-1">
                                        <!--begin::Icon-->
                                        <!--SVG file not found: icons/duotune/finance/fin006.svgFolder.svg-->
                                        <!--end::Icon-->
                                        <!--begin::Label-->
                                        <span class="fw-bolder text-gray-400">Announcements</span>
                                        <!--begin::Label-->
                                    </div> --}}
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="my-1">
                                        <!--begin::Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/communication/com003.svg-->
                                        <span class="svg-icon svg-icon-primary svg-icon-2 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="black"></path>
                                                <path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--end::Icon-->
                                        <!--begin::Label-->
                                        <span class="fw-bolder text-gray-400">24 Comments</span>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Title-->
                                <a href="#" class="text-dark text-hover-primary fs-2 fw-bolder">{{ $diklat->nama_diklat}} 
                                <span class="fw-bolder text-muted fs-5 ps-1">5 mins read</span></a>
                                <!--end::Title-->
                                <!--begin::Container-->
                                <div class="overlay mt-8">
                                    <!--begin::Image-->
                                    <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-350px" style="background-image:url('{{ asset('image/'.$diklat->image)}}')"></div>
                                    <!--end::Image-->
                                    <!--begin::Links-->
                                    {{-- <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                        <a href="/metronic8/demo11/../demo11/pages/about.html" class="btn btn-primary">Tanya Admin</a>
                                        <a href="/metronic8/demo11/../demo11/pages/careers/apply.html" class="btn btn-light-primary ms-3">Join Us</a>
                                    </div> --}}
                                    <!--end::Links-->
                                </div>
                                <!--end::Container-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Description-->
                            <div class="fs-5 fw-bold text-gray-600">
                                {!! $diklat->description !!}

                                <hr>
                                <h3>Detail Informasi Diklat</h3>
                                <table class="table table-bordered">
                                    <tr>
                                        <td width="200">Judul Diklat</td>
                                        <td> : {{$diklat->nama_diklat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Pelaksanaan</td>
                                        <td> : {{$diklat->tanggal_mulai }} Sampai {{ $diklat->tanggal_selesai }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pola Diklat</td>
                                        <td> : {{$diklat->pola_diklat }} Jam</td>
                                    </tr>
                                </table>
                                <hr>
                                @if (Auth::guard('gtk')->check())
                                    <a href="http://" class="btn btn-primary" onClick="konfirmasi_pendaftaran()" style="margin-bottom:20px;">Mendaftar Sebagai Peserta</a>
                                @else
                                <div class="alert alert-primary">
                                    <span class="svg-icon svg-icon-2hx svg-icon-primary me-3">...</span>
                                    <div class="d-flex flex-column">
                                        <h4 class="mb-1 text-dark">Informasi</h4>
                                        <span>Silahkan Melakukan Login Untuk Mendaftar Pada Diklat Ini.</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!--end::Description-->
                            <!--begin::Block-->
                            <div class="d-flex align-items-center border-1 border-dashed card-rounded p-5 p-lg-10 mb-14">
                                <!--begin::Section-->
                                <div class="text-center flex-shrink-0 me-7 me-lg-13">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-70px symbol-circle mb-2">
                                        <img src="{{ asset('assets/media/avatars/150-2.jpg')}}" class="" alt="">
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Info-->
                                    <div class="mb-0">
                                        <a href="/metronic8/demo11/../demo11/pages/user-profile/overview.html" class="text-gray-700 fw-bolder text-hover-primary">Jane Johnson</a>
                                        <span class="text-gray-400 fs-7 fw-bold d-block mt-1">PIC Diklat</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Text-->
                                <div class="mb-0 fs-6">
                                    <div class="text-muted fw-bold lh-lg mb-2">First, a disclaimer – the entire process of writing a blog post often takes more than a couple of hours, even if you can type eighty words per minute and your writing skills are sharp writing a blog post often takes more than a couple.</div>
                                </div>
                                
                                <!--end::Text-->
                            </div>
                            <!--end::Block-->
                            <!--begin::Icons-->
                            <div class="d-flex flex-center">
                                <!--begin::Icon-->
                                <a href="#" class="mx-4">
                                    <img src="/metronic8/demo11/assets/media/svg/brand-logos/facebook-4.svg" class="h-20px my-2" alt="">
                                </a>
                                <!--end::Icon-->
                                <!--begin::Icon-->
                                <a href="#" class="mx-4">
                                    <img src="/metronic8/demo11/assets/media/svg/brand-logos/instagram-2-1.svg" class="h-20px my-2" alt="">
                                </a>
                                <!--end::Icon-->
                                <!--begin::Icon-->
                                <a href="#" class="mx-4">
                                    <img src="/metronic8/demo11/assets/media/svg/brand-logos/github.svg" class="h-20px my-2" alt="">
                                </a>
                                <!--end::Icon-->
                                <!--begin::Icon-->
                                <a href="#" class="mx-4">
                                    <img src="/metronic8/demo11/assets/media/svg/brand-logos/behance.svg" class="h-20px my-2" alt="">
                                </a>
                                <!--end::Icon-->
                                <!--begin::Icon-->
                                <a href="#" class="mx-4">
                                    <img src="/metronic8/demo11/assets/media/svg/brand-logos/pinterest-p.svg" class="h-20px my-2" alt="">
                                </a>
                                <!--end::Icon-->
                                <!--begin::Icon-->
                                <a href="#" class="mx-4">
                                    <img src="/metronic8/demo11/assets/media/svg/brand-logos/twitter.svg" class="h-20px my-2" alt="">
                                </a>
                                <!--end::Icon-->
                                <!--begin::Icon-->
                                <a href="#" class="mx-4">
                                    <img src="/metronic8/demo11/assets/media/svg/brand-logos/dribbble-icon-1.svg" class="h-20px my-2" alt="">
                                </a>
                                <!--end::Icon-->
                            </div>
                            <!--end::Icons-->
                        </div>
                        <!--end::Post content-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-100 w-xl-300px mb-10">
                        <!--begin::Search blog-->
                        <div class="mb-16">
                            <h4 class="text-black mb-7">Cari Diklat</h4>
                            <!--begin::Input group-->
                            <div class="position-relative">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" class="form-control form-control-solid ps-10" name="search" value="" placeholder="Search">
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Search blog-->
                        <!--begin::Catigories-->
                        <div class="mb-16">
                            <h4 class="text-black mb-7">Diklat Berdasarkan Kategori</h4>
                            @foreach($bidangKeahlian as $bidangKea)
                                <div class="d-flex flex-stack fw-bold fs-5 text-muted mb-4">
                                    <a href="/diklat/kategori/{{$bidangKea->id}}" class="text-muted text-hover-primary pe-2">{{ $bidangKea->nama_bidang_keahlian}}</a>
                                    <div class="m-0">{{ $bidangKea->programKeahlian()->count()}}</div>
                                </div>
                            @endforeach
                        </div>
                        <!--end::Catigories-->
                        <!--begin::Recent posts-->
                        <div class="m-0">
                            <h4 class="text-black mb-7">Diklat Terkait</h4>
                            @foreach($diklatTerkait as $terkait)
                            <div class="d-flex flex-stack mb-7">
                                <div class="symbol symbol-60px symbol-2by3 me-4">
                                    <div class="symbol-label" style="background-image: url('{{ asset('assets/media/stock/600x400/img-1.jpg')}}')"></div>
                                </div>
                                <div class="m-0">
                                    <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ date('d F Y', strtotime($terkait->tanggal_mulai)) }}</a>
                                    <span class="text-gray-600 fw-bold d-block pt-1 fs-7">{{ $terkait->nama_diklat }}</span>
                                </div>
                            </div>
                            <div class="d-flex flex-stack mb-7">
                                <div class="symbol symbol-60px symbol-2by3 me-4">
                                    <div class="symbol-label" style="background-image: url('{{ asset('assets/media/stock/600x400/img-1.jpg')}}')"></div>
                                </div>
                                <div class="m-0">
                                    <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ date('d F Y', strtotime($terkait->tanggal_mulai)) }}</a>
                                    <span class="text-gray-600 fw-bold d-block pt-1 fs-7">We’ve been a focused on making a the sky</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!--end::Recent posts-->
                    </div>
                    <!--end::Sidebar-->
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Post card-->
    </div>
    <!--end::Post-->
</div>
@if(Auth::guard('gtk')->check())
    <input type="hidden" id="diklat_id" name="diklat_id" value="{{$diklat->id}}">
    <input type="hidden" id="user_id" name="user_id" value="{{Auth::guard('gtk')->user()->id}}">
@endif
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        function konfirmasi_pendaftaran(){
            Swal.fire({
                title: 'Apakah anda yakin ingin mendaftar untuk diklat ini ?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Tidak!',
                confirmButtonText: 'Ya, saya yakin!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var diklat_id = $("#diklat_id").val();
                    var user_id = $("#user_id").val();
                    $.ajax({
                        url: "/ajax/daftar-diklat-mandiri",
                        type: "GET",
                        data: {
                            diklat_id: diklat_id,
                            peserta_id: user_id
                        },
                        success: function (response) {
                            console.log(response);
                            Swal.fire(
                                'Berhasil!',
                                'Admin akan mengkonfirmasi secepatnya untuk status pendaftaran anda',
                                'success'
                            )
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });

                }
            })
        }
    </script>
@endpush
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tahap 1 : Verifikasi Akun</title>
    <meta charset="utf-8" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="/metronic8/demo11/assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
    <!--End::Google Tag Manager (noscript) -->
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-up -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
            style="background-image: url(/metronic8/demo11/assets/media/illustrations/sketchy-1/14.png">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a href="/metronic8/demo11/../demo11/index.html" class="mb-12">
                    <img alt="Logo" src="{{ asset('LOGO-BAru-2020.png') }}" width="100" />
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form action="{{ url('verifikasi-email') }}" method="POST" class="form w-100 needs-validation"
                        novalidate>
                        @CSRF
                        <!--begin::Heading-->
                        <div class="mb-10 text-center">
                            
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Tahap 1 Dari 3 : Verifikasi Akun GTK</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div class="text-gray-400 fw-bold fs-4">Sudah Punya Akun ?
                                <a href="{{ url('masuk') }}" class="link-primary fw-bolder">Login Disini</a>
                            </div>
                            <div class="alert alert-primary" role="alert" style="margin-top:20px;text-align:left">
                                <b>Sistem akan melakukan proses verifikasi data anda yang anda input dari database, instruksi selanjutnya akan dikirim ke email.</b>
                              </div>
                            <!--end::Link-->
                        </div>
                        <!--end::Heading-->
                        <!--end::Separator-->
                        @include('validation_error')
                        <!--begin::Input group-->
                        <div class="row fv-row mb-7">
                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <label class="form-label fw-bolder text-dark fs-6">Nama Lengkap</label>
                                <input type="text" placeholder="Nama Lengkap" name="nama_lengkap" autocomplete="off"
                                class="@error('nama_lengkap') is-invalid @enderror form-control form-control-lg form-control-solid"
                                value="{{ old('nama_lengkap') }}" />
                            @error('nama_lengkap')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <label class="form-label fw-bolder text-dark fs-6">Tanggal Lahir</label>
                                <input
                                    class="@error('tanggal_lahir') is-invalid @enderror form-control form-control-lg form-control-solid"
                                    type="date" placeholder="Tanggal Lahir" name="tanggal_lahir" 
                                    value="{{ old('tanggal_lahir') }}" />
                                @error('tanggal_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--end::Col-->
                        </div>

                        <div class="row fv-row mb-7">
                            <div class="col-xl-6">
                                <label class="form-label fw-bolder text-dark fs-6">NIK</label>
                                <input
                                    class="@error('nik') is-invalid @enderror form-control form-control-lg form-control-solid"
                                    type="text" placeholder="Nomor Induk Kewarganegaraan" name="nik" autocomplete="off"
                                    value="{{ old('nik') }}" />
                                @error('nik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label fw-bolder text-dark fs-6">Email</label>
                                <input
                                    class="@error('email') is-invalid @enderror form-control form-control-lg form-control-solid"
                                    type="text" placeholder="Email" name="email" autocomplete="off"
                                    value="{{ old('email') }}" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-danger" style="margin-left:-60px;">
                                Daftar Sekarang
                            </button>
                            <a href="/" class="btn btn-lg btn-primary">Kembali Ke Halaman Utama</a>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="d-flex flex-center flex-column-auto p-10">
                <!--begin::Links-->
                <div class="d-flex align-items-center fw-bold fs-6">
                    <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2">About</a>
                    <a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>
                    <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2">Contact Us</a>
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Authentication - Sign-up-->
    </div>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/sign-up/general.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.instansi').select2({
                placeholder: 'Cari Nama Instansi',
                ajax: {
                    url: '/ajax/select2Instansi',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nama_instansi,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('.kompetensi_keahlian').select2({
                placeholder: 'Cari Kompetensi Keahlian',
                ajax: {
                    url: '/ajax/select2KompetensiKeahlian',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nama_kompetensi_keahlian,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('#reload').click(function() {
                $.ajax({
                    type: 'GET',
                    url: 'reload-captcha',
                    success: function(data) {
                        $(".captcha span").html(data.captcha);
                    }
                });
            });
        });
    </script>
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>

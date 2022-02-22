<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form Pendaftaran</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
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
                    <form action="{{ url('pendaftaran/create') }}" method="POST" class="form w-100 needs-validation"
                        novalidate>
                        @CSRF
                        <!--begin::Heading-->
                        <div class="mb-10 text-center">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Pendaftaran Akun Baru</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div class="text-gray-400 fw-bold fs-4">Sudah Punya Akun ?
                                <a href="{{ url('masuk') }}" class="link-primary fw-bolder">Login Disini</a>
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
                                <label class="form-label fw-bolder text-dark fs-6">NUPTK</label>
                                <input
                                    class="@error('nuptk') is-invalid @enderror form-control form-control-lg form-control-solid"
                                    type="text" placeholder="NUPTK" name="nuptk" autocomplete="off"
                                    value="{{ old('nuptk') }}" />
                                @error('nuptk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6">Sekolah/ Instansi</label>
                            <select name="instansi_id" id="instansi"
                                class="@error('instansi_id') is-invalid @enderror instansi form-control form-control-lg form-control-solid"
                                style="height: 100px;" placeholder="Masukan Nama Instansi">
                            </select>
                            @error('instansi_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6">Nomor HP</label>
                            <input
                                class="@error('nomor_hp') is-invalid @enderror form-control form-control-lg form-control-solid"
                                type="number" placeholder="Nomor HP" name="nomor_hp" autocomplete="off"
                                value="{{ old('nomor_hp') }}" />
                            @error('nomor_hp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row fv-row mb-7">
                            <div class="col-xl-6">
                                <label class="form-label fw-bolder text-dark fs-6">Jenis Bidang Keahlian</label>
                                <select class="form-control">
                                    <option value="produktif">Produktif</option>
                                    <option value="adaptif">Adaptif</option>
                                </select>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label fw-bolder text-dark fs-6">Kompetensi Keahlian</label>

                                <select name="kompetensi_keahlian_id" id="kompetensi_keahlian"
                                class="@error('instansi_id') is-invalid @enderror instansi form-control form-control-lg form-control-solid kompetensi_keahlian"
                                style="height: 100px;" placeholder="masukan Kompetensi Keahlian">
                                </select>
                                @error('nuptk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="fv-row mb-7">
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
                        <div class="row fv-row mb-7">
                            <div class="col-xl-6">
                                <label class="form-label fw-bolder text-dark fs-6">Password</label>
                                <input
                                    class="@error('password') is-invalid @enderror form-control form-control-lg form-control-solid"
                                    type="password" placeholder="Password" name="password" autocomplete="off" />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label fw-bolder text-dark fs-6">Konfirmasi Password</label>
                                <input
                                    class="@error('confirm_password') is-invalid @enderror form-control form-control-lg form-control-solid"
                                    type="password" placeholder="Konfirmasi Password" name="confirm_password" autocomplete="off" />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="fv-row mb-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <input name="captcha"
                                    class="@error('captcha') is-invalid @enderror form-control form-control-lg form-control-solid"
                                    type="text" placeholder="Kode Captha" name="captcha" />
                                @error('captcha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="captcha mb-3">
                                        <span>{!! captcha_img() !!}</span>
                                        <button type="button" class="btn btn-danger" class="reload" id="reload">
                                            &#x21bb;
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-danger">
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

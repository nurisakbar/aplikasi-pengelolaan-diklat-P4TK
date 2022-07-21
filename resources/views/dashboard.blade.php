@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    {{-- <div class="toolbar py-5 py-lg-5" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-xxl py-5">
            <!--begin::Row-->
            <div class="row gy-0 gx-10">
                @if (session('message') != null)
                    <div class="col-xl-12 mb-5">
                        @include('alert')
                    </div>
                @endif
                <div class="col-xl-8">
                    <!--begin::Engage widget 2-->
                    <div class="card card-xl-stretch bg-body border-0 mb-5 mb-xl-0">
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column flex-lg-row flex-stack p-lg-15">
                            <!--begin::Info-->
                            <div
                                class="d-flex flex-column justify-content-center align-items-center align-items-lg-start me-10 text-center text-lg-start">
                                <!--begin::Title-->
                                <h3 class="fs-2hx line-height-lg mb-5">
                                    <span class="fw-bold">Brilliant App Ideas</span>
                                    <br>
                                    <span class="fw-bolder">for Startups</span>
                                </h3>
                                <!--end::Title-->
                                <div class="fs-4 text-muted mb-7">Long before you sit down to put the pen
                                    <br>need to make sure you breathe
                                </div>
                                <a href="#" class="btn btn-success fw-bold px-6 py-3" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_campaign">Create an Store</a>
                            </div>
                            <!--end::Info-->
                            <!--begin::Illustration-->
                            <img src="/metronic8/demo11/assets/media/illustrations/sketchy-1/11.png" alt=""
                                class="mw-200px mw-lg-350px mt-lg-n10">
                            <!--end::Illustration-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Engage widget 2-->
                </div>
                <div class="col-xl-4">
                    <!--begin::Mixed Widget 16-->
                    <div class="card card-xl-stretch bg-body border-0">
                        <!--begin::Body-->
                        <div class="card-body pt-5 mb-xl-9 position-relative">
                            <!--begin::Heading-->
                            <div class="d-flex flex-stack">
                                <!--begin::Title-->
                                <h4 class="fw-bolder text-gray-800 m-0">User Base</h4>
                                <!--end::Title-->
                                <!--begin::Menu-->
                                <div class="me-1">
                                    <button class="btn btn-icon btn-color-gray-500 w-auto px-0 btn-active-color-primary"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                        data-kt-menu-overflow="true">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                        <span class="svg-icon svg-icon-1 me-n1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="black">
                                                </rect>
                                                <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="black">
                                                </rect>
                                                <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="black">
                                                </rect>
                                                <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="black">
                                                </rect>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                    <!--begin::Menu 1-->
                                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                        id="kt_menu_61c821a764b2f">
                                        <!--begin::Header-->
                                        <div class="px-7 py-5">
                                            <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Menu separator-->
                                        <div class="separator border-gray-200"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Form-->
                                        <div class="px-7 py-5">
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Status:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div>
                                                    <select class="form-select form-select-solid select2-hidden-accessible"
                                                        data-kt-select2="true" data-placeholder="Select option"
                                                        data-dropdown-parent="#kt_menu_61c821a764b2f"
                                                        data-allow-clear="true" data-select2-id="select2-data-7-5hkq"
                                                        tabindex="-1" aria-hidden="true">
                                                        <option data-select2-id="select2-data-9-8wqf"></option>
                                                        <option value="1">Approved</option>
                                                        <option value="2">Pending</option>
                                                        <option value="2">In Process</option>
                                                        <option value="2">Rejected</option>
                                                    </select><span
                                                        class="select2 select2-container select2-container--bootstrap5"
                                                        dir="ltr" data-select2-id="select2-data-8-7rpv"
                                                        style="width: 100%;"><span class="selection"><span
                                                                class="select2-selection select2-selection--single form-select form-select-solid"
                                                                role="combobox" aria-haspopup="true" aria-expanded="false"
                                                                tabindex="0" aria-disabled="false"
                                                                aria-labelledby="select2-cc8i-container"
                                                                aria-controls="select2-cc8i-container"><span
                                                                    class="select2-selection__rendered"
                                                                    id="select2-cc8i-container" role="textbox"
                                                                    aria-readonly="true" title="Select option"><span
                                                                        class="select2-selection__placeholder">Select
                                                                        option</span></span><span
                                                                    class="select2-selection__arrow" role="presentation"><b
                                                                        role="presentation"></b></span></span></span><span
                                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Member Type:</label>
                                                <!--end::Label-->
                                                <!--begin::Options-->
                                                <div class="d-flex">
                                                    <!--begin::Options-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                        <input class="form-check-input" type="checkbox" value="1">
                                                        <span class="form-check-label">Author</span>
                                                    </label>
                                                    <!--end::Options-->
                                                    <!--begin::Options-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="2"
                                                            checked="checked">
                                                        <span class="form-check-label">Customer</span>
                                                    </label>
                                                    <!--end::Options-->
                                                </div>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Notifications:</label>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <div
                                                    class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        name="notifications" checked="checked">
                                                    <label class="form-check-label">Enabled</label>
                                                </div>
                                                <!--end::Switch-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <button type="reset"
                                                    class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                    data-kt-menu-dismiss="true">Reset</button>
                                                <button type="submit" class="btn btn-sm btn-primary"
                                                    data-kt-menu-dismiss="true">Apply</button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Menu 1-->
                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Chart-->
                            <div class="d-flex flex-center mb-5 mb-xxl-0">
                                <div id="kt_charts_mixed_widget_16_chart" style="height: 260px; min-height: 206.217px;">
                                    <div id="apexcharts6m90r2lai"
                                        class="apexcharts-canvas apexcharts6m90r2lai apexcharts-theme-light"
                                        style="width: 340px; height: 206.217px;"><svg id="SvgjsSvg1208" width="340"
                                            height="206.2166748046875" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
                                            class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                            style="background: transparent none repeat scroll 0% 0%;">
                                            <g id="SvgjsG1210" class="apexcharts-inner apexcharts-graphical"
                                                transform="translate(53, 0)">
                                                <defs id="SvgjsDefs1209">
                                                    <clipPath id="gridRectMask6m90r2lai">
                                                        <rect id="SvgjsRect1212" width="242" height="260" x="-3" y="-1"
                                                            rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                            stroke-dasharray="0" fill="#fff"></rect>
                                                    </clipPath>
                                                    <clipPath id="forecastMask6m90r2lai"></clipPath>
                                                    <clipPath id="nonForecastMask6m90r2lai"></clipPath>
                                                    <clipPath id="gridRectMarkerMask6m90r2lai">
                                                        <rect id="SvgjsRect1213" width="240" height="262" x="-2" y="-2"
                                                            rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                            stroke-dasharray="0" fill="#fff"></rect>
                                                    </clipPath>
                                                </defs>
                                                <g id="SvgjsG1214" class="apexcharts-radialbar">
                                                    <g id="SvgjsG1215">
                                                        <g id="SvgjsG1216" class="apexcharts-tracks">
                                                            <g id="SvgjsG1217"
                                                                class="apexcharts-radialbar-track apexcharts-track" rel="1">
                                                                <path id="apexcharts-radialbarTrack-0"
                                                                    d="M 30.93048780487804 117.99999999999999 A 87.06951219512196 87.06951219512196 0 0 1 205.06951219512194 118"
                                                                    fill="none" fill-opacity="1"
                                                                    stroke="rgba(232,255,243,0.85)" stroke-opacity="1"
                                                                    stroke-linecap="round" stroke-width="11.36829268292683"
                                                                    stroke-dasharray="0" class="apexcharts-radialbar-area"
                                                                    data:pathOrig="M 30.93048780487804 117.99999999999999 A 87.06951219512196 87.06951219512196 0 0 1 205.06951219512194 118">
                                                                </path>
                                                            </g>
                                                        </g>
                                                        <g id="SvgjsG1219">
                                                            <g id="SvgjsG1224"
                                                                class="apexcharts-series apexcharts-radial-series"
                                                                seriesName="TotalxMembers" rel="1" data:realIndex="0">
                                                                <path id="SvgjsPath1225"
                                                                    d="M 30.93048780487804 117.99999999999999 A 87.06951219512196 87.06951219512196 0 0 1 177.3812645285149 54.32138995792205"
                                                                    fill="none" fill-opacity="0.85"
                                                                    stroke="rgba(80,205,137,0.85)" stroke-opacity="1"
                                                                    stroke-linecap="round" stroke-width="11.368292682926832"
                                                                    stroke-dasharray="0"
                                                                    class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                                    data:angle="133" data:value="74" index="0" j="0"
                                                                    data:pathOrig="M 30.93048780487804 117.99999999999999 A 87.06951219512196 87.06951219512196 0 0 1 177.3812645285149 54.32138995792205">
                                                                </path>
                                                            </g>
                                                            <circle id="SvgjsCircle1220" r="81.38536585365854" cx="118"
                                                                cy="118" class="apexcharts-radialbar-hollow"
                                                                fill="transparent"></circle>
                                                            <g id="SvgjsG1221" class="apexcharts-datalabels-group"
                                                                transform="translate(0, 0) scale(1)" style="opacity: 1;">
                                                                <text id="SvgjsText1222" font-family="inherit" x="118"
                                                                    y="113" text-anchor="middle" dominant-baseline="auto"
                                                                    font-size="13px" font-weight="700" fill="#a1a5b7"
                                                                    class="apexcharts-text apexcharts-datalabel-label"
                                                                    style="font-family: inherit;">Total
                                                                    Members</text><text id="SvgjsText1223"
                                                                    font-family="inherit" x="118" y="94"
                                                                    text-anchor="middle" dominant-baseline="auto"
                                                                    font-size="30px" font-weight="700" fill="#5e6278"
                                                                    class="apexcharts-text apexcharts-datalabel-value"
                                                                    style="font-family: inherit;">74%</text>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                                <line id="SvgjsLine1226" x1="0" y1="0" x2="236" y2="0" stroke="#b6b6b6"
                                                    stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                                    class="apexcharts-ycrosshairs"></line>
                                                <line id="SvgjsLine1227" x1="0" y1="0" x2="236" y2="0" stroke-dasharray="0"
                                                    stroke-width="0" stroke-linecap="butt"
                                                    class="apexcharts-ycrosshairs-hidden"></line>
                                            </g>
                                            <g id="SvgjsG1211" class="apexcharts-annotations"></g>
                                        </svg>
                                        <div class="apexcharts-legend"></div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Chart-->
                            <!--begin::Content-->
                            <div class="text-center position-absolute bottom-0 start-50 translate-middle-x w-100 mb-10">
                                <!--begin::Text-->
                                <p class="fw-bold fs-4 text-gray-400 mb-7 px-5">Long before you sit down to put the
                                    <br>make sure you breathe
                                </p>
                                <!--end::Text-->
                                <!--begin::Action-->
                                <div class="m-0">
                                    <a href="#" class="btn btn-success fw-bold" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_invite_friends">Invite Users</a>
                                </div>
                                <!--ed::Action-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Mixed Widget 16-->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->

    </div> --}}

    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Row-->
            <div class="row gy-0 gx-10">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <ul class="nav row mb-10">
                        <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                            <a class="nav-link btn btn-flex btn-color-gray-400 btn-outline btn-outline-default btn-active-primary d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px"
                                data-bs-toggle="tab">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                <span class="svg-icon svg-icon-3x mb-5 mx-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path opacity="0.3"
                                            d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                            fill="black"></path>
                                        <path
                                            d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-6 fw-bold">{{ $jumlahDiklatAktif }} DIKLAT AKTIF</span>
                            </a>
                        </li>

                        <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                            <a class="nav-link btn btn-flex btn-color-gray-400 btn-outline btn-outline-default btn-active-primary d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px"
                                data-bs-toggle="tab" href="#kt_general_widget_1_2">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen008.svg-->
                                <span class="svg-icon svg-icon-3x mb-5 mx-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z"
                                            fill="black"></path>
                                        <path opacity="0.3"
                                            d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z"
                                            fill="black"></path>
                                        <path opacity="0.3"
                                            d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z"
                                            fill="black"></path>
                                        <path opacity="0.3"
                                            d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-6 fw-bold">{{ rupiah($jumlahGtk)}} DATA GTK</span>
                            </a>
                        </li>
                        <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                            <a class="nav-link btn btn-flex btn-color-gray-400 btn-outline btn-outline-default btn-active-primary d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px active"
                                data-bs-toggle="tab" href="#kt_general_widget_1_3">
                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                <span class="svg-icon svg-icon-3x mb-5 mx-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path opacity="0.3"
                                            d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                                            fill="black"></path>
                                        <path
                                            d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-6 fw-bold">{{ rupiah($jumlahInstansi) }} DATA INSTANSI</span>
                            </a>
                        </li>
                        <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                            <a href="/diklat/laporan-peserta-diklat?status=peserta" class="nav-link btn btn-flex btn-color-gray-400 btn-outline btn-outline-default btn-active-primary d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px"
                                data-bs-toggle="tab">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                <span class="svg-icon svg-icon-3x mb-5 mx-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"></rect>
                                        <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black">
                                        </rect>
                                        <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"></rect>
                                        <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-6 fw-bold">{{ rupiah($jumlahPesertaDiklat) }} PESERTA PADA SEMUA DIKLAT
                            </a>
                        </li>
                        <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                            <a href="/diklat/laporan-peserta-diklat?status=pendaftar" class="nav-link btn btn-flex btn-color-gray-400 btn-outline btn-outline-default btn-active-primary d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px"
                                data-bs-toggle="tab" href="#kt_general_widget_1_5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                <span class="svg-icon svg-icon-3x mb-5 mx-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path opacity="0.3"
                                            d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                            fill="black"></path>
                                        <path
                                            d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-6 fw-bold">{{ rupiah($jumlahPendaftarDiklat)}} CALON PESERTA PADA SEMUA DIKLAT
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Row-->
            <div class="row gy-0 gx-10">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Grafik Diklat Perdepartemen</span>
                        <span class="text-muted mt-1 fw-bold fs-7">Diklat Per Departemen</span>
                    </h3>
                    <div id="chart" style="height: 300px;"></div>
                </div>
                <div class="col-xl-12">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Daftar Diklat</span>
                        <span class="text-muted mt-1 fw-bold fs-7">Daftar Diklat Yang Aktif</span>
                    </h3>
                    <table class="table table-rounded table-striped border gy-7 gs-7" id="users-table">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                <th width="10">Nomor</th>
                                <th>Nama Kegiatan/ Diklat</th>
                                <th>Kategori</th>
                                <th>Kompetensi Keahlian</th>
                                <th>Tahun Pelaksaan</th>
                                <th>Jumlah Peserta</th>
                                <th>Status Aktif</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/diklat',
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'nama_diklat', name: 'nama_diklat' },
                { data: 'kategori.nama_kategori', name: 'kategori.nama_kategori' },
                { data: 'program_keahlian.nama_program_keahlian', name: 'program_keahlian.nama_program_keahlian' },
                { data: 'tahun', name: 'tahun' },
                { data: 'jumlah_peserta', name: 'jumlah_peserta' },
                { data: 'status_aktif', name: 'status_aktif' }
            ]
        });
    });
    </script>
        <script>
            const chart = new Chartisan({
              el: '#chart',
              url: "@chart('chart_diklat_per_departemen')",
            });
          </script>
@endpush

@push('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush

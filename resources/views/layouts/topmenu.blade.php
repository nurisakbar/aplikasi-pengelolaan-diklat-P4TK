<div class="header-menu-container container-xxl d-flex flex-stack h-lg-75px w-100" id="kt_header_nav">
    <!--begin::Menu wrapper-->
    <div class="header-menu flex-column flex-lg-row" data-kt-drawer="true" data-kt-drawer-name="header-menu"
        data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
        data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
        data-kt-drawer-toggle="#kt_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend"
        data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
        <!--begin::Menu-->


        <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch flex-grow-1"
            id="#kt_header_menu" data-kt-menu="true">
            @if (Auth::check())
                <div data-kt-menu-placement="bottom-start" class="menu-item me-lg-1">
                    <a class="menu-link py-3" href="{{ url('/dashboard') }}">
                        <span class="menu-title">Dashboard</span>
                        <span class="menu-arrow d-lg-none"></span>
                    </a>
                </div>
                <div data-kt-menu-placement="bottom-start" class="menu-item me-lg-1">
                    <a class="menu-link py-3" href="{{ url('gtk?status=approve') }}">
                        <span class="menu-title">Data GTK</span>
                        <span class="menu-arrow d-lg-none"></span>
                    </a>
                </div>

                @if(auth()->user()->can('Diklat Lihat Module Diklat'))
                    <div data-kt-menu-placement="bottom-start" class="menu-item me-lg-1">
                        <a class="menu-link py-3" href="{{ url('diklat') }}">
                            <span class="menu-title">Data Diklat</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                    </div>
                @endif

                <div data-kt-menu-placement="bottom-start" class="menu-item me-lg-1">
                    <a class="menu-link py-3" href="{{ url('instansi') }}">
                        <span class="menu-title">Data Instansi</span>
                        <span class="menu-arrow d-lg-none"></span>
                    </a>
                </div>

                <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                    class="menu-item menu-lg-down-accordion me-lg-1">
                    <a class="menu-link py-3"
                        href="#">
                        <span class="menu-title">Data Referensi</span>
                        <span class="menu-arrow d-lg-none"></span>
                    </a>
                    <div
                        class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                        <div class="menu-item">
                            <a class="menu-link py-3" href="{{ url('bidangkeahlian') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art002.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25"
                                            viewBox="0 0 24 25" fill="none">
                                            <path opacity="0.3"
                                                d="M8.9 21L7.19999 22.6999C6.79999 23.0999 6.2 23.0999 5.8 22.6999L4.1 21H8.9ZM4 16.0999L2.3 17.8C1.9 18.2 1.9 18.7999 2.3 19.1999L4 20.9V16.0999ZM19.3 9.1999L15.8 5.6999C15.4 5.2999 14.8 5.2999 14.4 5.6999L9 11.0999V21L19.3 10.6999C19.7 10.2999 19.7 9.5999 19.3 9.1999Z"
                                                fill="black" />
                                            <path
                                                d="M21 15V20C21 20.6 20.6 21 20 21H11.8L18.8 14H20C20.6 14 21 14.4 21 15ZM10 21V4C10 3.4 9.6 3 9 3H4C3.4 3 3 3.4 3 4V21C3 21.6 3.4 22 4 22H9C9.6 22 10 21.6 10 21ZM7.5 18.5C7.5 19.1 7.1 19.5 6.5 19.5C5.9 19.5 5.5 19.1 5.5 18.5C5.5 17.9 5.9 17.5 6.5 17.5C7.1 17.5 7.5 17.9 7.5 18.5Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Bidang Keahlian</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link py-3" href="{{ url('departemen') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art002.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25"
                                            viewBox="0 0 24 25" fill="none">
                                            <path opacity="0.3"
                                                d="M8.9 21L7.19999 22.6999C6.79999 23.0999 6.2 23.0999 5.8 22.6999L4.1 21H8.9ZM4 16.0999L2.3 17.8C1.9 18.2 1.9 18.7999 2.3 19.1999L4 20.9V16.0999ZM19.3 9.1999L15.8 5.6999C15.4 5.2999 14.8 5.2999 14.4 5.6999L9 11.0999V21L19.3 10.6999C19.7 10.2999 19.7 9.5999 19.3 9.1999Z"
                                                fill="black" />
                                            <path
                                                d="M21 15V20C21 20.6 20.6 21 20 21H11.8L18.8 14H20C20.6 14 21 14.4 21 15ZM10 21V4C10 3.4 9.6 3 9 3H4C3.4 3 3 3.4 3 4V21C3 21.6 3.4 22 4 22H9C9.6 22 10 21.6 10 21ZM7.5 18.5C7.5 19.1 7.1 19.5 6.5 19.5C5.9 19.5 5.5 19.1 5.5 18.5C5.5 17.9 5.9 17.5 6.5 17.5C7.1 17.5 7.5 17.9 7.5 18.5Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Data Departemen</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link py-3" href="{{ url('kategori') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art002.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25"
                                            viewBox="0 0 24 25" fill="none">
                                            <path opacity="0.3"
                                                d="M8.9 21L7.19999 22.6999C6.79999 23.0999 6.2 23.0999 5.8 22.6999L4.1 21H8.9ZM4 16.0999L2.3 17.8C1.9 18.2 1.9 18.7999 2.3 19.1999L4 20.9V16.0999ZM19.3 9.1999L15.8 5.6999C15.4 5.2999 14.8 5.2999 14.4 5.6999L9 11.0999V21L19.3 10.6999C19.7 10.2999 19.7 9.5999 19.3 9.1999Z"
                                                fill="black" />
                                            <path
                                                d="M21 15V20C21 20.6 20.6 21 20 21H11.8L18.8 14H20C20.6 14 21 14.4 21 15ZM10 21V4C10 3.4 9.6 3 9 3H4C3.4 3 3 3.4 3 4V21C3 21.6 3.4 22 4 22H9C9.6 22 10 21.6 10 21ZM7.5 18.5C7.5 19.1 7.1 19.5 6.5 19.5C5.9 19.5 5.5 19.1 5.5 18.5C5.5 17.9 5.9 17.5 6.5 17.5C7.1 17.5 7.5 17.9 7.5 18.5Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Kategori Diklat</span>
                            </a>
                        </div>


                        <div class="menu-item">
                            <a class="menu-link py-3" href="{{ url('programkeahlian') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen009.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                d="M21 22H14C13.4 22 13 21.6 13 21V3C13 2.4 13.4 2 14 2H21C21.6 2 22 2.4 22 3V21C22 21.6 21.6 22 21 22Z"
                                                fill="black" />
                                            <path
                                                d="M10 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H10C10.6 2 11 2.4 11 3V21C11 21.6 10.6 22 10 22Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Program Keahlian</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link py-3" href="{{ url('kompetensikeahlian') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com001.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                fill="black" />
                                            <path
                                                d="M19 10.4C19 10.3 19 10.2 19 10C19 8.9 18.1 8 17 8H16.9C15.6 6.2 14.6 4.29995 13.9 2.19995C13.3 2.09995 12.6 2 12 2C11.9 2 11.8 2 11.7 2C12.4 4.6 13.5 7.10005 15.1 9.30005C15 9.50005 15 9.7 15 10C15 11.1 15.9 12 17 12C17.1 12 17.3 12 17.4 11.9C18.6 13 19.9 14 21.4 14.8C21.4 14.8 21.5 14.8 21.5 14.9C21.7 14.2 21.8 13.5 21.9 12.7C20.9 12.1 19.9 11.3 19 10.4Z"
                                                fill="black" />
                                            <path
                                                d="M12 15C11 13.1 10.2 11.2 9.60001 9.19995C9.90001 8.89995 10 8.4 10 8C10 7.1 9.40001 6.39998 8.70001 6.09998C8.40001 4.99998 8.20001 3.90005 8.00001 2.80005C7.30001 3.10005 6.70001 3.40002 6.20001 3.90002C6.40001 4.80002 6.50001 5.6 6.80001 6.5C6.40001 6.9 6.10001 7.4 6.10001 8C6.10001 9 6.80001 9.8 7.80001 10C8.30001 11.6 9.00001 13.2 9.70001 14.7C7.10001 13.2 4.70001 11.5 2.40001 9.5C2.20001 10.3 2.10001 11.1 2.10001 11.9C4.60001 13.9 7.30001 15.7 10.1 17.2C10.2 18.2 11 19 12 19C12.6 20 13.2 20.9 13.9 21.8C14.6 21.7 15.3 21.5 15.9 21.2C15.4 20.5 14.9 19.8 14.4 19.1C15.5 19.5 16.5 19.9 17.6 20.2C18.3 19.8 18.9 19.2 19.4 18.6C17.6 18.1 15.7 17.5 14 16.7C13.9 15.8 13.1 15 12 15Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Kompetensi Keahlian</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                    class="menu-item menu-lg-down-accordion me-lg-1">
                    <a class="menu-link py-3"
                        href="https://preview.keenthemes.com/metronic8/demo11/../demo11/index.html">
                        <span class="menu-title">Data Pengguna</span>
                        <span class="menu-arrow d-lg-none"></span>
                    </a>
                    <div
                        class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                        <div class="menu-item">
                            <a class="menu-link py-3" href="{{ url('user') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art002.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25"
                                            viewBox="0 0 24 25" fill="none">
                                            <path opacity="0.3"
                                                d="M8.9 21L7.19999 22.6999C6.79999 23.0999 6.2 23.0999 5.8 22.6999L4.1 21H8.9ZM4 16.0999L2.3 17.8C1.9 18.2 1.9 18.7999 2.3 19.1999L4 20.9V16.0999ZM19.3 9.1999L15.8 5.6999C15.4 5.2999 14.8 5.2999 14.4 5.6999L9 11.0999V21L19.3 10.6999C19.7 10.2999 19.7 9.5999 19.3 9.1999Z"
                                                fill="black" />
                                            <path
                                                d="M21 15V20C21 20.6 20.6 21 20 21H11.8L18.8 14H20C20.6 14 21 14.4 21 15ZM10 21V4C10 3.4 9.6 3 9 3H4C3.4 3 3 3.4 3 4V21C3 21.6 3.4 22 4 22H9C9.6 22 10 21.6 10 21ZM7.5 18.5C7.5 19.1 7.1 19.5 6.5 19.5C5.9 19.5 5.5 19.1 5.5 18.5C5.5 17.9 5.9 17.5 6.5 17.5C7.1 17.5 7.5 17.9 7.5 18.5Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Kelola Pengguna</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link py-3" href="{{ url('role') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen009.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                d="M21 22H14C13.4 22 13 21.6 13 21V3C13 2.4 13.4 2 14 2H21C21.6 2 22 2.4 22 3V21C22 21.6 21.6 22 21 22Z"
                                                fill="black" />
                                            <path
                                                d="M10 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H10C10.6 2 11 2.4 11 3V21C11 21.6 10.6 22 10 22Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Kelola Role</span>
                            </a>
                            <a class="menu-link py-3" href="{{ url('permission') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen009.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                d="M21 22H14C13.4 22 13 21.6 13 21V3C13 2.4 13.4 2 14 2H21C21.6 2 22 2.4 22 3V21C22 21.6 21.6 22 21 22Z"
                                                fill="black" />
                                            <path
                                                d="M10 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H10C10.6 2 11 2.4 11 3V21C11 21.6 10.6 22 10 22Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Kelola Permission</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                    class="menu-item menu-lg-down-accordion me-lg-1">
                    <a class="menu-link py-3"
                        href="#">
                        <span class="menu-title">Laporan</span>
                        <span class="menu-arrow d-lg-none"></span>
                    </a>
                    <div
                        class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                        <div class="menu-item">
                            <a class="menu-link py-3" href="{{ url('diklat/laporan-peserta-diklat?status=peserta') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art002.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25"
                                            viewBox="0 0 24 25" fill="none">
                                            <path opacity="0.3"
                                                d="M8.9 21L7.19999 22.6999C6.79999 23.0999 6.2 23.0999 5.8 22.6999L4.1 21H8.9ZM4 16.0999L2.3 17.8C1.9 18.2 1.9 18.7999 2.3 19.1999L4 20.9V16.0999ZM19.3 9.1999L15.8 5.6999C15.4 5.2999 14.8 5.2999 14.4 5.6999L9 11.0999V21L19.3 10.6999C19.7 10.2999 19.7 9.5999 19.3 9.1999Z"
                                                fill="black" />
                                            <path
                                                d="M21 15V20C21 20.6 20.6 21 20 21H11.8L18.8 14H20C20.6 14 21 14.4 21 15ZM10 21V4C10 3.4 9.6 3 9 3H4C3.4 3 3 3.4 3 4V21C3 21.6 3.4 22 4 22H9C9.6 22 10 21.6 10 21ZM7.5 18.5C7.5 19.1 7.1 19.5 6.5 19.5C5.9 19.5 5.5 19.1 5.5 18.5C5.5 17.9 5.9 17.5 6.5 17.5C7.1 17.5 7.5 17.9 7.5 18.5Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Laporan Peserta Diklat</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link py-3" href="{{ url('diklat/laporan-peserta-diklat?status=pendaftar') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art002.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25"
                                            viewBox="0 0 24 25" fill="none">
                                            <path opacity="0.3"
                                                d="M8.9 21L7.19999 22.6999C6.79999 23.0999 6.2 23.0999 5.8 22.6999L4.1 21H8.9ZM4 16.0999L2.3 17.8C1.9 18.2 1.9 18.7999 2.3 19.1999L4 20.9V16.0999ZM19.3 9.1999L15.8 5.6999C15.4 5.2999 14.8 5.2999 14.4 5.6999L9 11.0999V21L19.3 10.6999C19.7 10.2999 19.7 9.5999 19.3 9.1999Z"
                                                fill="black" />
                                            <path
                                                d="M21 15V20C21 20.6 20.6 21 20 21H11.8L18.8 14H20C20.6 14 21 14.4 21 15ZM10 21V4C10 3.4 9.6 3 9 3H4C3.4 3 3 3.4 3 4V21C3 21.6 3.4 22 4 22H9C9.6 22 10 21.6 10 21ZM7.5 18.5C7.5 19.1 7.1 19.5 6.5 19.5C5.9 19.5 5.5 19.1 5.5 18.5C5.5 17.9 5.9 17.5 6.5 17.5C7.1 17.5 7.5 17.9 7.5 18.5Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Laporan Pendaftar Diklat</span>
                            </a>
                        </div>
                    </div>
                </div>

            @else
                <div data-kt-menu-placement="bottom-start" class="menu-item me-lg-1">
                    <a class="menu-link py-3" href="{{ url('/') }}">
                        <span class="menu-title">Home</span>
                        <span class="menu-arrow d-lg-none"></span>
                    </a>
                </div>
                @if (!Auth::guard('gtk')->check())
                    <div data-kt-menu-placement="bottom-start" class="menu-item me-lg-1">
                        <a class="menu-link py-3" href="{{ url('/pendaftaran') }}">
                            <span class="menu-title">Pendaftaran Akun</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                    </div>
                    <div data-kt-menu-placement="bottom-start" class="menu-item me-lg-1">
                        <a class="menu-link py-3" href="{{ url('/masuk') }}">
                            <span class="menu-title">Login Pengguna</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                    </div>
                    <div data-kt-menu-placement="bottom-start" class="menu-item me-lg-1">
                        <a class="menu-link py-3" href="{{ url('/lupa-password') }}">
                            <span class="menu-title">Lupas Password</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                    </div>
                @else
                    <div data-kt-menu-placement="bottom-start" class="menu-item me-lg-1">
                        <a class="menu-link py-3" href="{{ url('/profile') }}">
                            <span class="menu-title">Profile Saya</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                    </div>
                    <div data-kt-menu-placement="bottom-start" class="menu-item me-lg-1">
                        <a class="menu-link py-3" href="{{ url('/profile/diklatsaya') }}">
                            <span class="menu-title">Riwayat Diklat</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                    </div>
                @endif
                
                <div data-kt-menu-placement="bottom-start" class="menu-item me-lg-1">
                    <a class="menu-link py-3" target="new" href="https://p4tkbmti.kemdikbud.go.id">
                        <span class="menu-title">Webiste Lembaga</span>
                        <span class="menu-arrow d-lg-none"></span>
                    </a>
                </div>
            @endif
        </div>
        @if (Auth::check())
            <div style="float:left;color:#5e6278;width:400px">
                Selamat Datang : <b>{{ Auth::user()->name }}</b> | <b onClick="logout()">Logout</b>
            </div>
        @endif
        @if (Auth::guard('gtk')->check())
            <div style="float:left;color:#5e6278;width:400px">
                Selamat Datang : <b>{{ Auth::guard('gtk')->user()->nama_lengkap }}</b> | <b onClick="logout()">Logout</b>
            </div>
        @endif
    </div>
    <!--end::Menu wrapper-->
</div>

@push('scripts')
<script>
    function logout() {
        console.log('logout');
        location.href = "/logout";
    }
</script>
@endpush


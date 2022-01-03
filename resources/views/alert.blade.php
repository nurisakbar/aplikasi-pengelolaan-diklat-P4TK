@if (session('message') != null)
    <!--begin::Alert-->
    <div class="alert alert-primary">
        <!--begin::Icon-->
        <span class="svg-icon svg-icon-2hx svg-icon-primary me-3">...</span>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column">
            <!--begin::Title-->
            <h4 class="mb-1 text-dark">Notifikasi</h4>
            <!--end::Title-->
            <!--begin::Content-->
            <span>{!! session('message') !!}.</span>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
@endif

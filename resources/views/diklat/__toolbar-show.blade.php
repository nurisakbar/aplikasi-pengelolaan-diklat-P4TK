<div class="toolbar py-5 py-lg-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
       <div class="page-title d-flex flex-column me-3">
          <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Diklat : {{ $diklat->nama_diklat }}</h1>
          <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
             <li class="breadcrumb-item text-gray-600">
                <a href="https://preview.keenthemes.com/metronic8/demo11/../demo11/index.html"
                   class="text-gray-600 text-hover-primary">Home</a>
             </li>
             <li class="breadcrumb-item text-gray-600">Apps</li>
          </ul>
       </div>
       <div class="d-flex align-items-center py-2 py-md-1">

          <a href="{{ url('diklat/'.$diklat->id.'/export?type=excel')}}" class="btn btn-primary btn-sm" style="margin-right:10px;"><i class="far fa-file-excel"></i> Download Excel</a>
          <a href="{{ url('diklat/'.$diklat->id.'/export?type=pdf')}}" class="btn btn-danger btn-sm" style="margin-right:10px;"><i class="far fa-file-pdf"></i> Download PDF</a>
          <button type="button" class="btn btn-success fw-bolder btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="far fa-plus-square"></i> Tambah Peserta Diklat
          </button>
       </div>
    </div>
 </div>
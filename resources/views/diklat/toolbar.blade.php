<div class="toolbar py-5 py-lg-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
       <div class="page-title d-flex flex-column me-3">
          <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Data Kegiatan/ Diklat</h1>
          <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
             <li class="breadcrumb-item text-gray-600">
                <a href="https://preview.keenthemes.com/metronic8/demo11/../demo11/index.html"
                   class="text-gray-600 text-hover-primary">Dashboard</a>
             </li>
             <li class="breadcrumb-item text-gray-600">Data Diklat</li>
          </ul>
       </div>
       <div class="d-flex align-items-center py-2 py-md-1">

          <button type="button" class="btn btn-primary" style="margin-right:10px;" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Import
          </button> 
          <button type="button" class="btn btn-primary" style="margin-right:10px;" data-bs-toggle="modal" data-bs-target="#exampleModal2">
            Import List Diklat
          </button> 
          @if(auth()->user()->can('Diklat Tambah Diklat'))
            <a href="{{ url('diklat/create')}}" class="btn btn-primary fw-bolder">Tambah Diklat Baru</a>
         @endif
       </div>
    </div>
 </div>
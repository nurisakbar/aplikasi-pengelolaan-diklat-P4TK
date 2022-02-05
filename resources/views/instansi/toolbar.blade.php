<div class="toolbar py-5 py-lg-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
       <div class="page-title d-flex flex-column me-3">
          <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Data Master Instansi</h1>
          <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
             <li class="breadcrumb-item text-gray-600">
                <a href="{{ url('/')}}"
                   class="text-gray-600 text-hover-primary">Home</a>
             </li>
             <li class="breadcrumb-item text-gray-600">Data Master Instansi</li>
          </ul>
       </div>
       @if(Request::segment(2) === null)
       <div class="d-flex align-items-center py-2 py-md-1">
          <div class="me-3">
             <a href="#" class="btn btn-light-primary fw-bolder" data-kt-menu-trigger="click"
                data-kt-menu-placement="bottom-end">
                <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                      fill="none">
                      <path
                         d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                         fill="black" />
                   </svg>
                </span>
                <!--end::Svg Icon-->Filter Data
             </a>

             
             <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                id="kt_menu_61c1ad817992a">
                {{ Form::open(['url'=>'instansi','method'=>'GET'])}}
                <div class="px-7 py-5">
                   <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                </div>
                <div class="separator border-gray-200"></div>
                <div class="px-7 py-5">
                   <div class="mb-10">
                      <label class="form-label fw-bold">Provinsi:</label>
                      <div>
                         {{ Form::select('province_id',$provinsi,null,['onChange'=>'load_kabupaten()','class'=>'provinsi_txt form-select form-select-solid','data-placeholder'=>'Select option','placeholder'=>'-- Semua Provinsi --'])}}
                      </div>
                   </div>

                   <div class="mb-10">
                     <label class="form-label fw-bold">Kabupaten:</label>
                     <div>
                        <div id="kabupaten"></div>
                     </div>
                  </div>

                  <div class="mb-10">
                     <label class="form-label fw-bold">Nama Instansi:</label>
                     <div>
                        <input type="text" name="nama_instansi" class="form-control" placeholder="Nama Instansi">
                     </div>
                  </div>
                   <div class="d-flex justify-content-end">
                         <a href="/instansi" class="btn btn-sm btn-light btn-active-light-primary me-2"
                         data-kt-menu-dismiss="true">Reset</a>
                      <button type="submit" class="btn btn-sm btn-primary"
                         data-kt-menu-dismiss="true">Tampilkan</button>
                   </div>
                </div>
                {{Form::close()}}
             </div>
          </div>
          <a href="{{ url('instansi/create')}}" class="btn btn-primary fw-bolder">Tambah Data Instansi</a>
       </div>
       @endif
    </div>
 </div>


 @push('scripts')

 <script>
    $( document ).ready(function() {
      console.log( "ready!" );
      });
    
    function load_kabupaten(){
       provinsi = $(".provinsi_txt").val();
       console.log(provinsi);
       $.ajax({
         url: "/ajax/kabupaten",
         cache: false,
         data:{provinsi:provinsi},
         success: function(response){
            console.log(response.nopes);
            $('#kabupaten').html(response);
         }
    })
   }
 </script>
 @endpush
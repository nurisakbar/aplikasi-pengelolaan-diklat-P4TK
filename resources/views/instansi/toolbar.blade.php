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
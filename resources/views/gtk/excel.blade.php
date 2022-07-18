<table class="table table-rounded table-striped border gy-7 gs-7" id="gtk-table">
    <thead>
        <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
            <th width="10">No UKG</th>
            <th>Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Umur</th>
            <th>Nomor HP</th>
            <th>Asal instansi</th>
            <th>Provinsi Instansi</th>
            <th>Kabupaten/ Kota Instansi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($gtk as $row)
        <tr>
            <td>{{$row->nomor_ukg}}'</td>
            <td>{{$row->nama_lengkap}}</td>
            <td>{{$row->jenis_kelamin}}</td>
            <td>0</td>
            <td>{{$row->nomor_hp}}</td>
            <td>{{$row->nama_instansi}}</td>
            <td>{{$row->instansi_province}}</td>
            <td>{{$row->instansi_regency}}</td>
        </tr>            
        @endforeach
    </tbody>
</table>
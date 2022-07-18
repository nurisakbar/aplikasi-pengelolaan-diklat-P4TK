<table class="table table-rounded table-striped border gy-7 gs-7" id="gtk-table">
    <thead>
        <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
            <th>Nama Instansi</th>
            <th>Jenis Instansi</th>
            <th>Status</th>
            <th>Telepon</th>
            <th>Kecamatan</th>
            <th>Kabupaten</th>
            <th>Provinsi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($instansi as $row)
        <tr>
            <td>{{$row->nama_instansi }}'</td>
            <td>{{$row->jenis_instansi }}</td>
            <td>{{$row->status}}</td>
            <td>{{$row->telepon}}</td>
            <td>{{$row->wilayahAdministratif->district_name??''}}</td>
            <td>{{$row->wilayahAdministratif->regency_name??''}}</td>
            <td>{{$row->wilayahAdministratif->province_name??''}}</td>
        </tr>            
        @endforeach
    </tbody>
</table>
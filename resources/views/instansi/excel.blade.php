<table class="table table-rounded table-striped border gy-7 gs-7" id="gtk-table">
    <thead>
        <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
            <th>NPSN</th>
            <th>Nama Instansi</th>
            <th>Jenis Instansi</th>
            <th>Status</th>
            <th>Telepon Sekolah</th>
            <th>Email</th>
            <th>Website</th>
            <th>Kecamatan</th>
            <th>Kabupaten</th>
            <th>Provinsi</th>
            <th>Nama Kepala Instansi</th>
            <th>Telpon Kepala Instansi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($instansi as $row)
        <tr>
            <td>{{$row->npsn }}'</td>
            <td>{{$row->nama_instansi }}</td>
            <td>{{$row->jenis_instansi }}</td>
            <td>{{$row->status}}</td>
            <td>{{$row->telepon}}</td>
            <td>{{$row->email}}</td>
            <td>{{$row->website}}</td>
            <td>{{$row->wilayahAdministratif->district_name??''}}</td>
            <td>{{$row->wilayahAdministratif->regency_name??''}}</td>
            <td>{{$row->wilayahAdministratif->province_name??''}}</td>
            <td>{{$row->nama_kepala_instansi}}</td>
            <td>{{$row->telpon_kepala_instansi}}</td>
        </tr>            
        @endforeach
    </tbody>
</table>
<table class="">
    <tr>
        <th>Nomor</th>
        <th>Nomor UKG</th>
        <th>Nama Lengkap</th>
        <th>Asal Instansi</th>
        <th>Provinsi</th>
        <th>Kabupaten</th>
        <th>Nama Diklat</th>
        <th>Tahun</th>
    </tr>
    @foreach($riwayatDiklat as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->nomor_ukg }}'</td>
            <td>{{ $row->nama_lengkap }}</td>
            <td>{{$row->nama_instansi}}</td>
            <td>{{$row->nama_provinsi}}</td>
            <td>{{$row->nama_kabupaten}}</td>
            <td>{{$row->nama_diklat}}</td>
            <td>{{$row->tahun}}</td>
        </tr>
    @endforeach
</table>
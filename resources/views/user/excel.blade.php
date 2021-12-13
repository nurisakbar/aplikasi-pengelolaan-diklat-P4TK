<table border="1">
    <thead>
        <tr>
            <th width="10">Nomor</th>
            <th>Nama Pegawai</th>
            <th>Email</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Alamat Lengkap</th>
            <th>Jabatan</th>
            <th>Lama Kerja</th>
            <th>Toko</th>
        </tr>
        
    </thead>
    <tbody>
        @foreach ($users as $row)
        <tr>
            <td style="vertical-align: top;">{{ $loop->iteration }}</td>
            <td style="vertical-align: top;">{{ $row->name }}</td>
            <td style="vertical-align: top;">{{ $row->email }}</td>
            <td style="vertical-align: top;">{{ $row->tempat_lahir }}</td>
            <td style="vertical-align: top;">{{ $row->tanggal_lahir }}</td>
            <td style="vertical-align: top;">{{ $row->alamat_lengkap}}</td>
            <td style="vertical-align: top;">{{ $row->jabatan->nama_jabatan??null }}</td>
            <td style="vertical-align: top;">{{$row->lama_kerja_dalam_bulan}} Bulan</td>
            <td style="vertical-align: top;">
                @foreach ($row->toko as $t)
                    {{ $t->nama_toko  }}
                    <br>
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
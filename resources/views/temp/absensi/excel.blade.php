<table>
        <tr>
            <th width="10">No</th>
            <th>Nama Karyawan</th>
            <th>Tanggal</th>
            <th>Status Kehadiran</th>
            <th>Keterangan</th>
        </tr>
        @foreach ($absensi as $row)
        <tr>
            <td> {{ $loop->iteration }}</td>
            <td>{{ $row->user->name }}</td>
            <td>{{ $row->tanggal }}</td>
            <td>{{ $row->status_kehadiran=='h'?'Hadir':'Tidak Hadir' }}</td>
            <td>{{ $row->keterangan }}</td>
        </tr>
        @endforeach
</table>

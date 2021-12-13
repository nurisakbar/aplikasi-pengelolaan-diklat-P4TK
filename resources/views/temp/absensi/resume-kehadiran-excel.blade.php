<table>
    <tr>
        <td>Dari Tanggal</td>
        <td> {{ $periode_awal }}</td>
    </tr>
    <tr>
        <td>Sampai Tanggal</td>
        <td> {{ $periode_akhir }}</td>
    </tr>
</table>

<table>
    <tr>
        <th>Nomor</th>
        <th>Nama Karyawan</th>
        <th>Jumlah Hadir</th>
        <th>Jumlah Tidak Hadir</th>
    </tr>
    @foreach ($users as $user)
    <tr>
        <td> {{ $loop->iteration }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ hitung_absensi($user->id,$periode_awal,$periode_akhir,'h') }}</td>
        <td>{{ hitung_absensi($user->id,$periode_awal,$periode_akhir,'t') }}</td>
    </tr>
    @endforeach
</table>
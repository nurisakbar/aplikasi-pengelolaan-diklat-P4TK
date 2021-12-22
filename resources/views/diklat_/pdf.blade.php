<style>
.table1 {
    font-family: sans-serif;
    color: #232323;
    border-collapse: collapse;
}
 
.table1, th, td {
    border: 1px solid #999;
    padding: 4px 10px;
    font-size: 12px;
    text-align: left;
}
</style>


<table class="table1">
    <tr>
        <th width="20px">NO</th>
        <th>NAMA</th>
        <th>NOMOR HP</th>
        <th>EMAIL</th>
        <th>ASAL SEKOLAH</th>
        <th>KABUPATEN</th>
        <th>PROVINSI</th>
        <th>KELAS</th>
    </tr>
    @foreach ($diklat->peserta as $peserta)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $peserta->gtk->nama_gtk }}</td>
            <td>{{ $peserta->gtk->dapodik_nomor_hp }}</td>
            <td>{{ $peserta->gtk->email_login }}</td>
            <td>{{ $peserta->gtk->asal_sekolah }}</td>
            <td>{{ $peserta->gtk->domisili_kota_kabupaten }}</td>
            <td>{{ $peserta->gtk->provinsi }}</td>
            <td>{{ $peserta->kelas->nama_kelas }}</td>
        </tr>
    @endforeach
</table>
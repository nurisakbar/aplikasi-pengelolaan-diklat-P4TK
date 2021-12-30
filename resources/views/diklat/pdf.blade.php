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
            <td>{{ $peserta->gtk->nama_lengkap }}</td>
            <td>{{ $peserta->gtk->nomor_hp }}</td>
            <td>{{ $peserta->gtk->email }}</td>
            <td>{{ $peserta->gtk->instansi->nama_instansi }}</td>
            <td>{{ $peserta->gtk->instansi->wilayahAdministratif->regency_name}}</td>
            <td>{{ $peserta->gtk->instansi->wilayahAdministratif->province_name}}</td>
            <td>{{ $peserta->kelas->nama_kelas }}</td>
        </tr>
    @endforeach
</table>
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


<div style="margin-left:-6rem;">
    <table class="table1" style="transform: scale(0.9)">
        <tr>
            <th width="20px">NO</th>
            <th>NO UKG</th>
            <th>NAMA LENGKAP</th>
            <th>USIA</th>
            <th>KELAMIN</th>
            <th>NOMOR HP</th>
            <th>KONTAK</th>
            <th>NAMA SEKOLAH</th>
            <th>NPSN SEKOLAH</th>
            <th>JENJANG SEKOLAH</th>
            <th>PROVINSI SEKOLAH</th>
            <th>PROGRAM DIKLAT</th>
            <th width="120">NAMA DIKLAT</th>
            <th>PROGRAM KEAHLIAN DIKLAT</th>
        </tr>
        @foreach ($diklat->peserta as $peserta)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $peserta->gtk->nomor_ukg }}</td>
                <td>{{ $peserta->gtk->nama_lengkap }}</td>
                <td>{{ hitung_umur($peserta->gtk->tanggal_lahir) }}</td>
                <td>{{ $peserta->gtk->jenis_kelamin }}</td>
                <td>{{ $peserta->gtk->nomor_hp }}</td>
                <td>{{ $peserta->gtk->email }}</td>
                <td>{{ $peserta->gtk->instansi->nama_instansi }}</td>
                <td>{{ $peserta->gtk->instansi->npsn }}</td>
                <td>{{ substr($peserta->gtk->instansi->nama_instansi, 0, 3) == "SMK" ? "SMK" : "-" }}</td>
                <td>{{ $peserta->gtk->instansi->wilayahAdministratif->province_name}}</td>
                <td>{{ $peserta->kelas->nama_kelas }}</td>
                <td>{{ $diklat->kategori->nama_kategori }}</td>
                <td>{{ $diklat->programKeahlian->nama_program_keahlian }}</td>
            </tr>
        @endforeach
    </table>
</div>

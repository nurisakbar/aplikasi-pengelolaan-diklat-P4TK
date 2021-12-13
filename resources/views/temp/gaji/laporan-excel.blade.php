<table class="table table-bordered" id="users-table">
    <thead>
        <tr>
            <th width="10">No</th>
            <th>Periode</th>
            <th>Nama Pegawai</th>
            <th>Jabatan</th>
            <th>Lama Bekerja</th>
            <th>Total Hadir</th>
            <th>Gaji Pokok</th>
            <th>Tunjangan Jabatan</th>
            <th>Bonus</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $total_gaji = 0; ?>
        @foreach($gaji as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $periode }}</td>
            <td>{{ $row->user->name }}</td>
            <td>{{ $row->user->jabatan->nama_jabatan }}</td>
            <td>{{ lama_kerja($row->user->tanggal_mulai_bekerja, $row->periode_gaji . '-01') . ' Bulan' }}</td>
            <td>{{ hitung_absensi($row->user_id, $row->periode_gaji . '-01', $row->periode_gaji . '-31', 'h')}}</td>
            <?php 
            $gaji_pokok = laporan_gaji_gaji_pokok($row);
            $bonus = laporan_gaji_bonus($row);
            $tunjangan_jabatan = laporan_gaji_tunjangan_jabatan($row);
            $total = $gaji_pokok+$bonus+$tunjangan_jabatan;
            $total_gaji = $total_gaji + $total;
            ?>
            <td>{{ $gaji_pokok}}</td>
            <td>{{ $tunjangan_jabatan}}</td>
            <td>{{ $bonus}}</td>
            <td>{{ $total }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr class="text-right font-weight-bold">
            <td colspan="8" style="text-align: right;font-weight:bold">Total Gaji</td>
            <td colspan="2">{{ $total_gaji }}</td>
        </tr>
    </tfoot>
</table>
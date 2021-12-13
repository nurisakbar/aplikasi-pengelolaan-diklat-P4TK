<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Toko</th>
        <th>Nomor Pesanan</th>
        <th>Nama Pembeli</th>
        <th>Nomor HP</th>
        <th>Uang Masuk</th>
        <th>Ongkir</th>
        <th>Uang Belanja Ke Supplier</th>
        <th>Ongkir Belanja Ke Supplier</th>
        <th>Dana Cair</th>
        <th>Profit</th>
        <th>Komisi 1%</th>
        <th>Akun Belanja</th>
        <th>Status</th>
        <th>Supplier Dari</th>
        <th>Nomor Pesanan</th>
        <th>Nomor Resi Sementara</th>
        <th>Nomor Resi Asli</th>
        <th>Sudah WA Konfirmasi</th>
        <th>Catatan</th>
    </tr>
    @foreach ($penjualan as $row)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ date_format(date_create($row->tanggal),"d/m/Y")}}</td>
        <td>{{ $row->toko->nama_toko }}</td>
        <td>{{ $row->nomor_pesanan }}</td>
        <td>{{ $row->nama_pembeli }}</td>
        <td>{{ $row->nomor_hp }}</td>
        <td>{{ number_format($row->uang_masuk,2,',','.') }}</td>
        <td>{{ number_format($row->ongkir_customer,2,',','.')}}</td>
        <td>{{ number_format($row->uang_belanja_ke_supplier,2,',','.')}}</td>
        <td>{{ number_format($row->ongkir_supplier,2,',','.')}}</td>
        <td>{{ number_format($row->dana_cair,2,',','.')}}</td>
        <td>{{ number_format($row->komisi,2,',','.')}}</td>
        <td>{{ number_format($row->profit,2,',','.')}}</td>
        <td>{{ $row->akun_belanja}}</td>
        <td>{{ $row->status}}</td>
        <td>{{ $row->supplier}}</td>
        <td>{{ $row->nomor_pesanan_beli_ke_supplier}}</td>
        <td>{{ $row->nomor_resi_sementara}}</td>
        <td>{{ $row->nomor_resi_asli}}</td>
        <td>{{ $row->status_wa}}</td>
        <td>{{ $row->catatan}}</td>
    </tr>
    @endforeach
</table>
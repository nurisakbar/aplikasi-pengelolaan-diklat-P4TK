<table>
    <tr>
        <th>Nomor</th>
        <th>Tanggal</th>
        <th>Profit</th>
    </tr>
    @foreach ($laporan_profit as $row)
    <tr>
        <td> {{ $loop->iteration }}</td>
        <td> {{ date_format(date_create($row->tanggal),"d/m/Y")}}</td>
        <td> {{ number_format($row->profit,2,',','.') }}</td>
    </tr>
    @endforeach
</table>
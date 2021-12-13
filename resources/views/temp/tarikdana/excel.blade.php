<table>
    <tr>
        <th rowspan="2">Nomor</th>
        <th rowspan="2">Nama Toko</th>
        <th rowspan="2">Email Toko</th>
        <th style="text-align: center" colspan="{{ count($list_senin)}}">Tarik Dana Hari Senin</th>
        <th>Total</th>
    </tr>
    <tr>
        @foreach ($list_senin as $tanggal)
            <th>{{ date_format(date_create($tanggal),"d/m/Y")}}</th>
        @endforeach
    </tr>
    @foreach ($tarikdana as $row)
    <?php
    $total= 0 ;
    ?>
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $row->nama_toko}}</td>
        <td>{{ $row->email}}</td>
        @foreach ($list_senin as $tanggal)
        <?php 
        $jumlah = \App\TarikDana::where('toko_id',$row->id)
                    ->where('tanggal',$tanggal)
                    ->first()->jumlah??0;
        $total = $total+$jumlah;
        ?>
            <td>{{ $jumlah }}</td>
        @endforeach
        <td>{{ $total }}</td>
    </tr>
    @endforeach
</table>


<table>
    <tr>
        <th rowspan="2">Nomor</th>
        <th rowspan="2">Nama Toko</th>
        <th rowspan="2">Email Toko</th>
        <th style="text-align: center" colspan="{{ count($list_kamis)}}">Tarik Dana Hari Kamis</th>
        <th>Total</th>
    </tr>
    <tr>
        @foreach ($list_kamis as $tanggal)
            <th>{{ date_format(date_create($tanggal),"d/m/Y")}}</th>
        @endforeach
    </tr>
    @foreach ($tarikdana as $row)
    <?php
    $total= 0 ;
    ?>
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $row->nama_toko}}</td>
        <td>{{ $row->email}}</td>
        @foreach ($list_kamis as $tanggal)
        <?php 
        $jumlah = \App\TarikDana::where('toko_id',$row->id)
                    ->where('tanggal',$tanggal)
                    ->first()->jumlah??0;
        $total = $total+$jumlah;
        ?>
            <td>{{ $jumlah }}</td>
        @endforeach
        <td>{{ $total }}</td>
    </tr>
    @endforeach
</table>
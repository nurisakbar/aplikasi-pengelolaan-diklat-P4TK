<table class="table table-bordered" id="example">
    <thead>
        <tr>
            <th width="10">No</th>
            <th>Nama Karyawan</th>
            <th>Total Omset</th>
            <th>Total Profit</th>
            <th>Total Bonus</th>
        </tr>
    </thead>
    <?php
    $total_omset    =   0;
    $total_bonus    =   0;
    $total_profit   =   0;
    ?>
    <tbody>
        @foreach($users as $user)

        <?php
        $omset = $user->omset??0;
        $total_omset = $total_omset + $omset;

        $profit = $user->profit??0;
        $total_profit = $total_profit + $profit;

        $bonus = hitungBonusByProfit($profit);
        $total_bonus = $total_bonus + $bonus;
        ?>
        <tr>
            <td> {{ $loop->iteration }}</td>
            <td> {{ $user->name }}</td>
            <td> {{ $omset }}</td>
            <td> {{ $profit }}</td>
            <td> {{ $bonus }}</td>
        </tr>

        @endforeach
    </tbody>
    <tfoot>
        <tr class="text-right font-weight-bold">
            <td colspan="2"></td>
            <td>Total Omset : {{ $total_omset }}</td>
            <td>Total Profit : {{ $total_profit }}</td>
            <td>Total Bonus : {{ $total_bonus }}</td>
        </tr>
        <tr class="text-right font-weight-bold">
            <td colspan="3"></td>
            <td>Total Profit - Total Bonus</td>
            <td> {{ $total_profit - $total_bonus }}</td>
        </tr>
    </tfoot>
</table>
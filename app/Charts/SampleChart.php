<?php

declare(strict_types=1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Penjualan;

class SampleChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $penjualan = Penjualan::select('users.name as name', \DB::raw("COUNT(*) as count"))
        ->whereBetween('penjualan.tanggal', [$request->periode_awal,$request->periode_akhir])
        ->groupBy('user_id')
        ->leftJoin('users', 'users.id', 'penjualan.user_id')
        ->get();

        $nama = [];
        $total = [];
        foreach ($penjualan as $row) {
            array_push($nama, $row->name);
            array_push($total, $row->count);
        }

        return Chartisan::build()
            ->labels($nama)
            ->dataset('Karyawan ', $total);
    }
}

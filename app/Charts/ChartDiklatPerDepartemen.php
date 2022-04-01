<?php

declare(strict_types=1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class ChartDiklatPerDepartemen extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $data = \DB::select("select d.nama_departemen, count(dk.id) as jumlah_diklat
        from departemen as d left join diklat as dk on dk.departemen_id=d.id
        group by d.id");


        $labels = [];
        $dataSet = [];
        foreach ($data as $row) {
            array_push($labels, $row->nama_departemen);
            array_push($dataSet, $row->jumlah_diklat);
        }
        return Chartisan::build()
            ->labels($labels)
            ->dataset('Sample', $dataSet);
    }
}

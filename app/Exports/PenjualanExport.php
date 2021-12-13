<?php

namespace App\Exports;

use App\Penjualan;
use Auth;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\ProfitHarianExport;
use App\Exports\PenjualanExportHistory;

class PenjualanExport implements WithMultipleSheets
{
    public $periode_awal;
    public $periode_akhir;

    public function __construct($periode_awal, $periode_akhir)
    {
        $this->periode_awal = $periode_awal;
        $this->periode_akhir = $periode_akhir;
    }
    /**
    * @return \Illuminate\Support\Collection
    */


    public function sheets(): array
    {
        return [
            new PenjualanExportHistory($this->periode_awal, $this->periode_akhir),
            new ProfitHarianExport($this->periode_awal, $this->periode_akhir)
        ];
    }
}

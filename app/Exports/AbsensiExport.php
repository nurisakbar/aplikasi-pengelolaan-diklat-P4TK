<?php

namespace App\Exports;

use App\Penjualan;
use Auth;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\AbsensiHistory;
use App\Exports\AbsensiLog;

class AbsensiExport implements WithMultipleSheets
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
            new AbsensiLog($this->periode_awal, $this->periode_akhir),
            new AbsensiHistory($this->periode_awal, $this->periode_akhir)
        ];
    }
}

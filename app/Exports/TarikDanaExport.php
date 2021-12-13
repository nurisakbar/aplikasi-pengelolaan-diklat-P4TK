<?php

namespace App\Exports;

use App\TarikDana;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Auth;
use App\Toko;

class TarikDanaExport implements FromView, ShouldAutoSize
{
    public $periode;

    public function __construct($periode)
    {
        $this->periode = $periode;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $list_senin   =   array();
        $list_kamis   =   array();
        $month  =   substr($this->periode, 5, 2);
        $year   =   substr($this->periode, 0, 4);

        for ($d = 1; $d <= 31; $d++) {
            $time = mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time) == $month) {
                if (in_array(date('D', $time), ['Mon'])) {
                    $list_senin[] = date('Y-m-d', $time);
                } elseif (in_array(date('D', $time), ['Thu'])) {
                    $list_kamis[] = date('Y-m-d', $time);
                }
            }
        }

        $toko = Toko::with('user');

        if (Auth::user()->level != 'administrator') {
            $toko = $toko->where('user_id', Auth::user()->id);
        }


        $data['list_senin']     = $list_senin;
        $data['list_kamis']     = $list_kamis;
        $data['tarikdana']      = $toko->get();
        return view('tarikdana.excel', $data);
    }
}

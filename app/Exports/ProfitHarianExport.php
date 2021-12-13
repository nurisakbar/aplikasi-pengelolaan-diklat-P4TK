<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithTitle;
use Auth;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ProfitHarianExport implements FromView, ShouldAutoSize, WithTitle, WithEvents
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

    public function title(): string
    {
        return 'Profit Harian';
    }

    public function registerEvents(): array
    {
        if (Auth::user()->level != 'administrator') {
            $profit = \DB::select("select tanggal, 
            sum(0.01* uang_masuk) as komisi,
            sum((uang_masuk+ongkir_customer) - (uang_belanja_ke_supplier+ongkir_supplier+0.01* uang_masuk)) as profit
            from penjualan
            where user_id='" . Auth::user()->id . "'
            and tanggal between '" . $this->periode_awal . "' and '" . $this->periode_akhir . "'
            group by tanggal");
        } else {
            $profit = \DB::select("select tanggal, 
            sum(0.01* uang_masuk) as komisi,
            sum((uang_masuk+ongkir_customer) - (uang_belanja_ke_supplier+ongkir_supplier+0.01* uang_masuk)) as profit
            from penjualan
            where tanggal between '" . $this->periode_awal . "' and '" . $this->periode_akhir . "'
            group by tanggal");
        }

        $jumlahRow = count($profit) + 1;

        return [
            AfterSheet::class    => function (AfterSheet $event) use ($jumlahRow) {
                $cellRange = 'A1:C1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10)->setBold(true);

                $event->sheet->getStyle('A1:C' . $jumlahRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }

    public function view(): View
    {
        if (Auth::user()->level != 'administrator') {
            $profit = \DB::select("select tanggal, 
            sum(0.01* uang_masuk) as komisi,
            sum((uang_masuk+ongkir_customer) - (uang_belanja_ke_supplier+ongkir_supplier+0.01* uang_masuk)) as profit
            from penjualan
            where user_id='" . Auth::user()->id . "'
            and tanggal between '" . $this->periode_awal . "' and '" . $this->periode_akhir . "' 
            group by tanggal");
        } else {
            $profit = \DB::select("select tanggal, 
            sum(0.01* uang_masuk) as komisi,
            sum((uang_masuk+ongkir_customer) - (uang_belanja_ke_supplier+ongkir_supplier+0.01* uang_masuk)) as profit
            from penjualan
            where tanggal between '" . $this->periode_awal . "' and '" . $this->periode_akhir . "'
            group by tanggal");
        }
        $data['laporan_profit'] = $profit;
        return view('penjualan.profit-harian', $data);
    }
}

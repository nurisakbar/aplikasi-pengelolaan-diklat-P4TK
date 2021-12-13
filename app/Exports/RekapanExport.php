<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Auth;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\User;

class RekapanExport implements FromView, ShouldAutoSize, WithTitle, WithEvents
{
    public $periode_awal;
    public $periode_akhir;

    public function __construct($periode_awal, $periode_akhir)
    {
        $this->periode_awal = $periode_awal;
        $this->periode_akhir = $periode_akhir;
    }

    public function title(): string
    {
        return 'Laporan Rekapan';
    }

    public function registerEvents(): array
    {

        $jmlRow = User::count();

        return [
            AfterSheet::class    => function (AfterSheet $event) use ($jmlRow) {
                $cellRange = 'A1:E1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10)->setBold(true);
                $event->sheet->getStyle('A1:E' . ($jmlRow + 1))->applyFromArray([
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

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $sql = "select 
        u.name,
        sum(profit) as profit,
        (sum(p.uang_masuk+p.ongkir_customer)-sum(jumlah_komisi)) as omset
        from penjualan as p
        right join users as u on u.id=p.user_id 
        and  p.tanggal between '" . $this->periode_awal . "' and '" . $this->periode_akhir . "'
        group by u.name";
        $data['users']  = \DB::select($sql);

        return view('rekapan.table', $data);
    }
}

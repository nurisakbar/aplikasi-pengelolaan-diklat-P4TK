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
use App\Gaji;

class LaporanGajiExport implements FromView, ShouldAutoSize, WithTitle, WithEvents
{
    public $periode;

    public function __construct($periode)
    {
        $this->periode = $periode;
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function title(): string
    {
        return 'Laporan Gaji';
    }

    public function registerEvents(): array
    {

        $jumlahRow = Gaji::with('user.jabatan')->where('periode_gaji', $this->periode)->count() + 1;

        return [
            AfterSheet::class    => function (AfterSheet $event) use ($jumlahRow) {
                $cellRange = 'A1:J1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10)->setBold(true);

                $event->sheet->getStyle('A1:J' . ($jumlahRow - 1))->applyFromArray([
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
        $data['gaji']  = Gaji::with('user.jabatan')
        ->where('periode_gaji', $this->periode)
        ->whereHas('user', function ($query) {
            return $query->where('level', '!=', 'administrator');
        })
        ->get();
        $data['periode'] = $this->periode;
        return view('gaji.laporan-excel', $data);
    }
}

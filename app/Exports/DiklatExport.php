<?php

namespace App\Exports;

use App\Diklat;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DiklatExport extends DefaultValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder, WithEvents
{
    public $diklat_id;

    public function __construct($diklat_id)
    {
        $this->diklat_id = $diklat_id;
    }

    public function view(): View
    {
        $data['diklat'] = Diklat::with('peserta.gtk.instansi.wilayahAdministratif', 'peserta.kelas', 'kategori', 'programKeahlian')->findOrFail($this->diklat_id);
        return view('diklat.cetak-laporan-diklat-excel', $data);
    }

    public function registerEvents(): array
    {
        $jmlData = \App\DiklatPeserta::where('diklat_id', '=', $this->diklat_id)
                    ->where('status_kehadiran', 'Peserta')
                    ->count() + 1;
        return [
            AfterSheet::class    => function (AfterSheet $event) use ($jmlData) {
                $cellRange = 'A1:P1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10)->setBold(true);

                $event->sheet->getStyle('A1:P' . $jmlData)->applyFromArray([
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
}

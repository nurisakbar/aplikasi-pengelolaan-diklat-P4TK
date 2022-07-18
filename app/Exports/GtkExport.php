<?php

namespace App\Exports;

use App\ViewGtk;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class GtkExport extends DefaultValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder, WithEvents
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $data['gtk'] = $this->data();
        return view('gtk.excel', $data);
    }

    public function data()
    {
        $data = ViewGtk::query();

        if ($this->request['provinsi'] != null) {
            $data->where('instansi_province_id', $this->request['provinsi']);
        }

        if ($this->request['regency_id'] != null) {
            $data->where('instansi_regency_id', $this->request['regency_id']);
        }

        if ($this->request['nama_gtk']) {
            $searchName = $this->request['nama_gtk'];
            $data->where('nama_lengkap', 'like', '%' . $searchName . '%');
        }

        if ($this->request['nama_instansi']) {
            $searchByNameInstansi = $this->request['nama_instansi'];
            $clearStatusInstansi = str_replace(['SMK N ','SMK ','NEGERI ','SMKN'], ['','','',''], strtoupper($searchByNameInstansi));
            $data->where('nama_instansi', 'like', '%' . $clearStatusInstansi . '%');
        }

        return $data->get();
    }

    public function registerEvents(): array
    {
        $jmlData = count($this->data()) + 1;
        return [
            AfterSheet::class    => function (AfterSheet $event) use ($jmlData) {
                $cellRange = 'A1:H1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10)->setBold(true);

                $event->sheet->getStyle('A1:H' . $jmlData)->applyFromArray([
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

<?php

namespace App\Exports;

use App\Instansi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\InstansiKeahlian;

class InstansiExport extends DefaultValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder, WithEvents
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $data['instansi'] = $this->data();
        return view('instansi.excel', $data);
    }

    public function data()
    {
        $data = Instansi::query();

        if ($this->request['provinsi'] != null) {
            $data->where('province_id', $this->request['provinsi']);
        }

        if ($this->request['regency_id'] != null) {
            $data->where('regency_id', $this->request['regency_id']);
        }

        if ($this->request['nama_instansi']) {
            $searchByNameInstansi = $this->request['nama_instansi'];
            $clearStatusInstansi = str_replace(['SMK N ','SMK ','NEGERI ','SMKN'], ['','','',''], strtoupper($searchByNameInstansi));
            $data->where('nama_instansi', 'like', '%' . $clearStatusInstansi . '%');
        }

        if ($this->request['kompetensi_keahlian_id'] != null) {
            $instansiKeahlian = InstansiKeahlian::select('instansi_id')->where('kompetensi_keahlian_id', $request->kompetensi_keahlian_id)->get();
            $items->whereIn('instansi.id', $instansiKeahlian);
        }

        return $data->get();
    }

    public function registerEvents(): array
    {
        $jmlData = count($this->data()) + 1;
        return [
            AfterSheet::class    => function (AfterSheet $event) use ($jmlData) {
                $cellRange = 'A1:G1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10)->setBold(true);

                $event->sheet->getStyle('A1:G' . $jmlData)->applyFromArray([
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

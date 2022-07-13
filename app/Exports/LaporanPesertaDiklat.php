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

class LaporanPesertaDiklat extends DefaultValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder, WithEvents
{
    public $request;
    public function __construct($request)
    {
        $this->request = $request;
        \Log::info($this->request);
    }

    public function view(): View
    {
        $data['riwayatDiklat'] = $this->data();
        return view('diklat.laporan-peserta-diklat-excel', $data);
    }

    public function registerEvents(): array
    {
        $jmlData  = count($this->data()) + 1;
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


    public function data()
    {
        $filter_nama_diklat     = "";
        $filter_tahun           = "";
        $filter_nama_gtk        = "";
        $filter_nama_instansi   = "";
        $filter_provinsi        = "";
        $filter_kabupaten       = "";

        if (!in_array($this->request['nama_diklat'], ['undefined',null])) {
            $filter_nama_diklat = "and d.nama_diklat like '%" . $this->request['nama_diklat'] . "%'";
        }

        if (!in_array($this->request['nama_gtk'], ['undefined',null])) {
            $filter_nama_gtk = "and gt.nama_lengkap like '%" . $this->request['nama_gtk'] . "%'";
        }

        if (!in_array($this->request['tahun'], ['undefined',null])) {
            $filter_tahun = "and d.tahun='" . $this->request['tahun'] . "'";
        }


        if (!in_array($this->request['nama_instansi'], ['undefined',null])) {
            $filter_nama_instansi = "and i.nama_instansi like '%" . $this->request['nama_instansi'] . "%'";
        }

        if (!in_array($this->request['provinsi'], ['undefined',null])) {
            $filter_provinsi  = "and i.province_id='" . $this->request['provinsi'] . "'";
        }

        if (isset($this->request['regency_id'])) {
            if (!in_array($this->request['regency_id'], ['undefined',null])) {
                $filter_kabupaten = "and i.regency_id='" . $this->request['regency_id'] . "'";
            }
        }

        $status = $this->request['status'] == 'peserta' ? 'Peserta' : 'Pendaftar';

        return \DB::select("
        select gt.nama_lengkap,
        gt.nik,
        gt.nomor_ukg,
        d.nama_diklat,
        d.tahun,
        i.nama_instansi,
        p.name as nama_provinsi,
        r.name as nama_kabupaten
        from diklat_peserta as dp join gtk as gt on gt.id=dp.peserta_id and dp.status_kehadiran='" . $status . "' $filter_nama_gtk 
        join diklat as d on d.id=dp.diklat_id $filter_nama_diklat $filter_tahun
        join instansi as i on i.id=gt.instansi_id $filter_nama_instansi
        join provinces as p on p.id=i.province_id $filter_provinsi
        join regencies as r on i.regency_id=r.id $filter_kabupaten");
    }
}

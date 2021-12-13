<?php

namespace App\Exports;

use App\Penjualan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Auth;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PenjualanExportHistory implements FromView, ShouldAutoSize, WithTitle, WithEvents
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
        return 'Laporan Penjualan';
    }

    public function registerEvents(): array
    {
        $penjualan = Penjualan::orderBy('tanggal', 'ASC')->whereBetween('tanggal', [$this->periode_awal,$this->periode_akhir]);
        if (Auth::user()->level != 'administrator') {
            $penjualan = $penjualan->where('user_id', Auth::user()->id);
        }
        $jumlahRowPenjualan = $penjualan->count() + 1;

        return [
            AfterSheet::class    => function (AfterSheet $event) use ($jumlahRowPenjualan) {
                $cellRange = 'A1:U1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10)->setBold(true);
                $event->sheet->getStyle('A1:U' . $jumlahRowPenjualan)->applyFromArray([
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
        $penjualan = Penjualan::orderBy('tanggal', 'ASC')->whereBetween('tanggal', [$this->periode_awal,$this->periode_akhir]);
        if (Auth::user()->level != 'administrator') {
            $penjualan = $penjualan->where('user_id', Auth::user()->id);
        }
        return view('penjualan.excel', [
            'penjualan' => $penjualan->get()
        ]);
    }
}

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
use App\Jabatan;
use App\User;
use App\Absensi;

class AbsensiHistory implements FromView, ShouldAutoSize, WithTitle, WithEvents
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
        return 'Laporan Kehadiran';
    }

    public function registerEvents(): array
    {
        if (Auth::user()->level != 'administrator') {
            $leader_jabatan_id      = Auth::user()->jabatan_id;
            $jabatan_id_kelompok    = Jabatan::where('jabatan_id', $leader_jabatan_id)->first();
            $users                  = User::where('jabatan_id', $jabatan_id_kelompok->id)->count();
        } else {
            $users = User::count();
        }

        return [
            AfterSheet::class    => function (AfterSheet $event) use ($users) {
                $cellRange = 'A4:U4'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10)->setBold(true);
                $event->sheet->getStyle('A4:D' . ($users + 4))->applyFromArray([
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
        if (Auth::user()->level != 'administrator') {
            $leader_jabatan_id      = Auth::user()->jabatan_id;
            $jabatan_id_kelompok    = Jabatan::where('jabatan_id', $leader_jabatan_id)->first();
            $users                  = User::where('jabatan_id', $jabatan_id_kelompok->id)->get();
        } else {
            $users = User::all();
        }

        return view('absensi.resume-kehadiran-excel', [
            'periode_awal' => $this->periode_awal,
            'periode_akhir' => $this->periode_akhir,
            'users' => $users
        ]);
    }
}

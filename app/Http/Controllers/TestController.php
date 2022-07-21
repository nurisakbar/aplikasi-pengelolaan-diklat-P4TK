<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instansi;
use App\KompetensiKeahlian;
use App\BidangKeahlian;
use App\ProgramKeahlian;
use App\InstansiKeahlian;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    public function upload()
    {
        $filePath = "Gabungan_Master_SMK.xlsx";
        $reader = ReaderEntityFactory::createXLSXReader();
        $reader->open($filePath);
        ini_set('max_execution_time', 0);

        foreach ($reader->getSheetIterator() as $sheet) {
            $nomor = 1;
            foreach ($sheet->getRowIterator() as $row) {
                    $cells          = $row->getCells();
                    $npsn           = $cells[1]->getValue();
                    $nama_sekolah   = $cells[2]->getValue();
                    // return $nama_sekolah;
                    $instansi       = Instansi::where('nama_instansi', $nama_sekolah)->first();
                if (!empty($cells[6]->getValue())) {
                    $bidang         = BidangKeahlian::firstOrCreate(['nama_bidang_keahlian' => $cells[6]->getValue()], ['nama_bidang_keahlian' => $cells[6]->getValue()]);
                    $program        = ProgramKeahlian::firstOrCreate(['nama_program_keahlian' => $cells[7]->getValue(),'bidang_keahlian_id' => $bidang->id], ['nama_program_keahlian' => $cells[7]->getValue(),'bidang_keahlian_id' => $bidang->id]);
                    $kompetensi     = kompetensiKeahlian::firstOrCreate(['nama_kompetensi_keahlian' => $cells[8]->getValue(),'program_keahlian_id' => $program->id], ['nama_kompetensi_keahlian' => $cells[7]->getValue(),'program_keahlian_id' => $program->id]);

                    \Log::info($nama_sekolah);
                    \Log::info($cells[6]);
                    \Log::info($cells[0]);
                    if ($instansi != null) {
                        InstansiKeahlian::create(['instansi_id' => $instansi->id,'kompetensi_keahlian_id' => $kompetensi->id]);
                    }
                }
            }
        }
    }


    public function perbaikanTanggalLahir()
    {
        ini_set('max_execution_time', 0);
        foreach (\App\Gtk::all() as $row) {
            if ($row->nik != '') {
                $nik = $row->nik;
                $tanggal = substr($nik, 6, 2) > 40 ? substr($nik, 6, 2) - 40 : substr($nik, 6, 2);
                $bulan = substr($nik, 8, 2);
                $tahun = '19' . substr($nik, 10, 2);
                $tanggal_lahir = $tahun . '-' . $bulan . '-' . $tanggal;
                $gtk = Gtk::find($row->id)->update(['tanggal_lahir',$tanggal_lahir]);
            }
        }
    }
}

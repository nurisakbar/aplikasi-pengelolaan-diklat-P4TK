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

class DiklatExport extends DefaultValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder
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
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Diklat;
use App\Gtk;
use App\Instansi;
use App\DiklatPeserta;
use App\JumlahDiklatPertahun;

class ApiController extends Controller
{
    public function infoUmum()
    {
        $response = [
            'jumlah_gtk'        =>  Gtk::count(),
            'jumlah_sekolah'    =>  Instansi::count(),
            'jumlah_diklat'     =>  Diklat::where('status_aktif', 'Aktif')->count()
        ];
        return response()->json($response, 200);
    }

    public function jumlahPesertaDiklatPertahun(Request $request)
    {

        // $response['data'] = JumlahDiklatPertahun::select('tahun','jumlah_peserta')->get();
        // return $response;
        return JumlahDiklatPertahun::pluck('jumlah_peserta', 'tahun', 'tahun');

        $sql = \DB::select("select d.tahun,count(dp.peserta_id) as jumlah_peserta
        from diklat_peserta as dp join diklat as d on d.id=dp.diklat_id
        where dp.status_kehadiran='Peserta'
        group by d.tahun");

        $result = [];

        foreach ($sql as $row) {
            $result[] = ['tahun' => $row->tahun,'jumlah_peserta' => $row->jumlah_peserta];
        }

        //$sql = DiklatPeserta::select('diklat.tahun')->join('diklat','diklat.id','diklat_peserta.diklat_id')->groupBy('diklat.tahun')->sum('diklat_peserta.peserta_id');


        return response()->json($result, 200);
    }
}

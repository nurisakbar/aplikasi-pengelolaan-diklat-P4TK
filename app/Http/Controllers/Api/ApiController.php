<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Diklat;
use App\Gtk;
use App\Instansi;
use App\DiklatPeserta;
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

    public function jumlahPesertaDiklatPertahun(Request $request){
        $sql = \DB::select("select d.tahun,count(dp.peserta_id) as jumlah_peserta
        from diklat_peserta as dp join diklat as d on d.id=dp.diklat_id
        where dp.status_kehadiran='Peserta'
        group by d.tahun");

        //$sql = DiklatPeserta::select('diklat.tahun')->join('diklat','diklat.id','diklat_peserta.diklat_id')->groupBy('diklat.tahun')->sum('diklat_peserta.peserta_id');


        return response()->json($sql, 200);
    }
}

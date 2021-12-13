<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Exports\RekapanExport;
use Maatwebsite\Excel\Facades\Excel;

class RekapanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data['periode_awal'] = $request->periode_awal == null ? date('Y-m-d') : $request->periode_awal;
        $data['periode_akhir'] = $request->periode_akhir == null ? date('Y-m-d') : $request->periode_akhir;
        if ($request->has('button')) {
            if ($request->button == 'excel') {
                return Excel::download(new RekapanExport($data['periode_awal'], $data['periode_akhir']), 'laporan-rekap.xlsx');
            }
        }
        $sql = "select 
        u.name,
        sum(profit) as profit,
        (sum(p.uang_masuk+p.ongkir_customer)-sum(jumlah_komisi)) as omset
        from penjualan as p
        right join users as u on u.id=p.user_id 
        and  p.tanggal between '" . $data['periode_awal'] . "' and '" . $data['periode_akhir'] . "'
        group by u.name";
        $data['users']  = \DB::select($sql);
        return view('rekapan.index', $data);
    }
}

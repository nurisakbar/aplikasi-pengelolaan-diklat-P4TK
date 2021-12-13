<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home(Request $request)
    {
        $data['periode_awal'] = $request->periode_awal == null ? date('Y-m-d') : $request->periode_awal;
        $data['periode_akhir'] = $request->periode_akhir == null ? date('Y-m-d') : $request->periode_akhir;
        return view('home', $data);
    }
}

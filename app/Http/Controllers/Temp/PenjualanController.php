<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PenjualanCreateRequest;
use App\Toko;
use App\Penjualan;
use Auth;
use App\Exports\PenjualanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class PenjualanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $data['periode_awal'] = $request->periode_awal == null ? date('Y-m-d') : $request->periode_awal;
        $data['periode_akhir'] = $request->periode_akhir == null ? date('Y-m-d') : $request->periode_akhir;
        $penjualan = Penjualan::with('toko.user')
                    ->whereBetween('tanggal', [$data['periode_awal'],$data['periode_akhir']]);

        if (Auth::user()->level != 'administrator') {
            $penjualan = $penjualan->where('user_id', Auth::user()->id);
        }

        if ($request->ajax()) {
            return \DataTables::of($penjualan->get())
            ->addColumn('action', function ($row) {
                $btn = '';
                if (Auth::user()->level == 'administrator') {
                    $btn = \Form::open(['url' => 'penjualan/' . $row->id, 'method' => 'DELETE','style' => 'float:right;margin-right:5px']);
                    $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                    $btn .= \Form::close();
                }

                $btn .= '<a class="btn btn-danger btn-sm" href="/penjualan/' . $row->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a>';
                return $btn;
            })
            ->addColumn('tanggal', function ($row) {
                return date_format(date_create($row->tanggal), "d/m/Y");
            })
            ->addColumn('komisi', function ($row) {

                return $row->komisi;
            })
            ->addColumn('profit', function ($row) {
                return $row->profit;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        if ($request->has('button')) {
            if ($request->button == 'excel') {
                return Excel::download(new PenjualanExport($data['periode_awal'], $data['periode_akhir']), 'laporan-penjualan.xlsx');
            }
        }

        return view('penjualan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['toko']   = Toko::where('user_id', Auth::user()->id)->pluck('nama_toko', 'id');
        $data['status'] = $this->status();
        $data['statusWa'] = $this->statusWa();
        return view('penjualan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenjualanCreateRequest $request)
    {
        $request['user_id'] = Auth::user()->id;
        $penjualan = Penjualan::create($request->all());
        $this->hitungProfitDanKomisi($penjualan->id);
        \Session::flash('message', 'Data penjualan Berhasil Disimpan');
        return redirect('penjualan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->level != 'administrator') {
            $data['toko']       = Toko::where('user_id', Auth::user()->id)->pluck('nama_toko', 'id');
        } else {
            $data['toko']       = Toko::pluck('nama_toko', 'id');
        }

        $data['penjualan']  = Penjualan::findOrFail($id);
        $data['status']     = $this->status();
        $data['statusWa'] = $this->statusWa();
        return view('penjualan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);
        if ($request->status == 'Batal') {
            $request['ongkir_customer'] = 0;
            $request['uang_masuk'] = 0;
            $request['ongkir_supplier'] = 0;
            $request['uang_belanja_ke_supplier'] = 0;
        } elseif ($request->status == 'Return') {
            $request['ongkir_customer'] = 0;
            $request['uang_masuk'] = 0;
        } elseif ($request->status == 'Piutang') {
            $request['ongkir_customer'] = 0;
            $request['uang_masuk'] = 0;
        } elseif ($request->status == 'Rugi') {
            $request['ongkir_customer'] = 0;
            $request['uang_masuk'] = 0;
        } else {
        }

        $penjualan->update($request->all());
        $this->hitungProfitDanKomisi($id);

        \Session::flash('message', 'successfully updated Penjualan');
        return redirect('penjualan/' . $id . '/edit');
    }



    public function hitungProfitDanKomisi($id)
    {
        $penjualan      = Penjualan::findOrFail($id);
        $komisi         = 0.01 * $penjualan->uang_masuk;

        if ($penjualan->status == 'Refund') {
            $profit = (($penjualan->uang_masuk - $penjualan->total_refund) + $penjualan->ongkir_customer) - ($penjualan->uang_belanja_ke_supplier + $penjualan->ongkir_supplier + (0.01 * $penjualan->uang_masuk));
        } elseif ($penjualan->status == 'Piutang') {
            $profit = (($penjualan->uang_masuk - $penjualan->total_piutang) + $penjualan->ongkir_customer) - ($penjualan->uang_belanja_ke_supplier + $penjualan->ongkir_supplier + (0.01 * $penjualan->uang_masuk));
        } elseif ($penjualan->status == 'Rugi') {
            $profit = (($penjualan->uang_masuk - $penjualan->total_rugi) + $penjualan->ongkir_customer) - ($penjualan->uang_belanja_ke_supplier + $penjualan->ongkir_supplier + (0.01 * $penjualan->uang_masuk));
        } else {
            $profit = ($penjualan->uang_masuk + $penjualan->ongkir_customer) - ($penjualan->uang_belanja_ke_supplier + $penjualan->ongkir_supplier + (0.01 * $penjualan->uang_masuk));
        }

        $penjualan->update(['jumlah_komisi' => $komisi,'profit' => $profit]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Penjualan = Penjualan::findOrFail($id);
        $Penjualan->delete();
        \Session::flash('message', 'successfully deleted Penjualan');
        return redirect('penjualan');
    }

    public function status()
    {
        return [
            'Belum'         =>  'Belum',
            'Refund'        =>  'Refund',
            'Return'        =>  'Return',
            'Resi Error'    =>  'Resi Error',
            'Batal'         =>  'Batal',
            'Rugi'          =>  'Rugi',
            'Process'       =>  'Process',
            'Input Resi'    =>  'Input Resi',
            'Dikemas'       =>  'Dikemas',
            'Dikirim'       =>  'Dikirim',
            'Selesai'       =>  'Selesai',
            'Dana Cair'     =>  'Dana Cair',
            'Piutang'       =>  'Piutang'
        ];
    }


    public function statusWa()
    {
        return ['Terkirim' => 'Terkirim','Gagal' => 'Gagal','Sudah Banding' => 'Sudah Banding','Belum Banding' => 'Belum Banding'];
    }
}

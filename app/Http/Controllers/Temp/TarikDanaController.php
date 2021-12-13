<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TarikDana;
use Auth;
use App\Toko;
use App\Http\Requests\TarikDanaRequest;
use App\Exports\TarikDanaExport;
use Maatwebsite\Excel\Facades\Excel;

class TarikDanaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->has('download')) {
            $periode = substr($request->periode, 3, 4) . '-' . substr($request->periode, 0, 2);
            return Excel::download(new TarikDanaExport($periode), 'laporan-tarik-dana.xlsx');
        }
        if ($request->ajax()) {
            $tarikDana = TarikDana::with('toko.user');

            if (Auth::user()->level != 'administrator') {
                $tarikDana->where('user_id', Auth::user()->id);
            }


            return \DataTables::of($tarikDana->get())
            ->addColumn('action', function ($row) {
                $btn = \Form::open(['url' => 'tarikdana/' . $row->id, 'method' => 'DELETE','style' => 'float:right;margin-right:5px']);
                $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                $btn .= \Form::close();
                $btn .= '<a class="btn btn-danger btn-sm" href="/tarikdana/' . $row->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a>';
                return $btn;
            })
            ->addColumn('jumlah', function ($row) {
                return number_format($row->jumlah, 0, ',', '.');
            })
            ->addColumn('tanggal', function ($row) {
                return date_format(date_create($row->tanggal), "d/m/Y");
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('tarikdana.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['toko'] = Toko::where('user_id', Auth::user()->id)->pluck('nama_toko', 'id');
        return view('tarikdana.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TarikDanaRequest $request)
    {
        $request['user_id'] = Auth::user()->id;
        TarikDana::create($request->all());
        \Session::flash('message', 'Laporan Tarik Dana Berhasil Ditambahkan');
        return redirect('tarikdana');
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
        $data['tarikdana']   = TarikDana::findOrFail($id);
        $data['toko'] = Toko::where('user_id', Auth::user()->id)->pluck('nama_toko', 'id');
        return view('tarikdana.edit', $data);
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
        $tarikDana = TarikDana::findOrFail($id);
        $tarikDana->update($request->all());
        \Session::flash('message', 'Data Berhasil Diperbaharui');
        return redirect('tarikdana');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarikDana = Toko::findOrFail($id);
        $tarikDana->delete();
        \Session::flash('message', 'Data Berhasil Dihapus');
        return redirect('tarikdana');
    }
}

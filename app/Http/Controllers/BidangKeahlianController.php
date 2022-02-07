<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DiklatCreateRequest;
use App\BidangKeahlian;
use Auth;
use App\Http\Requests\BidangKeahlianCreateRequest;

class BidangKeahlianController extends Controller
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
        if ($request->ajax()) {
            $search         = $request->input('search.value');
            $columns        = $request->get('columns');
            $count_total    = BidangKeahlian::count();
            $count_filter   = BidangKeahlian::where('nama_bidang_keahlian', 'LIKE', '%' . $search . '%')
                            ->count();
            $items          = BidangKeahlian::take(10);

            return \DataTables::of($items)
            ->with([
                'recordsTotal' => $count_total,
                'recordsFiltered' => $count_filter,
              ])
            ->addColumn('action', function ($row) {
                $btn = \Form::open(['url' => '/bidangkeahlian/' . $row->id, 'method' => 'DELETE','style' => 'float:right;margin-right:5px']);
                $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                $btn .= \Form::close();
                $btn .= '<a class="btn btn-danger btn-sm" href="/bidangkeahlian/' . $row->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a> ';
                return $btn;
            })
            ->addColumn('jenis', function ($row) {
                return $row->jenis == 'adaptif' ? 'Adaptif' : 'Produktif';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('bidangkeahlian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bidangkeahlian.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BidangKeahlianCreateRequest $request)
    {
        $bidangKeahlian = BidangKeahlian::create($request->all());
        \Session::flash('message', 'Data Kategori Diklat Berhasil Ditambahkan');
        return redirect('bidangkeahlian');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $data['diklat'] = BidangKeahlian::with('peserta.gtk')->findOrFail($id);

        if ($request->ajax()) {
            $peserta = $data['diklat']->peserta;
            return \DataTables::of($peserta)
            ->addColumn('action', function ($row) {
                $btn = '<button class="btn btn-danger btn-sm" onclick="hapusPeserta(' . $row->id . ')"><i class="fa fa-trash" aria-hidden="true"></i></button> ';
                $btn .= '<button class="btn btn-danger btn-sm" onclick="buka_modal_ubah_status(' . $row->id . ')"><i class="fa fa-edit" aria-hidden="true"></i></button> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $data['provinsi']   = Provinsi::pluck('name', 'id');
        $data['kelas']      = DiklatKelas::pluck('nama_kelas', 'id');
        return view('bidangkeahlian.show', $data);
    }

    public function pdf($id)
    {
        $data['diklat'] = BidangKeahlian::with('peserta.gtk', 'peserta.kelas')->findOrFail($id);
        return \PDF::loadView('bidangkeahlianpdf', $data)->setPaper('A4', 'landscape')->stream();
        //return view('bidangkeahlianpdf', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['bidangKeahlian']   = BidangKeahlian::findOrFail($id);
        return view('bidangkeahlian.edit', $data);
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
        $bidangKeahlian = BidangKeahlian::findOrFail($id);
        $bidangKeahlian->update($request->all());
        \Session::flash('message', 'Data Kategori Diklat Berhasil Diperbaharui');
        return redirect('bidangkeahlian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bidangKeahlian = BidangKeahlian::findOrFail($id);
        $bidangKeahlian->delete();
        \Session::flash('message', 'Data Kategori Diklat Berhasil Dihapus');
        return redirect('bidangkeahlian');
    }
}

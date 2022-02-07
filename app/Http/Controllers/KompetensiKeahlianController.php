<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DiklatCreateRequest;
use App\KompetensiKeahlian;
use App\BidangKeahlian;
use Auth;
use App\Http\Requests\KompetensiKeahlianCreateRequest;

class KompetensiKeahlianController extends Controller
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
            $count_total    = KompetensiKeahlian::count();
            $count_filter   = KompetensiKeahlian::where('nama_kompetensi_keahlian', 'LIKE', '%' . $search . '%')
                            ->count();
            $items          = KompetensiKeahlian::with('programKeahlian.bidangKeahlian')->take(10);

            return \DataTables::of($items)
            ->with([
                'recordsTotal' => $count_total,
                'recordsFiltered' => $count_filter,
              ])
            ->addColumn('action', function ($row) {
                $btn = \Form::open(['url' => '/kompetensikeahlian/' . $row->id, 'method' => 'DELETE','style' => 'float:right;margin-right:5px']);
                $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                $btn .= \Form::close();
                $btn .= '<a class="btn btn-danger btn-sm" href="/kompetensikeahlian/' . $row->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('kompetensikeahlian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['bidangKeahlian'] = BidangKeahlian::where('jenis', 'produktif')->pluck('nama_bidang_keahlian', 'id');
        return view('kompetensikeahlian.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KompetensiKeahlianCreateRequest $request)
    {
        $KompetensiKeahlian = KompetensiKeahlian::create($request->all());
        \Session::flash('message', 'Data Kategori Diklat Berhasil Ditambahkan');
        return redirect('kompetensikeahlian');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['kompetensiKeahlian']    = KompetensiKeahlian::findOrFail($id);
        $data['bidangKeahlian'] = BidangKeahlian::where('jenis', 'produktif')->pluck('nama_bidang_keahlian', 'id');
        return view('kompetensikeahlian.edit', $data);
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
        $KompetensiKeahlian = KompetensiKeahlian::findOrFail($id);
        $KompetensiKeahlian->update($request->all());
        \Session::flash('message', 'Data Kategori Diklat Berhasil Diperbaharui');
        return redirect('kompetensikeahlian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $KompetensiKeahlian = KompetensiKeahlian::findOrFail($id);
        $KompetensiKeahlian->delete();
        \Session::flash('message', 'Data Kategori Diklat Berhasil Dihapus');
        return redirect('kompetensikeahlian');
    }
}

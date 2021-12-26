<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DiklatCreateRequest;
use App\Sekolah;
use App\Provinsi;
use Auth;

class SekolahController extends Controller
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
            $count_total    = Sekolah::count();
            $count_filter   = Sekolah::where('nama_sekolah', 'LIKE', '%' . $search . '%')
                            ->orWhere('alamat', 'LIKE', '%' . $search . '%')
                            ->count();

            $items          = Sekolah::with('district.regency.province')->take(10);

            return \DataTables::of($items)
            ->with([
                'recordsTotal' => $count_total,
                'recordsFiltered' => $count_filter,
              ])
            ->addColumn('action', function ($row) {
                $btn = \Form::open(['url' => '/sekolah/' . $row->sekolah_id, 'method' => 'DELETE','style' => 'float:right;margin-right:5px']);
                $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                $btn .= \Form::close();
                $btn .= '<a class="btn btn-danger btn-sm" href="/sekolah/' . $row->sekolah_id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a> ';
                $btn .= '<a class="btn btn-danger btn-sm" href="/sekolah/' . $row->sekolah_id . '"><i class="fas fa-eye" aria-hidden="true"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('sekolah.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('diklat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiklatCreateRequest $request)
    {
        $diklat = Sekolah::create($request->all());
        \Session::flash('message', 'Data Diklat Berhasil Ditambahkan');

        foreach ($request->kelas as $kelasDiklat) {
            DiklatKelas::create(['diklat_id' => $diklat->id,'nama_kelas' => $kelasDiklat]);
        }
        return redirect('diklat/' . $diklat->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $data['diklat'] = Sekolah::with('peserta.gtk')->findOrFail($id);

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
        return view('diklat.show', $data);
    }

    public function pdf($id)
    {
        $data['diklat'] = Sekolah::with('peserta.gtk', 'peserta.kelas')->findOrFail($id);
        return \PDF::loadView('diklat.pdf', $data)->setPaper('A4', 'landscape')->stream();
        //return view('diklat.pdf', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['diklat']   = Sekolah::findOrFail($id);
        return view('diklat.edit', $data);
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
        $diklat = Sekolah::findOrFail($id);
        $diklat->update($request->all());
        \Session::flash('message', 'Data Diklat Berhasil Diperbaharui');
        return redirect('diklat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diklat = Sekolah::findOrFail($id);
        $diklat->delete();
        \Session::flash('message', 'Data Diklat Berhasil Dihapus');
        return redirect('diklat');
    }


    public function tambahKelasDiklat(Request $request)
    {
        return DiklatKelas::create($request->all());
    }
}

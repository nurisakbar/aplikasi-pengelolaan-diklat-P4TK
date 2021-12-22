<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DiklatCreateRequest;
use App\KategoriDiklat;
use Auth;
use App\Http\Requests\KategoriDiklatCreateRequest;
class KategoriDiklatController extends Controller
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
            $count_total    = KategoriDiklat::count();
            $count_filter   = KategoriDiklat::where('nama_kategori', 'LIKE', '%' . $search . '%')
                            ->count();
            $items          = KategoriDiklat::take(10);

            return \DataTables::of($items)
            ->with([
                'recordsTotal' => $count_total,
                'recordsFiltered' => $count_filter,
              ])
            ->addColumn('action', function ($row) {
                $btn = \Form::open(['url' => '/kategori/' . $row->id, 'method' => 'DELETE','style' => 'float:right;margin-right:5px']);
                $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                $btn .= \Form::close();
                $btn .= '<a class="btn btn-danger btn-sm" href="/kategori/' . $row->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('kategorydiklat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategorydiklat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriDiklatCreateRequest $request)
    {
        $diklat = KategoriDiklat::create($request->all());
        \Session::flash('message', 'Data Kategori Diklat Berhasil Ditambahkan');
        return redirect('kategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $data['diklat'] = KategoriDiklat::with('peserta.gtk')->findOrFail($id);

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
        return view('kategorydiklat.show', $data);
    }

    public function pdf($id)
    {
        $data['diklat'] = KategoriDiklat::with('peserta.gtk', 'peserta.kelas')->findOrFail($id);
        return \PDF::loadView('kategorydiklat.pdf', $data)->setPaper('A4', 'landscape')->stream();
        //return view('kategorydiklat.pdf', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['kategoriDiklat']   = KategoriDiklat::findOrFail($id);
        return view('kategorydiklat.edit', $data);
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
        $diklat = KategoriDiklat::findOrFail($id);
        $diklat->update($request->all());
        \Session::flash('message', 'Data Kategori Diklat Berhasil Diperbaharui');
        return redirect('kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diklat = KategoriDiklat::findOrFail($id);
        $diklat->delete();
        \Session::flash('message', 'Data Kategori Diklat Berhasil Dihapus');
        return redirect('kategori');
    }
}

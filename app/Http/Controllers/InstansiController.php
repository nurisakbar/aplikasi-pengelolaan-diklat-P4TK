<?php

namespace App\Http\Controllers;

use App\Gtk;
use Illuminate\Http\Request;
use App\Http\Requests\DiklatCreateRequest;
use App\Http\Requests\InstansiCreateRequest;
use App\Instansi;
use App\Provinsi;
use Auth;

class InstansiController extends Controller
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
            $count_total    = Instansi::count();
            $count_filter   = Instansi::where('nama_instansi', 'LIKE', '%' . $search . '%')
                ->orWhere('alamat', 'LIKE', '%' . $search . '%')
                ->count();

            $items          = Instansi::with('wilayahAdministratif')->take(10);

            return \DataTables::of($items)
                ->with([
                    'recordsTotal' => $count_total,
                    'recordsFiltered' => $count_filter,
                ])
                ->addColumn('action', function ($row) {
                    $btn = \Form::open(['url' => '/instansi/' . $row->id, 'method' => 'DELETE', 'style' => 'float:right;']);
                    $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                    $btn .= \Form::close();
                    $btn .= '<a class="btn btn-danger btn-sm mx-1" href="/instansi/' . $row->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a> ';
                    $btn .= '<a class="btn btn-danger btn-sm" href="/instansi/' . $row->id . '"><i class="fas fa-eye" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('instansi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instansi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstansiCreateRequest $request)
    {
        $request['jenis_instansi'] = 'Sekolah';
        $request['nama_instansi'] = strtoupper($request->nama_instansi);
        Instansi::create($request->all());
        \Session::flash('message', 'Data Instansi Berhasil Ditambahkan');

        return redirect('instansi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $data['instansi'] = Instansi::findOrFail($id);

        if ($request->ajax()) {
            return \DataTables::of(Gtk::where('instansi_id', $id)->get())
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-danger btn-sm" href="/gtk/' . $row->id . '"><i class="fas fa-eye" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('instansi.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['instansi']   = Instansi::with('district')->findOrFail($id);
        return view('instansi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstansiCreateRequest $request, $id)
    {
        $instansi = Instansi::findOrFail($id);
        $instansi->update($request->all());
        \Session::flash('message', 'Data Instansi Berhasil Diperbaharui');
        return redirect('instansi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instansi = Instansi::findOrFail($id);
        $instansi->delete();
        \Session::flash('message', 'Data Instansi Berhasil Dihapus');
        return redirect('instansi');
    }
}

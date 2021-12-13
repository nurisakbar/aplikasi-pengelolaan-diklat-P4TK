<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TokoCreateRequest;
use App\Toko;
use Auth;
use Storage;

class TokoController extends Controller
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
            return \DataTables::of(Toko::where('user_id', Auth::user()->id)->get())
            ->addColumn('action', function ($row) {
                $btn = \Form::open(['url' => '/toko/' . $row->id, 'method' => 'DELETE','style' => 'float:right;margin-right:5px']);
                $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                $btn .= \Form::close();
                $btn .= '<a class="btn btn-danger btn-sm" href="/toko/' . $row->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('toko.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('toko.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TokoCreateRequest $request)
    {
        $request['user_id'] = Auth::user()->id;
        Toko::create($request->all());
        \Session::flash('message', 'Data Toko Berhasil Ditambahkan');
        return redirect('toko');
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
        $data['toko']   = Toko::findOrFail($id);
        return view('toko.edit', $data);
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
        $Toko = Toko::findOrFail($id);
        $Toko->update($request->all());
        \Session::flash('message', 'Data Toko Berhasil Diperbaharui');
        return redirect('toko');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Toko = Toko::findOrFail($id);
        $Toko->delete();
        \Session::flash('message', 'Data Toko Berhasil Dihapus');
        return redirect('toko');
    }
}

<?php

namespace App\Http\Controllers;

use App\Departemen;
use App\Http\Requests\DepartemenCreateRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class DepartemenController extends Controller
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
        $this->verify();
        if ($request->ajax()) {
            return \DataTables::of(Departemen::get())
                ->addColumn('action', function ($departemen) {
                    $btn = \Form::open(['url' => 'departemen/' . $departemen->id, 'method' => 'DELETE', 'style' => 'float:right;margin-right:5px']);
                    $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                    $btn .= \Form::close();
                    $btn .= '<a class="btn btn-danger btn-sm" href="/departemen/' . $departemen->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('departemen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departemen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartemenCreateRequest $request)
    {
        $data               = $request->all();
        Departemen::create($data);
        \Session::flash('message', 'Berhasil Menambahkan Data');
        return redirect('departemen');
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
        $data['departemen']   = Departemen::find($id);
        return view('departemen.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartemenCreateRequest $request, $id)
    {
        $departemen = Departemen::findOrFail($id);
        $data = $request->all();
        $departemen->update($data);
        \Session::flash('message', 'Berhasil Mengupdate Data ' . $request->nama_departemen);

        return redirect('departemen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departemen = Departemen::find($id);
        $departemen->delete();
        \Session::flash('message', 'Berhasil Menghapus Data ' . $departemen->nama_departemen);
        return redirect('departemen');
    }
}

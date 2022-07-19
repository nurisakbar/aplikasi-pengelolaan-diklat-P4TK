<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InstansiKeahlian;

class InstansiKompetensiKeahlian extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        instansiKeahlian::create($request->all());
        return redirect('instansi/' . $request->instansi_id . '?tab=keahlian')->with('message', 'Data Berhasil Menambah Data');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = InstansiKeahlian::findOrFail($id);
        $data->delete();
        return redirect('instansi/' . $data->instansi_id . '?tab=keahlian')->with('message', 'Data Berhasil Dihapus');
    }
}

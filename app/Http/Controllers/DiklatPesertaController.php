<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DiklatPeserta;

class DiklatPesertaController extends Controller
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
        return DiklatPeserta::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DiklatPeserta::join('master_gtk', 'master_gtk.nopes', 'diklat_peserta.nopes')->first();
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
        $diklatPeserta = DiklatPeserta::findOrFail($id);
        $diklatPeserta->update($request->all());
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $diklatPeserta = DiklatPeserta::findOrFail($id);
        $diklatPeserta->update(['keterangan' => $request->keterangan]);
        $diklatPeserta->delete();
    }
}

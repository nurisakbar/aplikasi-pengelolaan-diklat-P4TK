<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DiklatPeserta;
use App\Gtk;
use App\Diklat;

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
        $gtk = Gtk::where('id', $request->peserta_id)->first();
        $diklat = Diklat::where('id', $request->diklat_id)->first();
        $text_wa = "Hallo " . $gtk->nama_lengkap . " anda terpilih sebagai peserta pada diklat " . $diklat->nama_diklat . " yang akan dilaksanakan pada tanggal " . tgl_indo($diklat->tanggal_mulai) . " sampai " . tgl_indo($diklat->tanggal_selesai) . "";
        send_wa($gtk->nomor_hp, $text_wa);
        $request['status_kehadiran'] = 'Peserta';
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
        return DiklatPeserta::with('gtk.instansi.wilayahAdministratif')->where('id', $id)->first();
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

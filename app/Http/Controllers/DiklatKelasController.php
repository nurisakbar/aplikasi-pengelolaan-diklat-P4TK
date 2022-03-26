<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DiklatKelas;

class DiklatKelasController extends Controller
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
        $diklat_id = $request->diklat_id;
        $request['diklat_id'] = $diklat_id;
        DiklatKelas::create($request->all());
        \Session::flash('message', 'Data Kelas Berhasil Ditambahkan');
        return redirect('diklat/' . $diklat_id . '?tab=kelas');
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
        $kelas = DiklatKelas::findOrFail($id);
        if ($kelas->peserta->count() > 0) {
            $pesan = "Hapus Kelas Gagal, Masih Ada Peserta Pada Kelas Tersebut";
        } else {
            $kelas->delete();
            $pesan = "Hapus Kelas Berhasil";
        }
        \Session::flash('message', $pesan);
        return redirect('diklat/' . $kelas->diklat_id . '?tab=kelas');
    }
}

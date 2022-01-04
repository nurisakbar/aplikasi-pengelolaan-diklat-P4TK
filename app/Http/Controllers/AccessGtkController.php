<?php

namespace App\Http\Controllers;

use App\Diklat;
use App\DiklatKelas;
use App\Gtk;
use App\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessGtkController extends Controller
{
    protected $agama;

    public function __construct()
    {
        $this->middleware('authgtk');
        $this->agama = config('datareferensi.agama');
    }

    public function index()
    {
        $data['diklats'] = Diklat::with('kategori')->where('status_aktif', 'Aktif')->get();
        return view('dashboard-gtk.list-diklat', $data);
    }

    public function profile()
    {
        $id = Auth::guard('gtk')->user()->id;
        $data['gtk']   = Gtk::with('village', 'instansi')->findOrFail($id);
        $data['agama'] = $this->agama;
        return view('dashboard-gtk.profile', $data);
    }

    public function updateProfile(Request $request, $id)
    {
        $gtk = Gtk::findOrFail($id);
        $gtk->update($request->all());
        \Session::flash('message', 'Data Anda Berhasil Diperbaharui');
        return redirect('profile');
    }

    public function detailDiklat($id, Request $request)
    {
        $data['diklat'] = Diklat::with('peserta.gtk.instansi.wilayahAdministratif')->findOrFail($id);

        if ($request->ajax()) {
            $peserta = $data['diklat']->peserta;
            return \DataTables::of($peserta)
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-danger btn-sm" href="/gtk/' . $row->gtk->id . '"><i class="fas fa-eye" aria-hidden="true"></i></a> ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['provinsi']   = Provinsi::pluck('name', 'id');
        $data['kelas']      = DiklatKelas::pluck('nama_kelas', 'id');
        return view('dashboard-gtk.detail-diklat', $data);
    }
}

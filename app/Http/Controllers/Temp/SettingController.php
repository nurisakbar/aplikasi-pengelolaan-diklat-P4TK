<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SettingBonus;
use App\SettingGajiPokok;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function bonus()
    {
        return \DataTables::of(SettingBonus::all())
            ->addColumn('action', function ($row) {
                $btn = \Form::open(['url' => '/setting/' . $row->id . '?jenis=bonus', 'method' => 'DELETE','style' => 'float:right;margin-right:5px']);
                $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                $btn .= \Form::close();
                //$btn .= '<a class="btn btn-danger btn-sm" href="/absensi/'.$row->id.'/edit"><i class="fas fa-edit" aria-hidden="true"></i></a>';
                $btn .= "<a class='btn btn-danger btn-sm' id='editCompany' data-toggle='modal' data-target='#practice_modal' data-id='" . $row->id . "'><i class='fas fa-edit' aria-hidden='true'></i></a>";
                return $btn;
            })
            ->addColumn('bonus', function ($row) {
                return $row->bonus . ' %';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function showBonus($id)
    {
        return SettingBonus::find($id);
    }

    public function index(Request $request)
    {
        $tab = $request->tab;
        $data['settingGajiPokok'] = SettingGajiPokok::all();
        return view('setting.' . $tab, $data);
    }


    public function store(Request $request)
    {
        if ($request->jenis == 'bonus') {
            SettingBonus::create($request->all());
            return redirect('setting?tab=bonus')->with('message', 'Setting Bonus Berhasil Ditambahkan');
        } elseif ($request->jenis == 'update-bonus') {
            $bonus = SettingBonus::find($request->id);
            $bonus->update($request->all());
            return redirect('setting?tab=bonus')->with('message', 'Setting Bonus Berhasil Diubah');
        } else {
            $countRows = count($request->id) - 1;
            for ($row = 0; $row <= $countRows; $row++) {
                $settingGajiPokok = SettingGajiPokok::find($request->id[$row]);
                $settingGajiPokok->update(['jumlah' => $request->jumlah[$row]]);
            }
            return redirect('setting?tab=gaji-pokok')->with('message', 'Setting Gaji Pokok Berhasil Diubah');
        }
    }

    public function destroy($id, Request $request)
    {
        if ($request->jenis == 'bonus') {
            $bonus = SettingBonus::find($id);
            $bonus->delete();
            return redirect('setting?tab=bonus')->with('message', 'Setting Bonus Berhasil Dihapus');
        }
    }
}

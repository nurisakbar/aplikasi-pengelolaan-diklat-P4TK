<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProgramKeahlian;
use App\Regency;

class AjaxController extends Controller
{
    public function programKeahlianDropdown(Request $request)
    {
        $programKeahlian = ProgramKeahlian::where('bidang_keahlian_id', $request->bidang_keahlian_id)->pluck('nama_program_keahlian', 'id');
        return \Form::select('program_keahlian_id', $programKeahlian, null, ['class' => 'form-control program_keahlian_id']);
    }

    public function select2Desa(Request $request)
    {
        $data = \DB::table('villages')
            ->select('id', 'name')
            ->where('name', 'like', "%" . $request->q . "%")
            ->limit(20)
            ->get();
        return response()->json($data);
    }

    public function select2Instansi(Request $request)
    {
        $data = \DB::table('instansi')
            ->select('id', 'nama_instansi')
            ->where('nama_instansi', 'like', "%" . $request->q . "%")
            ->limit(20)
            ->get();
        return response()->json($data);
    }

    public function kabupatenDropdown(Request $request)
    {
        $regencies = Regency::where('province_id', $request->provinsi)->pluck('name', 'id');
        return \Form::select('regency_id', $regencies, null, ['class' => 'form-select form-select-solid','data-kt-select2' => 'true','data-placeholder' => 'Select option']);
    }
}

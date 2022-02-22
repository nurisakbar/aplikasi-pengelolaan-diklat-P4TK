<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProgramKeahlian;
use App\Regency;
use App\DiklatPeserta;
use App\DiklatKelas;
use App\BidangKeahlian;

class AjaxController extends Controller
{
    public function programKeahlianDropdown(Request $request)
    {
        $programKeahlian = ProgramKeahlian::where('bidang_keahlian_id', $request->bidang_keahlian_id)->pluck('nama_program_keahlian', 'id');
        return \Form::select('program_keahlian_id', $programKeahlian, null, ['class' => 'form-control program_keahlian_id']);
    }

    public function bidangKeahlianDropdown(Request $request)
    {
        $bidangKeahlian = BidangKeahlian::where('jenis', $request->jenis_bidang_keahlian)->pluck('nama_bidang_keahlian', 'id');
        return \Form::select('bidang_keahlian', $bidangKeahlian, null, ['class' => 'form-control bidang_keahlian_id','onChange' => 'load_program_keahlian()']);
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

    public function select2KompetensiKeahlian(Request $request)
    {
        $data = \DB::table('kompetensi_keahlian')
            ->select('id', 'nama_kompetensi_keahlian')
            ->where('nama_kompetensi_keahlian', 'like', "%" . $request->q . "%")
            ->limit(20)
            ->get();
        return response()->json($data);
    }

    public function select2Daerah(Request $request)
    {
        $data = \DB::table('districts')
            ->select('id', 'name')
            ->where('name', 'like', "%" . $request->q . "%")
            ->limit(20)
            ->get();
        return response()->json($data);
    }

    public function kabupatenDropdown(Request $request)
    {
        $regencies = Regency::where('province_id', $request->provinsi)->pluck('name', 'id');
        return \Form::select('regency_id', $regencies, null, ['class' => 'regency_id form-select form-select-solid', 'data-kt-select2' => 'true', 'data-placeholder' => 'Select option','placeholder' => 'Semua Kabupaten']);
    }

    public function daftarDiklatMandiri(Request $request)
    {

        $kelas = DiklatKelas::where('diklat_id', $request->diklat_id)->firstOrFail();
        $request['kelas_id'] = $kelas->id;
        $result      = DiklatPeserta::create($request->all());
        $result['status'] = "ok";
        return response()->json($result);
    }
}

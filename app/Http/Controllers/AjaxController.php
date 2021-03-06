<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProgramKeahlian;
use App\Regency;
use App\DiklatPeserta;
use App\DiklatKelas;
use App\BidangKeahlian;
use App\KompetensiKeahlian;

class AjaxController extends Controller
{
    public function bidangKeahlianDropdown(Request $request)
    {
        $bidangKeahlian = BidangKeahlian::where('jenis', $request->jenis_bidang_keahlian)->pluck('nama_bidang_keahlian', 'id');
        return \Form::select('bidang_keahlian_id', $bidangKeahlian, null, ['class' => 'form-control bidang_keahlian_id','onChange' => 'load_program_keahlian()','placeholder' => '-- Semua Bidang Keahlian --']);
    }

    public function programKeahlianDropdown(Request $request)
    {
        $programKeahlian = ProgramKeahlian::where('bidang_keahlian_id', $request->bidang_keahlian_id)->pluck('nama_program_keahlian', 'id');
        return \Form::select('program_keahlian_id', $programKeahlian, null, ['class' => 'form-control program_keahlian_id','placeholder' => '-- Semua Program Keahlian --','onChange' => 'load_kompetensi_keahlian()']);
    }

    public function kompetensiKeahlianDropdown(Request $request)
    {
        $kompetensiKehalian = KompetensiKeahlian::where('program_keahlian_id', $request->program_keahlian_id)->pluck('nama_kompetensi_keahlian', 'id');
        return \Form::select('kompetensi_keahlian_id', $kompetensiKehalian, null, ['class' => 'form-control kompetensi_keahlian_id','placeholder' => '-- Semua Kompetensi Keahlian --']);
    }

    public function select2Desa(Request $request)
    {
        $data = \DB::table('view_wilayah_administratif_indonesia')
            ->select('village_id as id', \DB::raw('CONCAT(village_name, \' , \', district_name, \' , \',province_name) as name'))
            ->where('village_name', 'like', "%" . $request->q . "%")
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
        $kelas = DiklatKelas::firstOrCreate(['diklat_id' => $request->diklat_id], ['diklat_id' => $request->diklat_id,'nama_kelas' => 'Kelas A']);
        $request['diklat_kelas_id'] = $kelas->id;
        $request['status_kehadiran'] = "Pendaftar";
        $result      = DiklatPeserta::create($request->all());
        $result['status'] = "ok";
        return response()->json($result);
    }
}

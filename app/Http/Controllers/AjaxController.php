<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProgramKeahlian;
class AjaxController extends Controller
{
    public function programKeahlianDropdown(Request $request){
        $programKeahlian = ProgramKeahlian::where('bidang_keahlian_id',$request->bidang_keahlian_id)->pluck('nama_program_keahlian','id');
        return \Form::select('program_keahlian_id',$programKeahlian,null,['class' => 'form-control program_keahlian_id']);
    }
}

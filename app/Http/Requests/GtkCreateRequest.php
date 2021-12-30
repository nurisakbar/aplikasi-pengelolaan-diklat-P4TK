<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GtkCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_lengkap'         =>  'required',
            'nik'                  =>  'required:numeric',
            'tempat_lahir'         =>  'required',
            'jenis_kelamin'        =>  'required',
            'nip'                  =>  'required',
            'nuptk'                =>  'required',
            'nomor_ukg'            =>  'required',
            'golongan'             =>  'required',
            'jabatan'              =>  'required',
            'agama'                =>  'required',
            'domisi_alamat_jalan'  =>  'required',
            'domisili_nama_dusun'  =>  'required',
            'domisili_kode_pos'    =>  'required',
            'domisili_rt'          =>  'required',
            'domisili_rw'          =>  'required',
            'nomor_hp'             =>  'required',
            'email'                =>  'required',
            'npwp'                 =>  'required',
            'village_id'           =>  'required',
            'instansi_id'          =>  'required',
        ];
    }
}

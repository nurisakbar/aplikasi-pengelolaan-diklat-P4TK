<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PendaftaranCreateRequest extends FormRequest
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
            'nama_lengkap'          => 'required',
            'nik'                   => 'required|numeric',
            'nuptk'                 => 'required',
            'instansi_id'           => 'required',
            'domisi_alamat_jalan' => 'required',
            'nomor_hp'              => 'required',
            'jabatan'               => 'required',
            'email'                 => 'required|unique:gtk,email',
            'password'              => 'required|min:5',
            'confirm_password'      => 'required|same:password',
            'captcha'               => 'required|captcha'
        ];
    }
}

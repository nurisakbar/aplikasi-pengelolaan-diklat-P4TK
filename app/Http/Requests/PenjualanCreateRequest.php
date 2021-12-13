<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenjualanCreateRequest extends FormRequest
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
            'toko_id'               =>  'required',
            'tanggal'               =>  'required',
            'nomor_pesanan'         =>  'required',
            'nama_pembeli'          =>  'required',
            'nomor_hp'              =>  'required',
            'uang_masuk'            =>  'required',
            'ongkir_customer'       =>  'required',
            'ongkir_supplier'       =>  'required',
            'akun_belanja'          =>  'required',
            'status'                =>  'required',
            'supplier'              =>  'required'
        ];
    }
}

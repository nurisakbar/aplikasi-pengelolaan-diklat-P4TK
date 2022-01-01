<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstansiCreateRequest extends FormRequest
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
            'nama_instansi'  =>  'required',
            'status'  =>  'required',
            'alamat'  =>  'required',
            'district_id'  =>  'required',
            'telepon'  =>  'required',
            'email'  =>  'required',
            'npsn'  =>  'required',
        ];
    }
}

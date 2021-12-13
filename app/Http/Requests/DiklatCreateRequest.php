<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiklatCreateRequest extends FormRequest
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
            'tahun'        =>  'required|integer',
            'nama_diklat'  => 'required'
        ];
    }
}

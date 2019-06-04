<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NovedadesRequest extends FormRequest
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
            'descripcion_novedad'      =>  'required|min:1|max:500'
            //'telefono_actor'      =>  'integer|min:11|max:11'
            //'email'     =>  'required|min:5|max:250|unique:users',
            //'password'  =>  'required|min:5|max:250'
        ];
    }
}

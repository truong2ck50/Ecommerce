<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BackendManufacturerRequest extends FormRequest
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
            'm_name' => 'required|unique:manufacturers,m_name,'.$this->id
        ];
    }

    public function messages() 
    {
        return [
            'm_name.required' => 'Dữ liệu không được để trống',
            'm_name.unique'   => 'Dữ liệu đã tồn tại'
        ];
    }
}

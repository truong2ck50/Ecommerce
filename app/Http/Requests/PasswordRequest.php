<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password_old'     => 'required',
            'password'         => 'required',
            'password_confirm' => 'required|same:password'
        ];
    }

    public function messages() 
    {
        return [
            'password_old.required'     => 'Dữ liệu không được để trống',
            'password.required'         => 'Dữ liệu không được để trống',
            'password_confirm.required' => 'Dữ liệu không được để trống',
            'password_confirm.same'     => 'Mật khẩu xác nhận không đúng'
        ];
    } 
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    public function authorize()
    {
        return true;  //admin guard
    }


    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|unique:admins',
            'password' => 'required|min:6|confirmed',


        ];
    }


    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'name.string' => 'اسم الادمن لابد ان يكون احرف',
            'name.max' => 'اسم الادمن لابد الا يزيد عن 100 احرف ',
            'password.min' => 'كلمه المرور يجب ان لاتقل عن 6 ارقام   ',
            'password.confirmed' => 'كلمه المرور غير متطابقه',

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'password' => 'required|min:6',
        ];
    }


    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'in' => 'القيم المدخلة غير صحيحة ',
            'name.string' => 'اسم الادمن لابد ان يكون احرف',
            'name.max' => 'اسم الادمن لابد الا يزيد عن 100 احرف ',
            'password.min' => 'كلمه المرور يجب ان لاتقل عن 6 ارقام   ',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;  //admin guard
    }

    
    public function rules()
    {
        return [
        'photo'                     => 'required|mimes:jpg,jpeg,png',
        'icon'                      => 'required|mimes:jpg,jpeg,png',
        'language_id'               => 'required',
        'setting' => 'required|array|min:1',
        'setting.*.sitename' => 'required|string|max:100',
        'setting.*.abbr' => 'required|string|max:10',
         
        'setting.*.description' => 'required',
        'setting.*.keywords' => 'required',
        'setting.*message_maintenance' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'name.string' => 'اسم اللغة لابد ان يكون احرف',
            'abbr.max' => 'هذا الحقل لابد الا يزيد عن 10 احرف ',
            'abbr.string' => 'هذا الحقل لابد ان يكون احرف ',
            'sitename.max' => 'اسم اللغة لابد الا يزيد عن 100 احرف ',
              
        ];
    }
}

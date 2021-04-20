<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;  //admin guard
    }

    
    public function rules()
    {
        return [
        'logo'                      => 'required|mimes:jpg,jpeg,png',
        'code'                      => 'required ',
        'mob'                      => 'required ',
        // 'country' => 'required|array|min:1',
        'country.*.name' => 'required|string|max:100',
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

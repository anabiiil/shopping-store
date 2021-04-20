<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;  //admin guard
    }

    
    public function rules()
    {
        return [
        'category.*.name' => 'required ',
        // 'parent_id' => 'required ',
        'category.*.description' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            // 'name.string' => 'اسم اللغة لابد ان يكون احرف',              
        ];
    }
}

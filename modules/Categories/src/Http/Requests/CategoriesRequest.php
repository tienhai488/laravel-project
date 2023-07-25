<?php

namespace Modules\Categories\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'=>'required',
            'slug'=>'required',
        ];
    }

    public function messages(){
        return [
            'required'=>":attribute vui lòng không để trống!",
            'min'=>":attribute ít nhất :min kí tự!",
        ];
    }

    public function attributes()
    {
        return [
            'name'=>"Tên danh mục",
            'slug'=>"Slug",
        ];
    }
}
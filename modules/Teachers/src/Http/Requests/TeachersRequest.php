<?php

namespace Modules\Teachers\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeachersRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name'=>'required|max:255',
            'slug'=>'required',
            'description'=>'required',
            'image'=>'required',
            'exp'=>'required|integer',
        ];
        return $rules;
    }

    public function messages(){
        return [
            'required'=>":attribute vui lòng không để trống!",
            'min'=>":attribute ít nhất :min kí tự!",
            'max'=>":attribute nhiều nhất :max kí tự!",
            'integer'=>":attribute phải là số nguyên!",
            'unique'=>":attribute đã tồn tại!",
        ];
    }

    public function attributes()
    {
        return [
            'name'=>'Tên giảng viên',
            'slug'=>'Slug',
            'description'=>'Giới thiệu giảng viên',
            'image'=>'Ảnh đại diện',
            'exp'=>'Số năm kinh nghiệm',
        ];
    }
}
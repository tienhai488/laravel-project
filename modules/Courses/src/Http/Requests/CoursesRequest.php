<?php

namespace Modules\Courses\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursesRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->route()->id;
        $rules = [
            'name'=>'required|max:255',
            'slug'=>'required',
            'detail'=>'required',
            'teacher_id'=>['required','integer',function($attribute,$value,$fail){
                if($value==0){
                    $fail("Vui lòng chọn giảng viên!");
                }
            }],
            'thumbnail'=>'required',
            'price'=>'required|integer',
            'code'=>'required|max:255|unique:courses,code',
            'support'=>'required',
            'sale_price'=>[function($attribute,$value,$fail){
                if(!empty($value)){
                    if(!ctype_digit($value)){
                        $fail("Giá khuyến mãi phải là số nguyên!");
                    }
                }
            }],
            'categories'=>['required'],
        ];

        if(!empty($id)){
            $rules['code'] .= ",$id";
        }
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
            'name'=>'Tên khóa học',
            'slug'=>'Slug',
            'detail'=>'Mô tả khóa học',
            'teacher_id'=>'Giảng viên',
            'thumbnail'=>'Ảnh đại diện',
            'price'=>'Giá khóa học',
            'sale_price'=>'Giá khuyến mãi',
            'code'=>'Mã khóa học',
            'support'=>'Hỗ trợ học viên',
            'categories'=>"Danh mục khóa học"
        ];
    }
}
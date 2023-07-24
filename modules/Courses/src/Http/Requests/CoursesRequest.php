<?php

namespace Modules\Courses\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursesRequest extends FormRequest
{
    public function rules()
    {
        // $id = $this->route()->id;
        // $rules = [
        //     'name'=>'required|min:5',
        //     'email'=>'required|email|unique:users,email',
        //     'group_id'=>['required','integer',function($attribute,$value,$fail){
        //         if($value==0){
        //             $fail("Vui lòng chọn nhóm người dùng");
        //         }
        //     }],
        //     'password'=>'required|min:6',
        // ];

        // if(!empty($id)){
        //     $rules['email'] = "required|email|unique:users,email,$id";
        //     $rules['password'] = [function($attribute,$value,$fail){
        //         if(!empty($value)){
        //             if(strlen($value)<6){
        //                 $fail("Mật khẩu ít nhất 6 kí tự!");
        //             }
        //         }
        //     }];
        // }
        // return $rules;
    }

    public function messages(){
        // return [
        //     'required'=>":attribute vui lòng không để trống!",
        //     'min'=>":attribute ít nhất :min kí tự!",
        //     'email'=>":attribute không hợp lệ!",
        //     'unique'=>":attribute đã tồn tại trong hệ thống!",
        //     'integer'=>":attribute phải là số nguyên!",
        // ];
    }

    public function attributes()
    {
        // return [
        //     'name'=>"Họ tên",
        //     'email'=>"Email",
        //     'group_id'=>"Nhóm người dùng",
        //     'password'=>"Mật khẩu",
        // ];
    }
}
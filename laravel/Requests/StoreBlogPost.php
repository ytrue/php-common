<?php

namespace App\Http\Requests;

/**
 * 表单数据校验 具体实现
 * Class StoreBlogPost
 * @package App\Http\Requests
 */
class StoreBlogPost extends Request
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
            'username' => 'required|max:10',
            'password' => 'required|max:10',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'username名称必须',
            'username.max' => 'username不能超过10个字符',
            'password.required' => 'password名称必须',
            'password.max' => 'password不能超过10个字符',
        ];
    }
}

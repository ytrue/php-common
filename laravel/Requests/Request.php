<?php
/**
 * @author ytrue
 * @date 2021/5/11 18:16
 * @description Request 表单数据校验 ，校验失败数据返回
 */

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class Request extends FormRequest
{

    protected function failedValidation(Validator $validator): void
    {
        throw (new HttpResponseException(response()->json([
            'code' => 400,
            'message' => current(current($validator->errors()))[0],
        ], Response::HTTP_UNAUTHORIZED)));
    }
}

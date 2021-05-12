<?php

namespace app\wx\library;

use Exception;
use think\Config;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\ValidateException;

/**
 * thinkphp5自定义API模块的错误显示
 */
class Tp5ExceptionHandle extends Handle
{

    public function render(Exception $e)
    {
        if (!Config::get('app_debug')) {

            $statusCode = 200;
            $code = 500;
            $msg = $e->getMessage();
            // 验证异常
            if ($e instanceof ValidateException) {
                $code = 0;
                $msg = $e->getError();
            }
            // Http异常
            if ($e instanceof HttpException) {
                $code = $e->getStatusCode();
            }
            return json(['code' => $code, 'msg' => $msg, 'time' => time(), 'data' => null], $statusCode);
        }
        return parent::render($e);
    }

}

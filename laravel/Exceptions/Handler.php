<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * laravel 8 全局异常处理
 * Class Handler
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * 全局异常处理
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $exception
     * @return JsonResponse
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        $error = $this->convertExceptionToResponse($exception);
        $response['status_code'] = $error->getStatusCode();
        $response['code'] = $exception->getCode();
        $response['message'] = empty($exception->getMessage()) ? 'something error' : $exception->getMessage();
        //如果开启调式模式的话会把错误信息打印出来
        if (config('app.debug')) {
            if ($error->getStatusCode() >= 500) {
                if (config('app.debug')) {
                    $response['trace'] = $exception->getTraceAsString();

                }
            }
        }
        $response['result'] = 'error';
        return response()->json($response, $error->getStatusCode());
    }
}

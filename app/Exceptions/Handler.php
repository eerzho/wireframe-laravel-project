<?php

namespace App\Exceptions;

use App\Constants\Messages\ExceptionMessage;
use App\Interfaces\BaseException\BaseExceptionInterface;
use App\Traits\ResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ResponseTrait;

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
        $this->renderable(function (Throwable $exception, Request $request) {
            if ($request->is('api/*')) {
                if ($exception instanceof NotFoundHttpException) {
                    return $this->response([
                        'message' => 'Not Found'
                    ], 404);
                }
                if ($exception instanceof BaseExceptionInterface) {
                    return $this->response([
                        'message' => $exception->getMessage()
                    ], $exception->getCode());
                }
                if ($exception instanceof AuthenticationException) {
                    return $this->response([
                        'message' => ExceptionMessage::UN_AUTH
                    ], 401);
                }
                if ($exception instanceof AccessDeniedHttpException) {
                    return $this->response([
                        'message' => $exception->getMessage()
                    ], 403);
                }
            }
        });
    }
}

<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        $statusCode = $this->getStatusCode($exception);
        $response = [
            'errors' => [],
            'exception' => get_class($exception),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'message' => $exception->getMessage(),
            'statusCode' => $statusCode,
        ];

        if ($request->wantsJson()) {
            return response()->json($response, Response::HTTP_UNAUTHORIZED);
        } else {
            return parent::render($request, $exception);
        }
    }

    protected function getStatusCode(Throwable $exception): int
    {
        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return Response::HTTP_NOT_FOUND;
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return Response::HTTP_UNAUTHORIZED;
        }

        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }


    // protected function unauthenticated($request, AuthenticationException $exception)
    // {

    //     $response = [
    //         'success' => false,
    //         'message' => '인증된 사용자가 아닙니다.',
    //     ];

    //     return response()->json($response, Response::HTTP_UNAUTHORIZED);
    // }
}

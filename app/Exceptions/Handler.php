<?php

namespace App\Exceptions;

use App\Traits\RespondsWithHttpStatus;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{

    use RespondsWithHttpStatus;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct()
    {
        $this->guard = "api";
    }

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
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
        //
    }

    public function report(Throwable $exception)
    {

    }
    public function render($request, Throwable $exception)
    {

        //Query exception - > like garbage column added
        if ($exception instanceof QueryException) {
            return $this->failure($exception->getMessage());
        }

        //No result with search criteria
        if ($exception instanceof NotFoundHttpException) {
            return $this->failure(trans('messages.notFoundUrl'), Response::HTTP_NOT_FOUND);
        }

        //Method not allowed
        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->failure($exception->getHeaders());
        }

        //Validation
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return $this->failure($exception->errors());
            //return $this->failure($exception->validator->getMessages());
        }

        //UnauthorizedException
        if ($exception instanceof UnauthorizedException) {
            return $this->failure($exception);
        }

        //TokenExpiredException
        if ($exception instanceof TokenExpiredException) {
            return $this->refresh();

        }
        //TokenInvalidException
        if ($exception instanceof TokenInvalidException) {
            return $this->failure('Invalid Token');
        }

        //JWTException
        if ($exception instanceof JWTException) {
            return $this->failure('Invalid Token');
        }

        //error not defined above
        if ($exception) {
            return $this->failure($exception->getMessage(), Response::HTTP_GONE);
        }

        return parent::render($request, $exception);
    }

    protected function refresh()
    {
        return $this->respondWithToken(auth($this->guard)->refresh());
    }

    protected function respondWithToken($token, $status = 490)
    {
        return response([
            'code' => $status,
            'token' => $token,
            'tokenType' => 'bearer',
            'expiresIn' => auth($this->guard)->factory()->getTTL() * 60,
        ], $status);
    }
}

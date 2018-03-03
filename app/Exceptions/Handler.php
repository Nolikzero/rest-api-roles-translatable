<?php

namespace App\Exceptions;

use App\Transformers\ExceptionTransformer;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // This will replace our 404 response with
        // a JSON response.
        if (($exception instanceof ModelNotFoundException ||
            $exception instanceof NotFoundHttpException) &&
            $request->wantsJson()
        ) {

            return fractal(trans('http.resource_not_found'), new ExceptionTransformer())
                ->respond(Response::HTTP_NOT_FOUND);
        }


        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return fractal(trans('http.unauthenticated'), new ExceptionTransformer())
            ->respond(Response::HTTP_UNAUTHORIZED);
    }
}

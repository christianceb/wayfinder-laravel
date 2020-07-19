<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // There is a cleaner and more maintainable way to do this but it has to be done from the client side
        // https://stackoverflow.com/questions/57761081/laravel-route-model-binding-return-json-response-when-model-id-not-found
        $routeJsonWhitelist = [
            "uploads.id"
        ];

        // Funnel ModelNotFoundException to this block if the request route name is in the whitelist
        if ($exception instanceof ModelNotFoundException && in_array($request->route()->getName(), $routeJsonWhitelist)) {
            // Return 404
            return response()
                ->json(
                    ['message' => Response::$statusTexts[Response::HTTP_NOT_FOUND]],
                    Response::HTTP_NOT_FOUND
                );
        }

        return parent::render($request, $exception);
    }
}

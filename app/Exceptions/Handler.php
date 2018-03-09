<?php

namespace Api\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson()) {
            return $this->getJsonResponse($e);
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }

    /**
     * Transform the exception into a JSON response.
     *
     * @param Exception $exception
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function getJsonResponse(Exception $exception)
    {
        if ($exception instanceof HttpResponseException) {
            return response()->json([
                'message' => $exception->getResponse()->getContent(),
                'status' => $exception->getResponse()->getStatusCode(),
            ], $exception->getResponse()->getStatusCode());
        }

        if ($exception instanceof InvalidArgumentsException || $exception instanceof GarageProfileConflictException) {
            return new JsonResponse((array)$exception->getJsonResponse(), $exception->getCode());
        }

        $statusCode = $this->getStatusCode($exception);

        if (!$message = $exception->getMessage()) {
            $message = sprintf('%d %s', $statusCode, Response::$statusTexts[$statusCode]);
        }

        $response = [
            'message' => $message,
            'statusCode' => $statusCode,
        ];

        if ($exception instanceof MessageBag && $exception->hasErrors()) {
            $response['errors'] = $exception->getErrors();
        }

        if ($code = $exception->getCode()) {
            $response['code'] = $code;
        }

        if ($this->isDebug()) {
            $response['debug'] = [
                'line' => $exception->getLine(),
                'file' => $exception->getFile(),
                'class' => get_class($exception),
                'trace' => explode("\n", $exception->getTraceAsString()),
            ];
        }

        return new JsonResponse($response, $statusCode);
    }

    /**
     * Get the status code from the exception.
     *
     * @param \Exception $exception
     *
     * @return int
     */
    protected function getStatusCode(Exception $exception) : int
    {
        if ($exception instanceof HttpResponseException) {
            return $exception->getResponse()->getStatusCode();
        }

        if ($exception instanceof HttpException) {
            return $exception->getStatusCode();
        }

        return 500;
    }

    /**
     * Check if the app is in debug mode.
     *
     * @return bool
     */
    public function isDebug() : bool
    {
        return config('app.debug');
    }
}

<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     * 
     * * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $exception) // Changed Exception to Throwable
    {
        // Handle JWT exceptions
        if ($exception instanceof JWTException) {
            return response()->json([
                'error' => 'Token is invalid or expired.'
            ], 401);
        }

        // Handle TokenExpiredException
        if ($exception instanceof TokenExpiredException) {
            return response()->json([
                'error' => 'Token has expired. Please login again.'
            ], 401);
        }

        // Handle TokenInvalidException
        if ($exception instanceof TokenInvalidException) {
            return response()->json([
                'error' => 'Token is invalid.'
            ], 401);
        }

        // If the request was unauthenticated
        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'error' => 'Unauthorized access. Please provide a valid token.'
            ], 401);
        }

        // Default response for other exceptions
        return parent::render($request, $exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}

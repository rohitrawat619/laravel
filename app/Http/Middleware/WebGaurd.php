<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WebGaurd
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('age')) {
            if ($request->age > 18) {
                return $next($request);
            } else {
                return response()->json([
                    'status' => 'Denied',
                    'message' => 'Age Should be greater than 18 atleast.'
                ], 400); // 400 Bad Request
            }
        }
        else{
            return response()->json([
                'status' => 'middleware restrictions due to age mandatory need in url as query string for access the Website',
                'message' => 'Age parameter is required in the query string.'
            ], 400); // 400 Bad Request
        }
    }
    
}

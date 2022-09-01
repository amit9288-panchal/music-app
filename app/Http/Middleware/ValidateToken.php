<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateToken
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('auth-key') !== 'amit-panchal') {
            return response()->json([
                'status' => 'error',
                'declaration' => 'auth_key_missing',
            ], 400);
        }
        if ($request->header('auth-token') !== env('API_TOKEN')) {
            return response()->json([
                'status' => 'error',
                'declaration' => 'auth_token_missing',
            ], 400);
        }
        return $next($request);
    }

}

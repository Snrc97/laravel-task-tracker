<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        if (empty($token)) {
            return response()->json(['error' => __('auth.failed', ['reason' => __('auth.token_not_provided')])], 401);
        }
        $result = false;

        try {
            $result = auth()->validate(['token' => $token]);
        } catch (\Exception $e) {
            return response()->json(['error' => __('auth.failed', ['reason' => $e->getMessage()])], 401);
        }
        finally {
            if (!$result) {
                return response()->json(['error' => __('auth.failed', ['reason' => __('auth.invalid_token')])], 401);
            }

            return $next($request);
        }

    }
}

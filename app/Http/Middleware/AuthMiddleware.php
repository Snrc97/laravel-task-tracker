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
        auth()->shouldUse('sanctum');

        $authorization = $request->header('Authorization') ?? null;
        $token = $authorization ?? session()->get('token', "");
        if (empty($token)) {
            authLogout($request);

            return apiResponse(
                message: __('auth.failed', ['reason' => __('auth.token_not_provided')]),
                status: 401
            );
        }
        $result = false;

        $token = str_replace('Bearer ', '', $token);
        try {

            $result = auth()->user();

        } catch (\Exception $e) {
            return apiResponse(
                message:__('auth.failed', ['reason' => $e->getMessage()]),
                status: 401
            );

        }
        finally {

            if (!$result) {
                authLogout($request);
                return apiResponse(
                    message: __('auth.failed', ['reason' => __('auth.invalid_token')]),
                    status: 401
                );
            }

            return $next($request);
        }

    }
}

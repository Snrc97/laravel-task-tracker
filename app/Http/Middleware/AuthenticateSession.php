<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateSession
{
      /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            auth()->shouldUse('web');
            // $sessdata = $request?->session()?->all() ?? null;
            $check = auth()->check();

            if($check) {

                if($request->is('web/dashboard/login') || $request->is('web/dashboard/register')) {
                    return redirect(route('dashboard'));
                }

            }
            else
            {
                authLogout($request);
                if(!$request->is('web/dashboard/login') && !$request->is('web/dashboard/register')) {
                    return redirect(route('login'));
                }
            }

            return $next($request);
    }


}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class ProfileAuthorizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $authenticatedProfileId = Session::get('authenticated_profile_id');
        $form_id = $request->route('form_id');

        if ($authenticatedProfileId == $form_id) {
            return $next($request);
        } else {
            abort (403);
        }
    }
}

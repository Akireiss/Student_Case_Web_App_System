<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            if (Auth::check()) {
                $user = Auth::user();

                if ($user->role === User::ROLE_ADMIN) {
                    return redirect()->route('admin/dashboard');
                } elseif ($user->role === User::ROLE_STAFF) {
                    return redirect()->route('admin/dashboard');
                }
            }
        return $next($request);
    }
}

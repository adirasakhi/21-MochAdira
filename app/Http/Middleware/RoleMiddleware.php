<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        if ($user && $user->role_id == $role) {
            return $next($request);
        }

        if ($role == 1 && $user->role_id != 1) {
            return abort(404); // Show 404 page for non-admins accessing admin routes
        }

        return redirect('/dashboard'); // Redirect other roles to the hompag
    }
}

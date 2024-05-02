<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $adminRoleId = Role::where('name', 'Admin')->first()->id ?? null;

        if (Auth::check() && Auth::user()->role_id === $adminRoleId) {
            return $next($request);
        }

        return redirect()->route('admin.login'); 
    }
}

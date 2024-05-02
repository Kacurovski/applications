<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the request is for the "Add new discussion" route
        $isAddDiscussionRoute = $request->routeIs('discussion.create');

        if (!auth()->check() && $isAddDiscussionRoute) {
            return Redirect::route('login')->with('message', 'You need to be logged in to do that!');
        }

        return $next($request);
    }
}

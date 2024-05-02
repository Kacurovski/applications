<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DiscussionAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

            // Get the comment from the route parameters
            $discussion = $request->route('discussion');
    
            // Check if the comment belongs to the logged-in user
            if (($discussion && $discussion->user_id == $user->id) || $user->role === 'admin') {
                return $next($request);
            }

            return redirect()->route('discussion.index')->with('error', 'Unauthorized');
    }
}

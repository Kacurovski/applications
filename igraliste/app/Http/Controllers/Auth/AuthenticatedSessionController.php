<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
    
        // Get the role ID for regular users
        $regularRoleId = Role::where('name', 'Regular')->first()->id ?? null;
    
        // Add a condition for the role_id to be the regular user role ID
        if (Auth::attempt(array_merge($credentials, ['role_id' => $regularRoleId]))) {
            $request->session()->regenerate();
            return redirect()->route('profile');
        }
    
        return back()->withErrors([
            'email' => 'Грешни податоци за најава.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

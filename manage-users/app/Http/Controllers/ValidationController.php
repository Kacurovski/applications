<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\UserCreated;
use Illuminate\Http\Request;
use App\Events\UserActivated;
use Illuminate\Support\Carbon;

class ValidationController extends Controller
{
    public function validateLink(Request $request, $email, $code)
    {
        $user = User::where('email', $email)->where('activation_link', $code)->first();

        if (!$user) {
            abort(401);
        }

        $expirationTime = $user->activation_link_created->addSeconds(180); 
        if (now()->gt($expirationTime)) {
            return redirect()->route('expired.link', ['user' => $user, 'code' => $user->activation_link])->with('message', 'Sorry, your activation link has expired. Click on the button to regenerate a new link.');;
        }

        event(new UserActivated($user));

        return redirect()->route('login')->with('activated', 'Your account has been activated successfully! Login now');
    }

    public function showExpiredLink(User $user, $code)
    {
        if ($user->activation_link !== $code) {
            return redirect()->back()->with('error', 'Invalid activation link.');
        }
    
        return view('expired-link', compact('user'))->with('message', 'Sorry, your activation link has expired. Click on the button to regenerate a new link.');
    }

    public function regenerateNewLink(Request $request, User $user)
    {
        event(new UserCreated($user));
    
        $code = $user->activation_link;
    
        return redirect()->route('expired.link', compact('user', 'code'))->with('success', 'A new activation link has been sent to your email.');
    }
    
}

<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            logger('Google User: ', (array) $user);
            $authUser = $this->findOrCreateUser($user, 'google');
            Auth::login($authUser, true);
            return redirect('/profile');
        } catch (Exception $e) {
            logger('Google Login Error: ', [$e->getMessage()]);
            return redirect('/login');
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            logger('Facebook User: ', (array) $user);
            $authUser = $this->findOrCreateUser($user, 'facebook');
            Auth::login($authUser, true);
            return redirect('/profile');
        } catch (Exception $e) {
            logger('Facebook Login Error: ', [$e->getMessage()]);
            return redirect('/login');
        }
    }

    private function findOrCreateUser($socialUser, $provider)
    {
        $authUser = User::where('provider_id', $socialUser->id)->where('provider', $provider)->first();
    
        if ($authUser) {
            logger('Existing User: ', (array) $authUser);
            return $authUser;
        }
    
        $regularRoleId = Role::where('name', 'Regular')->first()->id ?? null;
    
        $newUser = User::create([
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'provider' => $provider,
            'provider_id' => $socialUser->id,
            'role_id' => $regularRoleId, 
        ]);
    
        logger('New User: ', (array) $newUser);
        return $newUser;
    }

}

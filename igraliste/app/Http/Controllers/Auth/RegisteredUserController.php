<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\RegisterStep3Request;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterStep3Request $request)
    {
        $registrationData = session('registration_data', []);
    
        $requiredKeys = ['first_name', 'last_name', 'email', 'password'];
        foreach ($requiredKeys as $key) {
            if (!isset($registrationData[$key])) {
                return redirect()->route('register.step1')->with('error', 'Please complete all steps.');
            }
        }
    
        $registrationData = array_merge($registrationData, $request->validated());
    
    
        $regularRoleId = Role::where('name', 'Regular')->first()->id ?? null;

        $user = User::create([
            'name' => $registrationData['first_name'],
            'surname' => $registrationData['last_name'],
            'email' => $registrationData['email'],
            'password' => Hash::make($registrationData['password']),
            'address' => $request->input('action') === 'finished' ? $registrationData['address'] : null,
            'phone_number' => $request->input('action') === 'finished' ? $registrationData['phone_number'] : null,
            'bio' => $request->input('action') === 'finished' ? $registrationData['bio'] : null,
            'picture' => $request->input('action') === 'finished' && $request->hasFile('picture') && $request->file('picture')->isValid() ? $request->file('picture')->store('public/user_pictures') : null,
            'role_id' => $regularRoleId,
        ]);
    
        Auth::login($user);
    
        session()->forget('registration_data');
    
        return redirect()->route('profile');
    }

    public function profile(){
        return view('auth.profile');
    }
}   
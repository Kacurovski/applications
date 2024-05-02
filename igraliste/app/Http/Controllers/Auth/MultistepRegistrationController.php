<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Requests\Step1Request;
use App\Http\Requests\Step2Request;
use App\Http\Requests\Step3Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterStep1Request;
use App\Http\Requests\RegisterStep2Request;
use App\Http\Requests\RegisterStep3Request;

class MultistepRegistrationController extends Controller
{
    // ...

    public function createStep1()
    {
        $oldInput = session('registration_data', []);
        return view('auth.register-step1', compact('oldInput'));
    }

    public function storeStep1(RegisterStep1Request $request)
    {
        session(['registration_data' => $request->validated()]);
        return redirect()->route('register.step2');
    }

    public function createStep2()
    {
        if (!session()->has('registration_data')) {
            return redirect()->route('register.step1')->with('error', 'Please complete Step 1 first.');
        }

        $oldInput = session('registration_data', []);
        return view('auth.register-step2', compact('oldInput'));
    }

    public function storeStep2(RegisterStep2Request $request)
    {
        if ($request->password !== session('registration_data.password')) {
            return back()->withErrors(['password' => 'Password does not match.']);
        }

        $registrationData = array_merge(session('registration_data', []), $request->validated());
        session(['registration_data' => $registrationData]);

        return redirect()->route('register.step3');
    }

    public function createStep3()
    {
        if (!session()->has('registration_data')) {
            return redirect()->route('register.step1')->with('error', 'Please complete previous steps first.');
        }
      
        return view('auth.register-step3');
    }


    public function create()
    {
        return view('auth.login');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminUpdateProfileRequest;
use App\Http\Requests\AdminChangePasswordRequest;

class AdminAuthenticatedSessionController extends Controller
{

    public function create()
    {
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            return redirect('/');
        }
    
        return view('admin.login');
    }

    public function showProfile()
    {
        return view('admin.profile');
    }

    public function store(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $adminRole = Role::where('name', 'Admin')->first();
    
            if ($user->role_id == $adminRole->id) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            } else {
                Auth::logout();
                return redirect()->route('admin.login')->withErrors([
                    'email' => 'You do not have administrator access.',
                ]);
            }
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function updateProfile(AdminUpdateProfileRequest $request)
    {
        $admin = Auth::user();

        $dataToUpdate = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ];

        if ($request->filled('password')) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            // Delete the old picture if it exists
            if ($admin->picture && Storage::exists($admin->picture)) {
                Storage::delete($admin->picture);
            }

            // Store the new picture and update the path
            $path = $request->file('picture')->store('public/admin_pictures');
            $dataToUpdate['picture'] = $path;
        }

        $admin->update($dataToUpdate);

        return redirect()->back()->with('success', 'Профилот е успешно ажуриран.');
    }


    public function showChangePasswordForm()
    {
        return view('admin.password-change');
    }

    public function changePassword(AdminChangePasswordRequest $request)
    {
        $admin = Auth::user();

        if (!Hash::check($request->old_password, $admin->password)) {
            return back()->withErrors(['old_password' => 'Your current password does not match with our records.']);
        }

        $admin->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('admin.profile')->with('success', 'Вашата лозинка е успешно променета.');
    }


    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}

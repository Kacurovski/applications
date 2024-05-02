<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function login(LoginRequest $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session()->put('admin_id', $admin->id);
            return redirect()->route('projects.index');
        } else {
            return redirect()->back()->with('error', 'Invalid email or password. Please try again.');
        }
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('projects.index');
    }
}

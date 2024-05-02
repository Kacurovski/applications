<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userPanel()
    {
        return view('user-panel');
    }

    public function adminDashboard()
    {
        return view('admin-dashboard');
    }

}

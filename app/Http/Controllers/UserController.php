<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function create()
    {
        return view('create');
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->all();

        session(['user_data' => $data]);

        return redirect()->route('user.show');
    }

    public function show()
    {
        $data = session('user_data');

        if($data){
            return view('show', compact('data'));
        } else {
            return redirect()->route('home');
        }
    }

    public function clearSession()
{
    request()->session()->forget('user_data');
    return redirect()->route('home');
}
}

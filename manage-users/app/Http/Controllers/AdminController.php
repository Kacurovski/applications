<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        $users = User::where('type', 'regular')->get();

        return response()->json($users);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);
    
        if ($user) {
            event(new UserCreated($user));
            return response()->json(['success' => true, 'message' => 'User: ' . $user->username . ' created successfully']);
        }
    
        return response()->json(['fail' => false, 'message' => 'Something went wrong']);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return response()->json(['message' => 'User updated successfully'], 200);
    }

    public function destroy(User $user)
    {
        $username = $user->username;
        if ($user->delete()) {
            return response()->json(['success' => true, 'message' => 'User: ' . $username . ' deleted successfuly']);
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong']);
    }


    public function deactivate(User $user)
    {
        $user->is_active = false;
        $user->save();

        return response()->json(['success' => true, 'message' => 'User deactivated successfully']);
    }
}

<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $userdata =  User::get();
        return view('admin.User Management.index', compact('userdata'));
    }
    public function create()
    {
        return view('admin.User Management.create');
    }
    public function store(Request $request)
    {
        // return $request;
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('password');
        $user->save();
        return redirect()->back()->with('message', 'User Created Successfully');
    }
}
